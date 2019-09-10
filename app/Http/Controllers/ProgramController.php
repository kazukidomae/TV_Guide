<?php

namespace App\Http\Controllers;

use App\Http\Resources\KeyWordResource;
use Illuminate\Http\Request;
use Goutte\Client;
use App\Models\KeyWord;
class ProgramController extends Controller
{
    // 番組一覧
    public function list() {
        $client = new Client();
        $crawler = $client->request('GET', 'https://tvtopic.goo.ne.jp/program/');
        $programs = $crawler->filter('.table-chanel li')->each(function ($node) {
            // 稀に番組表に空のliが含まれている
            if(count($node->filter('.min'))){
                return [
                    'starttime' => $node->filter('.min')->text(), // 放送開始時間
                    'programname' => str_replace($node->filter('.min')->text(),'',$node->text()), // 番組名
                ];
            }
        });
        // 空の要素を削除し、要素の番号を振りなおす
        return array_values(array_filter($programs));
    }

    /**
     * 検索
     *
     * @param  Request  $request
     * @return Response
     */
    public function search(Request $request){
        $searchresults = array();
        $programs = $this->list();
        $programnames = array_pluck($programs,'programname');
        foreach($programnames as $key => $programname){
            if(preg_match('/'.$request->keyword.'/',$programname)){
                array_push($searchresults ,$programs[$key]);
            }
        }
        // 検索結果をDBに保存
        $this->store($request->keyword);
        return $searchresults;
    }

    // 検索結果保存
    public function store($word){
        $keyword = new KeyWord();
        $keyword->keyword = $word;
        $keyword->count = 1;
        $keyword->save();
    }

    // 履歴表示
    public function history(){
        return KeyWord::orderBy('id', 'desc')->get();
    }
    // 履歴削除
}

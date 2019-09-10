<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
// 一覧
Route::group(['middleware' => 'api'], function() {
    Route::get('list',  'ProgramController@list');
});

// 検索
Route::group(['middleware' => 'api'], function() {
    Route::post('search',  'ProgramController@search');
});

// 検索
Route::group(['middleware' => 'api'], function() {
    Route::get('history',  'ProgramController@history');
});
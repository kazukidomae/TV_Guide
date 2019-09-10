<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>PortFolio</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="{{ mix('css/app.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('/css/style.css') }}" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div id="program-list">
            <div class="title"><img alt="TV Guide" src="{{ asset('/img/logo.png') }}"></div>
            <div class="input-group mb-3">
                <input v-model="keyword" class="form-control" placeholder="Please Input Keyword">
                <div class="input-group-append">
                    <button v-on:click="search" class="input-group-text">Search</button>
                </div>
            </div>
            <div class="table-area">
                <table class="table table-bordered program">
                    <thead class="thead-dark table-bordered">
                        <tr>
                        <th scope="col"></th>
                        <th scope="col">Program</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="program in programs">
                            <td>@{{ program.starttime }}</td>
                            <td>@{{ program.programname }}</td>
                        </tr>
                    </tbody>
                </table>
                <table class="table table-bordered history">
                    <thead class="thead-dark">
                        <tr>
                        <th scope="col">history</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(history,keyword) in historys" v-bind:key="keyword">
                            <td><a href="#" v-on:click="setkeyword(keyword)">@{{ history.keyword }}</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <script src="{{ mix('js/app.js') }}"></script>
    </body>
</html>
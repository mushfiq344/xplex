@extends('layouts.dashboard_app')
@section('head_js')
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
@endsection
@section('content')

    @if (session('alert'))
        <div class="alert alert-success">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{ session('alert') }}
        </div>
    @endif
    <div class="tab sticky-top">

        <a href="{{url('dashboard_movie')}}">
            <button class="tablinks">Movies</button>
        </a>
        <a href="{{url('dashboard_tv_show')}}">
            <button class="tablinks">TV Shows</button>
        </a>
        <a href="{{url('dashboard_explore')}}">
            <button class="tablinks">Explore</button>
        </a>
        @if(Session::get('admin_type')=='admin')
            <a href="{{url('dashboard_game')}}">
                <button class="tablinks">Games</button>
            </a>

            <a href="{{url('dashboard_reset_password')}}">
                <button class="tablinks">Reset Password
                </button>
            </a>

            <a href="{{url('/dashboard_backup')}}">
                <button class="tablinks  active">Scan
                </button>
            </a>
            <a href="{{url('/dashboard_users')}}">
                <button class="tablinks">Users
                </button>
            </a>
            <a href="{{url('dashboard_ads')}}">
                <button class="tablinks">Ads</button>
            </a>
        @endif
    </div>
    <div id="backup">
        <div class="container mt-4" style="padding-top: 50px;">

            <div class="row justify-content-center">
                <div style="margin: auto 0px;" class="col-md-3 mb-4">
                    <button onclick="db_backup(event)" class="btn btn-primary col-12">Take Backup</button>
                    <div id="spin_backup" class="loader"
                         style="display: none;float:right;margin-right: 115px;"></div>
                </div>
                <div style="margin: auto 0px;padding-top: 10px" class="col-md-12 mb-12">
                    <label for="sel1">Select Movie list (select one):</label>
                    <select class="form-control" id="movie_scan_list" style="height: 30px;">
                        <optgroup label="Movies">
                            <option value="all" selected>all</option>
                        </optgroup>
                    </select>
                </div>
                <div style="margin: auto 0px;padding-top: 5px;" class="col-md-12 mb-12">
                    <button id="scan_movie_button" onclick="scan_movie(event)" class="btn btn-primary col-12">Scan
                        Movie
                    </button>
                    <div id="spin_scan_movie" class="loader"
                         style="display: none;float:right;margin-right: 115px;"></div>
                </div>
                <div style="margin: auto 0px;padding-top: 20px;" class="col-md-12 mb-12">
                    <label for="sel1">Select Tv Show list (select one):</label>
                    <select class="form-control" id="scan_list_tv" style="height: 30px;">
                        <optgroup label="Tv Series">
                            <option value="all">all</option>

                        </optgroup>
                    </select>
                </div>
                <div style="margin: auto 0px;padding-top: 10px;" class="col-md-12 mb-12">
                    <button id="scan_tv_button" onclick="scan_tv_show(event)" class="btn btn-primary col-12">Scan Tv
                        Series
                    </button>
                    <div id="spin_scan_tv_show" class="loader"
                         style="display: none;float:right;margin-right: 115px;"></div>
                </div>
            </div>

            <br>
            <script>
                function db_backup(event) {
                    $('#spin_backup').fadeIn(300);
                    window.open('db_backup', "_self");
                }

                function scan_tv_show(event) {
                    document.getElementById("scan_tv_button").disabled = true;
                    var selectedValue = document.getElementById("scan_list_tv").value;
                    $('#spin_scan_tv_show').fadeIn(300);
                    window.open('scan_tv_show/' + selectedValue, "_self");
                }

                function scan_movie(event) {
                    document.getElementById("scan_movie_button").disabled = true;
                    $('#spin_scan_movie').fadeIn(300);
                    var selectedValue = document.getElementById("movie_scan_list").value;

                    window.open('scan_movie/' + selectedValue, "_self");
                }

            </script>
        </div>
    </div>

@endsection
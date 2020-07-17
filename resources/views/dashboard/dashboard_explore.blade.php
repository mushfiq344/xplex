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
            <button class="tablinks active">Explore</button>
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
                <button class="tablinks">Scan
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
    <div id="Explore" class="tabcontent" style="display:block;">
        <!--/////////////////////////////////////////-->
        <div class='container' style="margin-top: 30px">
            <div class="row">
                @if(Session::get('admin_type')=='admin')
                    <div class="col-md-4 mt-4">
                        <a style="width:80%" class="btn btn-success" href="{{url('show_movies')}}">Show Movies</a>
                    </div>
                    <div class="col-md-4 mt-4">
                        <a style="width:80%" class="btn btn-success" href="{{url('show_tv_shows')}}">Show Tv Shows</a>
                    </div>
                    <div class="col-md-4 mt-4">
                        <a style="width:80%" class="btn btn-success" href="{{url('show_pc_games')}}">Show Pc Games</a>
                    </div>

                    <div class="col-md-4 mt-4">
                        <a style="width:80%" class="btn btn-success" href="{{url('show_ads')}}">Advertisements</a>
                    </div>
                @endif
                <div class="col-md-4 mt-4">
                    <a style="width:80%" class="btn btn-success" href="{{url('show_requested_movies')}}">Approve
                        Movies</a>
                </div>

            </div>
            <br>
        </div>
    </div>

@endsection
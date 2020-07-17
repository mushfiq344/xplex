<!DOCTYPE html>
{{--<html lang="{{ app()->getLocale() }}">--}}
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        @yield('head_js')

        <!-- Scripts -->


        <!-- Fonts -->
        <link rel="dns-prefetch" href="https://fonts.gstatic.com">
        <!-- Styles -->
        <link rel="stylesheet" type="text/css" href="{{ asset('css/loader.css') }}">
        <link href="https://fonts.googleapis.com/css?family=Titillium+Web" rel="stylesheet">
        <link rel="icon" type="image/png" href="{{asset('default_images/favicon.png')}}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


        <meta name="_token" content="{{ csrf_token() }}">


        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link type="text/css" href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
        {{--<link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}


        <link href="https://fonts.googleapis.com/css?family=Titillium+Web" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Titillium+Web" rel="stylesheet">

        @yield('head_css')

    </head>
    <body>
        <div id="app">
            <div class="container">
                <div class="row" id="navbar_id">
                    <div class="col-md-7 mt-4">
                        <a href="{{ url('/') }}"><img  class="d-inline float-right" width="25%" src="{{asset('default_images/site_logo_for_dashboard.png')}}">
                        </a>
                    </div>
                    <div class="col-md-5 mt-4">
                        <a href="{{url('signout')}}"><i class="fa fa-sign-out float-right ml-5" style="font-size:36px"></i>
                        </a>
                    </div>
                </div>
            </div>
            <?php
            $abir=10;
            ?>

            <div>
                @yield('content')
            </div>
        </div>


        @yield('footer')
        {{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>--}}
        {{--<script  type="text/javascript" src="{{asset('js/dashboard_movie.js')}}"></script>--}}
        {{--<script  type="text/javascript" src="{{asset('js/dashboard_tv_show.js')}}"></script>--}}
        {{--<script  type="text/javascript" src="{{asset('js/dashboard_game.js')}}"></script>--}}
        {{--<script  type="text/javascript" src="{{asset('js/dashboard_others.js')}}"></script>--}}
        {{--<script  type="text/javascript" src="{{asset('js/dashboard_mtv.js')}}"></script>--}}
        {{--<script  type="text/javascript" src="{{asset('js/dashboard_channel.js')}}"></script>--}}
        {{--<script  type="text/javascript" src="{{asset('js/dashboard_tab_control.js')}}"></script>--}}

    </body>


</html>

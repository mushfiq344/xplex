<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" type="text/css" href="{{asset('assets/mobile/styles/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/mobile/fonts/css/fontawesome-all.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/mobile/styles/framework.css')}}">
    <link href="https://fonts.googleapis.com/css?family=IBM+Plex+Sans:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i|Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">

    <style>
        ul.pagination li{
            display: inline;
        }
    </style>
</head>
<body>

<div id="preloader" class="preloader-light">
    <h1></h1>
    <div id="preload-spinner"></div>
    <p>Entertainment Anywhere</p>
    <em>This will only take a second. It's totally worth it!</em>
</div>

<div class="page-build light-skin highlight-blue">
    <div id="menu-hider"></div>
    <div id="menu-find" data-load="menu-find.html" data-height="420" class="menu-box menu-load menu-bottom"></div>

    <div class="header header-scroll-effect">
        <div class="header-line-1 header-hidden header-logo-app">
            <a href="#" class="back-button header-logo-title">Back to Home</a>
            <a href="#" class="back-button header-icon header-icon-1"><i class="fa fa-angle-left"></i></a>
            <a href="#" data-menu="menu-find" style="padding-left: 50px;" class="header-icon header-icon-3"><i class="fa fa-search"></i></a>

            <a href="#" data-menu="menu-demo" style="padding-left: 50px;" class="header-icon header-icon-2"><i class="fa fa-cog"></i></a>
        </div>
        <div class="header-line-2 header-scroll-effect">
            <a href="#" class="header-pretitle header-date color-highlight"><!--Date will Appear Here --></a>
            <a href="#" class="header-title">Tv Series</a>

            <a href="#" data-menu="menu-find" class="header-icon header-icon-2"><i class="fa fa-search"></i></a>
            <a href="#" data-menu="menu-demo" class="header-icon header-icon-3"><i class="fa fa-cog"></i></a>
        </div>
    </div>

    <div class="page-content ">
        <div class="page-content header-clear-medium">
            <div class="content">
                <!-- Dropdown Start -->
                <?php for ($i=0;$i<sizeof($result)-1;$i++){ ?>
                <div class="one-half">
                    <div>
                        <h2 style="position: absolute; bottom: 40px; left: 16px; color: white; opacity: .8; z-index: 10; font-size: 17px;">{{$result[$i]->title}}</h2>

                        <h2 style="position: absolute; bottom: 2px; left: 15px; color: white; opacity: .8; z-index: 10; font-size: 17px;"> <i class="fa fa-star"></i> <span style="font-size: 15px; padding-left: 4px;"> {{$result[$i]->imdbrating}}</span></h2>

                        <h2 style="position: absolute; bottom: 2px; right: 15px; color: white; opacity: .8; z-index: 10; font-size: 12px;"> <i class="fa fa-download"></i> <span style="font-size: 15px; padding-left: 4px;"> {{$result[$i]->total_view}}</span></h2>

                        <div class="overlay overlay-gradient" style=" border-radius: 15px;"></div>

                        <a href="{{url('/mobile/single_tv/'.$result[$i]->id)}}"><img data-src="{{url($result[$i]->poster_url_value)}}" class="preload-image rounded-image responsive-image" alt="img"></a>
                    </div>
                </div>
                <div class="one-half last-column">
                    <div>
                        <h2 style="position: absolute; bottom: 40px; left: 16px; color: white; opacity: .8; z-index: 10; font-size: 17px;">{{$result[$i+1]->title}}</h2>

                        <h2 style="position: absolute; bottom: 2px; left: 15px; color: white; opacity: .8; z-index: 10; font-size: 17px;"> <i class="fa fa-star"></i> <span style="font-size: 15px; padding-left: 4px;">{{$result[$i+1]->imdbrating}} </span></h2>

                        <h2 style="position: absolute; bottom: 2px; right: 15px; color: white; opacity: .8; z-index: 10; font-size: 12px;"> <i class="fa fa-download"></i> <span style="font-size: 15px; padding-left: 4px;"> {{$result[$i+1]->total_view}}</span></h2>

                        <div class="overlay overlay-gradient" style="border-radius: 15px;"></div>

                        <a href="{{url('/mobile/single_tv/'.$result[$i+1]->id)}}"><img data-src="{{url($result[$i+1]->poster_url_value)}}" class="preload-image rounded-image responsive-image" alt="img"></a>
                    </div>

                </div>

                <?php $i++; } ?>

                <br><br><br>
            </div>

        </div>
    </div>
</div>
@extends('layouts.mobile_footer')
<div class="pagination">
    {{$result->links('dashboard.paginate')}}
</div>

<script type="text/javascript" src="{{asset('assets/mobile/scripts/jquery.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/mobile/scripts/plugins.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/mobile/scripts/custom.js')}}"></script>
</body>
</html>
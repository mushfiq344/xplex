        <!DOCTYPE HTML>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="viewport"
          content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover"/>
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" type="text/css" href="{{asset('assets/mobile/styles/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/mobile/fonts/css/fontawesome-all.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/mobile/styles/framework.css')}}">

    <link href="https://fonts.googleapis.com/css?family=IBM+Plex+Sans:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i|Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i"
          rel="stylesheet">
    <style>
        #video {
            z-index: 100;

        }
        .sticky {
            position: fixed;
            top: 0;
            width: 100%;
        }

        .sticky + .bottom_content {
            padding-top: 300px;
        }

    </style>

</head>
<body>
<div id="preloader" class="preloader-light">
    <div id="preload-spinner"></div>
    <p>Entertainment Anywhere</p>
    <em>This will only take a second. It's totally worth it!</em>
</div>

<div id="page-transitions" class=" light-skin highlight-blue bottom_content">
<div id="video">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/mobile/styles/framework-blog.css')}}">
    <div id="menu-find" data-load="menu-find.html" data-height="420" class="menu-box menu-load menu-bottom"></div>
    <div>
        <div class="header-line-1 header-hidden header-logo-app">
            <a style="display: block; width: 50px" href="{{\Illuminate\Support\Facades\URL::previous()}}" class="back-button header-logo-title">Back</a>
            <a href="#" class="back-button header-icon header-icon-1"><i class="fa fa-angle-left"></i></a>
            <a href="#" data-menu="menu-find" style="padding-left: 50px;" class="header-icon header-icon-3"><i class="fa fa-search"></i></a>
        </div>
    </div>
    <?php
    if($first_copy!="N/A"){
    ?>
    <video style="padding-top: 50px" id="video1" class="page-build" width="100%"  controls autoplay type='video/{{$src}}; codecs="theora, vorbis"'>
        <source src="{{$first_copy}}">
        Your browser does not support HTML5 video.
    </video>
    <?php
    } else {  ?>

    <video style="padding-top: 50px;object-fit: cover" id="video1" class="page-build" height="300px" width="100%" poster="{{$result->poster_url_value}}"  controls autoplay type='video/{{$src}}; codecs="theora, vorbis"'>
        <source src="{{$first_copy}}">
        Your browser does not support HTML5 video.
    </video>

    <?php } ?>
</div>

    <div id="bottom-content" class="bottom_content">
        <div class="page-content ">
            <div class="page-content ">
                <div class="blog-post-home">
                    <strong class="font-20">{{$result->title}}</strong>
                    <span>Director: {{$result->director}}</span>
                    <span>Cast: {{$result->actors}}</span>
                    <span class="font-14">Genre: {{$result->genre}}</span>
                    <div class="blog-post-stats">
                        <a href="#"><i class="fa fa-star color-red-light" ></i>{{$result->imdbrating}}</a>
                        <a  href="#"><i class="fa fa-eye color-blue-light" ></i>{{$result->rottentomatoesrating}}</a>
                        <div class="clear"></div>
                    </div>
                    <p>
                        {{$result->plot}}
                    </p>

                    <span><a href="#" data-menu="sheet-video" style="float: left;"
                             class="button shadow-medium button-round button-xs button-blue"> <i class="fa fa-play"></i> Trailer</a></span>
                    <br>
                    <br>

                    <div class="accordion accordion-style-0">
                        <div class="accordion-border">
                            <a href="#" class="font-14" data-accordion="accordion-22">Download Here<i class="fa fa-arrow-down"></i></a>
                            <div class="accordion-content" id="accordion-22">
                                <div class="top-15">
                                    <?php
                                    foreach ($links as $link){
                                    $download_title = $link->name;
                                    ?>
                                    {{-- <span style="float: left">{{$download_title}}</span>--}}
                                    <span style="font-size: 14px">{{str_replace("."," ",urldecode($download_title))}}<br> <a style="color: white" href="{{$link->path}}" class="button shadow-medium button-rounded button-xs button-green">Download</a></span>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="page-content ">
                <strong class="font-20" style="font-weight: bold; margin-left: 14px">Sugesstions</strong>
                <div class="content">
                    <br>
                    <?php for ($i=0;$i<sizeof($popular)-1;$i++){ ?>
                    <div class="one-half">
                        <div>
                            <h2 style="position: absolute; bottom: 40px; left: 16px; color: white; opacity: .8; z-index: 10; font-size: 17px;">{{$popular[$i]->title}}</h2>

                            <h2 style="position: absolute; bottom: 2px; left: 15px; color: white; opacity: .8; z-index: 10; font-size: 17px;"> <i class="fa fa-star"></i> <span style="font-size: 15px; padding-left: 4px;"> {{$popular[$i]->imdbrating}}</span></h2>

                            <h2 style="position: absolute; bottom: 2px; right: 15px; color: white; opacity: .8; z-index: 10; font-size: 12px;"> <i class="fa fa-download"></i> <span style="font-size: 15px; padding-left: 4px;"> {{$popular[$i]->total_view}}</span></h2>

                            <div class="overlay overlay-gradient" style=" border-radius: 15px;"></div>


                            <a href="{{url('/mobile/single_movie/'.$popular[$i]->id)}}"><img data-src="{{$popular[$i]->poster_url_value}}" class="preload-image rounded-image responsive-image" alt="img"></a>
                        </div>
                    </div>
                    <div class="one-half last-column">
                        <div>
                            <h2 style="position: absolute; bottom: 40px; left: 16px; color: white; opacity: .8; z-index: 10; font-size: 17px;">{{$popular[$i+1]->title}}</h2>

                            <h2 style="position: absolute; bottom: 2px; left: 15px; color: white; opacity: .8; z-index: 10; font-size: 17px;"> <i class="fa fa-star"></i> <span style="font-size: 15px; padding-left: 4px;">{{$popular[$i+1]->imdbrating}} </span></h2>

                            <h2 style="position: absolute; bottom: 2px; right: 15px; color: white; opacity: .8; z-index: 10; font-size: 12px;"> <i class="fa fa-download"></i> <span style="font-size: 15px; padding-left: 4px;"> {{$popular[$i+1]->total_view}}</span></h2>

                            <div class="overlay overlay-gradient" style="border-radius: 15px;"></div>

                            <a href="{{url('/mobile/single_movie/'.$popular[$i+1]->id)}}"><img data-src="{{$popular[$i+1]->poster_url_value}}" class="preload-image rounded-image responsive-image" alt="img"></a>
                        </div>

                    </div>

                    <?php $i++; } ?>

                    <br><br><br>
                </div>
            </div>

            <div id="sheet-video" class="menu-box menu-bottom" style="-webkit-box-shadow: 10px 10px 130px -9px rgba(0,0,0,0.55);
-moz-box-shadow: 10px 10px 130px -9px rgba(0,0,0,0.55);
box-shadow: 10px 10px 130px -9px rgba(0,0,0,0.55);">
                <div class="menu-title">
                    <span class="color-highlight">Trailer of</span>
                    <h1>{{$result->title}}</h1>
                    <a onclick="closeTrailer()" href="#" class="menu-hide"><i class="fa fa-times"></i></a>
                </div>
                <?php
                $url = substr($result->trailer_value, -11);
                $a = '"https://www.youtube.com/embed/' . $url;
                $url_value = $a . '?rel=1&amp;autoplay=1&loop=1&enablejsapi=1&playlist=' . $url . '&amp;controls=1&amp;showinfo=0;mute=0enablejsapi=1" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen';
                ?>
                <iframe class="iframe-youtube responsive-image" src={!! $url_value !!} frameborder="0" allowfullscreen=""></iframe>
            </div>
        </div>
    </div>
</div>

@extends('layouts.mobile_footer')

<script>
    /*This function is for stopping youtube when close is clicked*/
    function closeTrailer(){
        $('.iframe-youtube').each(function(){
            this.contentWindow.postMessage('{"event":"command","func":"stopVideo","args":""}', '*')
        });
    }

</script>
<script>
    window.onscroll = function() {myFunction()};

    var navbar = document.getElementById("video");
    var sticky = navbar.offsetTop;

    function myFunction() {
        if (window.pageYOffset >= sticky) {
            navbar.classList.add("sticky")
        } else {
            navbar.classList.remove("sticky");
        }
    }
    var video = document.getElementById("video");

    video.onloadedmetadata = function () {
        console.log(video.videoHeight);
        console.log(document.getElementById("bottom-content").clientHeight);
    }

</script>
<script type="text/javascript" src="{{asset('assets/mobile/scripts/jquery.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/mobile/scripts/plugins.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/mobile/scripts/custom.js')}}"></script>
</body>
</html>
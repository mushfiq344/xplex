<!DOCTYPE html>

<html>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- Icon -->
    <link rel="icon" type="image/png" href="{{asset('default_images/favicon.png')}}">
    <!-- Google Fonts -->

    <link href='{{asset('http://fonts.googleapis.com/css?family=Lato:300,400,700')}}' rel='stylesheet' type='text/css'>

    <!-- Bootstrap -->
    <link rel="stylesheet" type="text/css" href="{{asset('../assets/bower_components/bootstrap/dist/css/bootstrap.min.css')}}" />

    <!-- FontAwesome -->
    {{-- <link rel="stylesheet" type="text/css" href="{{asset('../assets/bower_components/font-awesome/css/font-awesome.min.css')}}" />--}}

    <!-- Revolution Slider -->
    <!-- Youplay -->

    <link rel="stylesheet" type="text/css" href="{{asset('../assets/youplay/css/youplay.min.css')}}" />

    <!-- Custom Styles -->


    <link rel="stylesheet" href="{{asset('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('https://cdn.jsdelivr.net/npm/animate.css@3.5.2/animate.min.css')}}">

    <script src = "{{asset('https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js')}}"></script>
    <link rel="stylesheet" type="text/css" href="{{asset('css/hover.css')}}">
    <link href="https://fonts.googleapis.com/css?family=Titillium+Web" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css" integrity="sha384-/rXc/GQVaYpyDdyxK+ecHPVYJSN9bmVFBvjA/9eOB+pb3F2w2N6fc5qB9Ew5yIns" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{asset('../assets/bower_components/magnific-popup/dist/magnific-popup.css')}}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>
@extends('layouts.navbar')
{{--Navbar ends!--}}

<!-- Main Content -->
<br><br><br>
<section class="content-wrap">

    <div class="container youplay-store store-grid">
        <!-- Games List -->
        <div class="col-md-9 isotope">
            <h4> Movie > {{strtoupper($actor)}}  </h4>
            <br>
            <div class="isotope-list row vertical-gutter">
            <?php foreach ($result as $value){ ?>
            <!-- Single Product Block -->
                <div class="item col-lg-3 col-md-6 col-xs-12 active" data-filters="sob">
                    <a id="id" href="{{url('movie',[$value->id])}}">
                        <div>
                            <div class="box">
                                <img id="poster_image" src="{{asset($value->poster_url_value)}}" alt="">
                                <div class="box-content" style="margin-top:5%; font-style: bold;">
                                    <h6 class="title"><i class="fas fa-film"></i> {{$value->title}} </h6>
                                    <span class="post">Rotten Tomatoes: {{$value->rottentomatoesrating}}</span>
                                    <?php
                                    $chars_replace=array("$$");
                                    ?>
                                    <span class="post">IMDB: {{$value->imdbrating}}</span>
                                    <span class="post">Quality: {{str_replace($chars_replace," ",$value->print_type)}}</span>
                                    {{-- <span class="post">{{$value->plot}}</span>--}}
                                    <br>
                                    <br>
                                    <ul class="icon">
                                        <li><a class="video-popup" href="{{$value->trailer_value}}"><i class="fa fa-play"> Trailer</i></a></li>
                                    </ul>
                                </div>
                            </div>
                            {{--Bottom Info--}}
                            <div class="bottom-info">
                                <h4 id="title">{{$value->title}}</h4>
                            </div>
                            <?php
                            if(strpos($value->print_type,'$$'))
                            {
                            $print = explode('$$',$value->print_type);
                            ?>

                            <div class="badge bg-default">
                                {{$print[0]}}
                            </div>
                            <div class="badge bg-default">
                                {{ $print[1]}}
                            </div>
                            <?php }
                            else { ?>
                            <div class="badge bg-default">
                                {{$value->print_type}}
                            </div>
                            <?php } ?>
                        </div>
                    </a>
                </div>
                <?php } ?>
            </div>
        </div>
        <!-- /Games List -->

        <!-- Right Side -->
        <div class="col-md-3">

            <!-- Side Search -->
            <!-- /Side Search -->

            <!-- Side Categories -->
            <!-- /Side Categories -->

        </div>
        <!-- /Right Side -->
    </div>

    <!-- Footer -->
@extends('layouts.footer')
    <!-- /Footer -->


</section>
<!-- /Main Content -->

<!-- Search Block -->

<div class="search-block">
    <a href="#!" class="search-toggle glyphicon glyphicon-remove"></a>
    <form action="">
        <div class="youplay-input">
            <input type="text" name="search" placeholder="Search...">
        </div>
    </form>
</div>
<!-- /Search Block -->

<script type="text/javascript" src="{{asset('../assets/bower_components/jquery/dist/jquery.min.js')}}"></script>

<!-- Hexagon Progress -->
<script type="text/javascript" src="{{asset('./assets/bower_components/HexagonProgress/jquery.hexagonprogress.min.js')}}"></script>


<!-- Bootstrap -->
<script type="text/javascript" src="{{asset('../assets/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>

<!-- Jarallax -->
<script type="text/javascript" src="{{asset('../assets/bower_components/jarallax/dist/jarallax.min.js')}}"></script>

<!-- Smooth Scroll -->
<script type="text/javascript" src="{{asset('../assets/bower_components/smoothscroll-for-websites/SmoothScroll.js')}}"></script>

<!-- Countdown -->
<script type="text/javascript" src="{{asset('./assets/bower_components/jquery.countdown/dist/jquery.countdown.min.js')}}"></script>

<!-- Revolution Slider -->

<!-- ImagesLoaded -->
<script type="text/javascript" src="{{asset('../assets/bower_components/imagesloaded/imagesloaded.pkgd.min.js')}}"></script>

<!-- Isotope -->
<script type="text/javascript" src="{{asset('./assets/bower_components/isotope/dist/isotope.pkgd.min.js')}}"></script>
<!-- Youplay -->
<script type="text/javascript" src="{{asset('../assets/youplay/js/youplay.min.js')}}"></script>

<script type="text/javascript" src="{{asset('../assets/youplay/js/search.js')}}"></script>
<script type="text/javascript" src="{{asset('../assets/bower_components/magnific-popup/dist/jquery.magnific-popup.min.js')}}"></script>

<!-- init youplay -->
<script>
    if(typeof youplay !== 'undefined') {
        youplay.init({
            // enable parallax
            parallax:         true,

            // set small navbar on load
            navbarSmall:      false,

            // enable fade effect between pages
            fadeBetweenPages: true,

            // twitter and instagram php paths
            php: {
                twitter: './php/twitter/tweet.php',
                instagram: './php/instagram/instagram.php'
            }
        });
    }

</script>

<script>

    /*when the page first reloads,hide recent tab and popular tab data*/
    document.getElementById("recent_tab").style.display = "none";
    document.getElementById("popular_tab").style.display = "none";
    document.getElementById("rating_tab").style.display = "none";
    document.getElementById("imdb_tab").style.display = "none";
    document.getElementById("rotten_tab").style.display = "none";
</script>


<script>
    $(document).ready(function(){
        $('#new_data').click(function(){
            document.getElementById("recent_tab").style.display = "block"; /*when the new_data is clicked show data*/
        });
        $('#most_popular_data').click(function(){
            document.getElementById("popular_tab").style.display = "block"; /*when the most_popular_data is clicked show data*/
        });
        $('#rating_data').click(function(){
            document.getElementById("rating_tab").style.display = "block"; /*when the rating_data is clicked show data*/
        });
        $('#imdb_rating_data').click(function(){
            document.getElementById("imdb_tab").style.display = "block"; /*when the imdb_data is clicked show data*/
        });
        $('#rotten_rating_data').click(function(){
            document.getElementById("rotten_tab").style.display = "block"; /*when the imdb_data is clicked show data*/
        });
    });

</script>

</body>


<!-- Mirrored from html.nkdev.info/youplay/dark/store.blade.php by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 26 May 2016 12:44:32 GMT -->
</html>

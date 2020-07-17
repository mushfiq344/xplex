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

    <script src = "{{asset('https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js')}}"></script><link href="https://fonts.googleapis.com/css?family=Titillium+Web" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('css/hover.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('../assets/bower_components/magnific-popup/dist/magnific-popup.css')}}" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css" integrity="sha384-/rXc/GQVaYpyDdyxK+ecHPVYJSN9bmVFBvjA/9eOB+pb3F2w2N6fc5qB9Ew5yIns" crossorigin="anonymous">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Titillium+Web" rel="stylesheet">

</head>

<body>
<!-- Preloader -->
<!-- /Preloader -->

<!-- Navbar -->
@extends('layouts.navbar')
{{--Navbar ends!--}}

<!-- Main Content -->
<br><br><br>
<section class="content-wrap">

    <div class="container-fluid youplay-store store-grid" id="galleryCategory" category="{{$category}}" isgenred="{{$genre}}">
        <h4> {{strtoupper($item)}} > {{strtoupper($genre)}} > {{strtoupper($category)}} </h4>


        <!-- Games List -->
        <div class="col-md-9">
            <!-- Sort Categories -->
            <ul class="pagination">
                <li data-filter="sob" id="all_data" ><span>All</span>
                </li>
                <li data-filter="recent" id="new_data"><span>New</span>
                </li>
                <li data-filter="popular" id="most_popular_data"><span>Popular</span>
                </li>
                <li data-filter="imdb" id="imdb_rating_data"><span>IMDB</span></li>

                <li data-filter="rotten" id="rotten_rating_data"><span>Rotten Tomatoes</span></li>
            </ul>
            <!-- /Sort Categories -->

            <div class="isotope-list row vertical-gutter">

            <?php foreach ($result as $value){ ?>
            <!-- Single Product Block -->
                <div class="item col-lg-2 col-md-4 col-xs-6 active" data-filters="sob" >
                    <a id="id" href="{{url('movie',[$value->id])}}">
                        <div class="img img-offset">
                            <div class="box">
                                <img id="poster_image" src="{{asset($value->poster_url_value)}}" alt="">
                                <div class="box-content" style="margin-top:5%">
                                    <h3 class="title">{{$value->title}}</h3>
                                    <span class="post">RT: {{$value->rottentomatoesrating}}</span>
                                    <?php
                                    $chars_replace=array("$$");
                                    ?>
                                    <span class="post">IMDB: {{$value->imdbrating}}</span>
                                    <span class="post">Quality: {{str_replace($chars_replace," ",$value->print_type)}}</span>
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
            <div class="side-block">
                <h4 class="block-title">Categories</h4>
                <ul class="block-content">

                    <?php for($i=0; $i<sizeof($genrelist)-3;$i++){ ?>
                    {{--<li>
                        <a href="{{url('/galleryGenreMovie',['movie','all',$genre_data->genre_type])}}">{{$genre_data->genre_type}}</a>
                    </li>--}}

                    <div class="col-md-4">
                        <a href="{{url('/galleryGenreMovie',['movie','all',$genrelist[$i]->genre_type])}}">{{$genrelist[$i]->genre_type}}</a>
                    </div>

                    <div class="col-md-4">
                        <a href="{{url('/galleryGenreMovie',['movie','all',$genrelist[$i+1]->genre_type])}}">{{$genrelist[$i+1]->genre_type}}</a>
                    </div>

                    <div class="col-md-4">
                        <a href="{{url('/galleryGenreMovie',['movie','all',$genrelist[$i+2]->genre_type])}}">{{$genrelist[$i+2]->genre_type}}</a>
                    </div>
                    <br>
                    <?php $i = $i+3; } ?>

                </ul>
            </div>
            <!-- /Side Categories -->

        </div>
        <!-- /Right Side -->
    </div>

    <!-- Footer -->
    <footer class="youplay-footer-parallax">
        <div class="wrapper">
            <div class="copyright">
                <div class="container">
                    <div style="text-align: center">
                        {{$result->links('dashboard.paginate')}}
                    </div>
                    @extends('layouts.footer')
                </div>
            </div>
        </div>
    </footer>
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

    $category = $('#galleryCategory').attr("category");

    console.log($category);

    if($category == "recent"){
        $('#new_data').addClass("active");
    }
    else if($category == "popular"){
        $('#most_popular_data').addClass("active");
    }
    else if($category == "imdb"){
        $('#imdb_rating_data').addClass("active");
    }
    else if($category == "rottentomatoes"){
        $('#rotten_rating_data').addClass("active");
    }
    else if($category == "all"){
        $('#all_data').addClass("active");
    }



</script>





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
    $(document).ready(function(){
        $('#new_data').click(function(){
            window.location = "{{URL::to('/galleryGenreMovie',['movie','recent',$genre])}}";
        });
        $('#most_popular_data').click(function(){
            window.location = "{{URL::to('/galleryGenreMovie',['movie','popular',$genre])}}";
        });
        $('#imdb_rating_data').click(function(){
            window.location = "{{URL::to('/galleryGenreMovie',['movie','imdb',$genre])}}";
        });
        $('#rotten_rating_data').click(function(){
            window.location = "{{URL::to('/galleryGenreMovie',['movie','rottentomatoes',$genre])}}";
        });
        $('#all_data').click(function(){
            window.location = "{{URL::to('/galleryGenreMovie',['movie','all',$genre])}}";
        });
    });
</script>

</body>

<!-- Mirrored from html.nkdev.info/youplay/dark/store.blade.php by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 26 May 2016 12:44:32 GMT -->
</html>

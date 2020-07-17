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
    <link rel="stylesheet" type="text/css" href="{{asset('assets/mobile/styles/simplebar.css')}}">
    <link href="https://fonts.googleapis.com/css?family=IBM+Plex+Sans:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i|Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i"
          rel="stylesheet">

</head>

<body>

<div id="preloader" class="preloader-light">
    <h1></h1>
    <div id="preload-spinner"></div>
    <p>Entertainment Anywhere</p>
    <em>This will only take a second. It's totally worth it!</em>
</div>

<div id="page-transitions" class="page-build light-skin highlight-blue">
    <div id="menu-hider"></div>
    <div id="menu-find" data-load="menu-find.html" data-height="280" class="menu-box menu-load menu-bottom"></div>

    <div class="header header-scroll-effect">
        <div class="header-line-1 header-hidden header-logo-left">
            <a href="#" class="back-button header-logo-image"></a>
            <a href="#" data-menu="menu-find" class="header-icon header-icon-3" style="padding-left: 50px;"><i
                        class="fa fa-search"></i></a>

        </div>
        <div class="header-line-2 header-scroll-effect">
            <a href="#" class="header-pretitle header-date color-highlight"><!--Date will Appear Here --></a>
            <a href="#" class="header-title">Welcome</a>
            <a href="#" data-menu="menu-find" class="header-icon header-icon-2"><i class="fa fa-search"></i></a>
        </div>
    </div>

    <div class="page-content header-clear-large">

        <div class="slider-margins">
            <div class="single-slider owl-carousel owl-no-dots">
                <?php foreach ($result as $value) { ?>
                <div class="item shadow-small" style="height: 250px;">
                    <div class="above-overlay above-overlay-bottom">
                        <div class="caption-style-1 above-overlay">
                            <a href="{{url('/mobile/single_movie/'.$value->id)}}"><h1 class="bold color-white">{{$value->title}}</h1></a>
                            <div class="image-details bottom-30">
                                <a href="#"><img src="{{asset('assets/mobile/images/empty.png')}}" class="preload-image"
                                                 data-src="{{asset('assets/mobile/images/preload-logo-small.png')}}" alt="img">{{$value->imdbrating}}</a>
                                <a href="#"><i class="fa fa-film"></i>{{$value->print_type}}</a>
                                <a href="#"><i class="fa fa-download"></i>{{$value->total_view}}</a>
                            </div>
                        </div>
                    </div>
                    <div class="overlay overlay-gradient-large"></div>
                    <a href="{{url('/mobile/single_movie/'.$value->id)}}"><img src="{{$value->poster_url_value}}" alt="img"></a>
                </div>
                <?php } ?>

            </div>
        </div>


        <span class="center-text font-10 bottom-20 color-night-light">Swipe me left or right.</span>

        <div class="decoration decoration-margins"></div>
        <!-- Categories Start -->
        <div style="padding-left: 2%;">
            <a href="{{url('mobile/movie_gallery/English')}}">
                <div class="content content-round shadow-medium" style="width: 150px; height: 63px; float: left;">
                    <div class="caption-style-4" style="padding-top: 18px; margin-left: 28px;">
                        <strong>Movies</strong>
                    </div>
                    <div class="overlay bg-black opacity-80"></div>
                    <img src="{{asset('assets/mobile/images/pictures/aw.jpg')}}" class="responsive-image bottom-0" alt="img">
                </div>
            </a>
            <a href="{{url('mobile/tv_gallery/english')}}"><div class="content content-round shadow-medium" style="width: 150px; height: 63px; float: left;">
                <div class="caption-style-4" style="padding-top: 18px; margin-left: 25px;">
                    <strong>TV Series</strong>
                </div>
                <div class="overlay bg-black opacity-80"></div>
                <img src="{{asset('assets/mobile/images/pictures/tf.jpg')}}" class="responsive-image bottom-0" alt="img">
                </div></a>
            <a href="{{url('mobile/Pc Games')}}"><div class="content content-round shadow-medium" style="width: 150px; height: 63px; float: left;">
                <div class="caption-style-4" style="padding-top: 18px; margin-left: 20px;">
                    <strong>Pc Games</strong>
                </div>
                <div class="overlay bg-black opacity-80"></div>
                <img src="{{asset('assets/mobile/images/pictures/mv.jpg')}}" class="responsive-image bottom-0" alt="img">
                </div></a>
            <a href="{{url('mobile/cartoon_gallery')}}"><div class="content content-round shadow-medium" style="width: 150px; height: 63px; float: left;">
                <div class="caption-style-4" style="padding-top: 18px; margin-left: 22px;">
                    <strong>Cartoons</strong>
                </div>
                <div class="overlay bg-black opacity-80"></div>
                <img src="{{asset('assets/mobile/images/pictures/cn.jpg')}}" class="responsive-image bottom-0" alt="img">
            </div>
            </a>
        </div>

        <!--Categories End  -->

        <div class="content">
            <div class="decoration"></div>

            <div class="icon-column">


            </div>


            <!-- Movie Carousal Start -->

            <div class="content-title bottom-20">
                <span class="color-highlight">Only the Best</span>
                <h1><i class="fa fa-film"></i> Movies</h1>
                <a href="{{url('mobile/movie_gallery/English')}}" class="color-highlight">See All</a>
            </div>

            <div class="slider-margins">
                <div class="double-slider owl-carousel bottom-10 owl-no-dots">

                    <?php foreach ($result as $value){ ?>
                        <div class="item">
                            <div>
                                <div class="above-overlay above-overlay-bottom">
                                    <h5 class="color-white">{{$value->title}}</h5>
                                    <div class="image-details bottom-20">
                                        <a href="#"><img src="{{asset('assets/mobile/images/preload-logo-small.png')}}" alt="img">{{$value->imdbrating}}</a>
                                        <a href="#"><i class="fa fa-download"></i>{{$value->total_view}}</a>
                                    </div>
                                </div>
                                <div class="overlay overlay-gradient"></div>
                                <a href="{{url('/mobile/single_movie/'.$value->id)}}"><img height="220px" src="{{$value->poster_url_value}}" alt="img" class="responsive-image"></a>
                            </div>
                        </div>

                    <?php } ?>

                </div>
            </div>

            <div class="decoration decoration-margins"></div>
            <!-- Movie Carousal End -->

            <!-- Tv Series Start -->
            <div class="content-title bottom-30">
                <span class="color-highlight">Best Quality</span>
                <h1><i class="fa fa-music"></i> Tv Series </h1>
                <a href="{{url('mobile/tv_gallery/english')}}" class="color-highlight">See All</a>
            </div>

            <div class="slider-margins bottom-30">
                <div class="double-slider owl-carousel owl-no-dots">
                    <?php foreach ($tv as $value) { ?>
                        <div class="item">
                            <div>
                                <div class="above-overlay above-overlay-bottom">
                                    <h5 class="color-white">{{$value->title}}</h5>
                                    <div class="image-details bottom-20">
                                        <a href="#"><img src="{{asset('assets/mobile/images/preload-logo-small.png')}}" alt="img">{{$value->imdbrating}}</a>
                                        <a href="#"><i class="fa fa-download"></i>{{$value->total_view}}</a>
                                    </div>
                                </div>
                                <div class="overlay overlay-gradient"></div>
                                <a href="{{url('/mobile/single_tv/'.$value->id)}}"><img height="220px" src="{{$value->poster_url_value}}" alt="img" class="responsive-image"></a>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>

            <div class="decoration decoration-margins"></div>
            <!-- Music Video End -->
            <div class="decoration decoration-margins"></div>
            <!--Advertisement End -->
            <div class="decoration decoration-margins"></div>
            <!-- TV Series Carousal End -->

            <!-- Cartoon Start -->
            <div class="content-title bottom-20">
                <span class="color-highlight">Only the Best</span>
                <h1><i class="fa fa-film"></i> Games </h1>
                <a href="{{url('mobile/Pc Games')}}" class="color-highlight">See All</a>
            </div>

            <div class="slider-margins bottom-30">
                <div class="double-slider owl-carousel owl-no-dots">
                    <?php foreach ($game as $value) { ?>
                        <div class="item">
                            <div>
                                <div class="above-overlay above-overlay-bottom">
                                    <h5 class="color-white">{{$value->title}}</h5>
                                    <div class="image-details bottom-20">
                                        <a href="#"><img src="{{asset('assets/mobile/images/preload-logo-small.png')}}" alt="img">{{$value->igdbrating}}</a>
                                        <a href="#"><i class="fa fa-download"></i>{{$value->total_view}}</a>
                                    </div>
                                </div>
                                <div class="overlay overlay-gradient"></div>
                                <a href="{{url('/mobile/single_game/'.$value->id)}}"><img height="220px" src="{{$value->poster_url_value}}" alt="img" class="responsive-image"></a>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>

            <!-- Cartoon Start -->
            <div class="content-title bottom-20">
                <span class="color-highlight">Only the Best</span>
                <h1><i class="fa fa-film"></i> Cartoon </h1>
                <a href="{{url('mobile/cartoon_gallery')}}" class="color-highlight">See All</a>
            </div>

            <div class="slider-margins bottom-30">
                <div class="double-slider owl-carousel owl-no-dots">
                    <?php foreach ($tv_anim as $value) { ?>
                        <div class="item">
                            <div>
                                <div class="above-overlay above-overlay-bottom">
                                    <h5 class="color-white">{{$value->title}}</h5>
                                    <div class="image-details bottom-20">
                                        <a href="#"><img src="{{asset('assets/mobile/images/preload-logo-small.png')}}" alt="img">{{$value->imdbrating}}</a>
                                        <a href="#"><i class="fa fa-download"></i>{{$value->total_view}}</a>
                                    </div>
                                </div>
                                <div class="overlay overlay-gradient"></div>
                                <a href="{{url('/mobile/single_tv/'.$value->id)}}"><img height="220px" src="{{$value->poster_url_value}}" alt="img" class="responsive-image"></a>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>

            <div class="content"><a href="{{url('mobile/others')}}"><img style="border-radius: 14px;-webkit-box-shadow: 10px 10px 130px -9px rgba(0,0,0,0.55);
-moz-box-shadow: 10px 10px 130px -9px rgba(0,0,0,0.55);
box-shadow: 10px 10px 130px -9px rgba(0,0,0,0.55);" width="100%" src="{{asset('assets/images/others.jpg')}}"></a></div>

<div class="content"><a href="{{url('live_tv')}}"><img style="border-radius: 14px;-webkit-box-shadow: 10px 10px 130px -9px rgba(0,0,0,0.55);
-moz-box-shadow: 10px 10px 130px -9px rgba(0,0,0,0.55);
box-shadow: 10px 10px 130px -9px rgba(0,0,0,0.55);" width="100%" src="{{asset('assets/images/tv_mobile.jpg')}}"></a></div>


<div class="content"><a href="http://103.102.27.172"><img style="border-radius: 14px;-webkit-box-shadow: 10px 10px 130px -9px rgba(0,0,0,0.55);
-moz-box-shadow: 10px 10px 130px -9px rgba(0,0,0,0.55);
box-shadow: 10px 10px 130px -9px rgba(0,0,0,0.55);" width="100%" src="{{asset('assets/images/tv_mobile.jpg')}}"></a></div>


<div class="decoration decoration-margins"></div>
<!-- Cartoon End -->
<div class="content content-round shadow-medium">
    <a href="tel:+88 0190440314"
       class="vertical-center-button button-right bg-highlight uppercase button-xxs ultrabold button-round">Call
        Us</a>
    <div class="caption-style-4">
        <strong>It's time to upgrade</strong>
        <h1>Get XPLEX <br> For Your ISP</h1>
    </div>
    <div class="overlay bg-black opacity-70"></div>
    <img src="{{asset('assets/mobile/images/pictures/29w.jpg')}}" class="responsive-image bottom-0" alt="img">
</div>


            @extends('layouts.mobile_footer')

        </div>
        <a href="#" class="back-to-top-badge back-to-top-small bg-highlight"><i class="fa fa-angle-up"></i>Back to
            Top</a>
        <div id="menu-share" data-height="420" class="menu-box menu-bottom">
            <div class="menu-title">
                <span class="color-highlight">Just tap to share</span>
                <h1>Sharing is Caring</h1>
                <a href="#" class="menu-hide"><i class="fa fa-times"></i></a>
            </div>
            <div class="sheet-share-list">
                <a href="#" class="shareToFacebook"><i class="fab fa-facebook-f bg-facebook"></i><span>Facebook</span><i
                            class="fa fa-angle-right"></i></a>
                <a href="#" class="shareToTwitter"><i class="fab fa-twitter bg-twitter"></i><span>Twitter</span><i
                            class="fa fa-angle-right"></i></a>
                <a href="#" class="shareToLinkedIn"><i
                            class="fab fa-linkedin-in bg-linkedin"></i><span>LinkedIn</span><i
                            class="fa fa-angle-right"></i></a>
                <a href="#" class="shareToGooglePlus"><i
                            class="fab fa-google-plus-g bg-google"></i><span>Google +</span><i
                            class="fa fa-angle-right"></i></a>
                <a href="#" class="shareToPinterest"><i
                            class="fab fa-pinterest-p bg-pinterest"></i><span>Pinterest</span><i
                            class="fa fa-angle-right"></i></a>
                <a href="#" class="shareToWhatsApp"><i class="fab fa-whatsapp bg-whatsapp"></i><span>WhatsApp</span><i
                            class="fa fa-angle-right"></i></a>
                <a href="#" class="shareToMail no-border bottom-5"><i
                            class="fas fa-envelope bg-mail"></i><span>Email</span><i class="fa fa-angle-right"></i></a>
            </div>
        </div>
    </div>
</div>
    <script type="text/javascript" src="{{asset('assets/mobile/scripts/jquery.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/mobile/scripts/plugins.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/mobile/scripts/custom.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/mobile/scripts/simplebar.js')}}"></script>
</body>
</html>

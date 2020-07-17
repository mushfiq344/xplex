<!DOCTYPE html>
<!--
  Name: Youplay - Game Template based on Bootstrap
  Version: 3.0.0
  Author: nK
  Website: http://nkdev.info
  Support: http://nk.ticksy.com
  Purchase: http://themeforest.net/item/youplay-game-template-based-on-bootstrap/11306207?ref=_nK
  License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
  Copyright 2016.
-->
<html>


<!-- Mirrored from html.nkdev.info/youplay/dark/ by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 26 May 2016 12:39:47 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Samonline</title>

    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--Rashik added code for glyphoicon-->

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- Icon -->
    <link rel="icon" type="image/png" href="assets/images/icon.png">
    <!-- Google Fonts -->

    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>

    <!-- Bootstrap -->
    <link rel="stylesheet" type="text/css" href="{{asset('../assets/bower_components/bootstrap/dist/css/bootstrap.min.css')}}" />

    <!-- FontAwesome -->
    <link rel="stylesheet" type="text/css" href="{{asset('../assets/bower_components/font-awesome/css/font-awesome.min.css')}}" />

    <!-- Owl Carousel -->
    <link rel="stylesheet" type="text/css" href="{{asset('../assets/bower_components/owl.carousel/dist/assets/owl.carousel.min.css')}}" />
    <!-- Youplay -->

    <link rel="stylesheet" type="text/css" href="{{asset('../assets/youplay/css/youplay.min.css')}}" />

    <!-- Custom Styles -->
    <link rel="stylesheet" type="text/css" href="assets/css/custom.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/animate.css@3.5.2/animate.min.css">

    <!-- Magnific Popup -->
    <link rel="stylesheet" type="text/css" href="{{asset('../assets/bower_components/magnific-popup/dist/magnific-popup.css')}}" />

    <!-- RTL (uncomment this to enable RTL support) -->
    <!-- <link rel="stylesheet" type="text/css" href="../assets/youplay/css/youplay-rtl.css" /> -->

</head>


<body>

<!-- Preloader -->
<!-- /Preloader -->

<!-- Navbar -->
<nav class="navbar-youplay navbar navbar-default navbar-fixed-top ">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="off-canvas" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.blade.php">
                <img src="assets/images/logo.png" alt="">
            </a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="dropdown dropdown-hover ">
                    <a href="#!" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        Movies <span class="caret"></span> <span class="label">games</span>
                    </a>
                    <div class="dropdown-menu">
                        <ul role="menu">
                            <li><a href="store-1.html">IMDB-250</a>
                            </li>
                            <li><a href="store-2.html">3D Movies</a>
                            </li>
                            <li><a href="store-2.html">Bangla</a>
                            </li>
                            <li><a href="store-2.html">English</a>
                            </li>
                        </ul>
                        <ul role="menu">
                            <li><a href="store-2.html">Hindi</a>
                            </li>
                            <li><a href="store-2.html">South Indian</a>
                            </li>
                            <li><a href="store-2.html">Animation</a>
                            </li>
                            <li><a href="store-2.html">Foreign Movies</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="dropdown dropdown-hover ">
                    <a href="#!" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        TV-SERIES <span class="caret"></span> <span class="label">news</span>
                    </a>
                    <div class="dropdown-menu">
                        <ul role="menu">
                            <li><a href="blog-1.html">English</a>
                            </li>
                            <li><a href="blog-2.html">Cartoon</a>
                            </li>

                        </ul>
                        <ul role="menu">
                            <li><a href="blog-post-1.html">Award & Tv Shows</a>
                            </li>
                            <li><a href="blog-post-2.html">WWE Wrestling</a>
                            </li>

                        </ul>
                    </div>
                </li>
                <li class="dropdown dropdown-hover ">
                    <a href="#!" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        Games <span class="caret"></span> <span class="label">full list</span>
                    </a>
                    <div class="dropdown-menu">
                        <ul role="menu">
                            <li class="dropdown dropdown-submenu pull-left ">
                                <a href="#!" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">PC Games<span class="badge bg-default">New</span></a><!--Submenu-->
                                <div class="dropdown-menu">
                                    <ul role="menu">
                                        <li><a href="store-1.html">Action</a><!--Menu-->
                                        </li>
                                        <li><a href="user-profile.html">Adventure</a>
                                        </li>
                                        <li><a href="user-messages.html">Strategy</a>
                                        </li>
                                        <li><a href="user-messages-compose.html">RPG</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li><a href="forums.html">Android Games</a>
                            </li>
                            <li><a href="forums.html">Console Games</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="dropdown dropdown-hover ">
                    <a href="#!" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        Software <span class="caret"></span> <span class="label">full list</span>
                    </a>
                    <div class="dropdown-menu">
                        <ul role="menu">
                            <li><a href="forums.html">Operating Systems</a>
                            </li>
                            <li><a href="forums-topics.html">Media Players</a>
                            </li>
                            <li><a href="cart.html">Office Softwares</a>
                            </li>
                            <li><a href="matches-list.html">Driver Collection</a>
                            </li>
                            <li><a href="match.html">Graphics & Design</a>
                            </li>
                            <li><a href="match-2.html">Video Editing</a>
                            </li>
                        </ul>
                        <ul role="menu">
                            <li><a href="widgets.html">Ebook Reader <span class="badge bg-default">New</span></a>
                            </li>
                            <li><a href="components.html">Programming</a>
                            </li>
                            <li><a href="coming-soon.html">Browsers</a>
                            </li>
                            <li><a href="contact.html">Utllities</a>
                        </ul>
                    </div>
                </li>
                <li class="dropdown dropdown-hover ">
                    <a href="#!" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        Others <span class="caret"></span> <span class="label">full list</span>
                    </a>
                    <div class="dropdown-menu">
                        <ul role="menu">
                            <li><a href="forums.html">Documentery</a>
                            </li>
                            <li><a href="forums-topics.html">Tutorials</a>
                        </ul>
                    </div>
                </li>
                <li class="dropdown dropdown-hover ">
                    <a href="{{ URL::to('live_tv') }}" role="button" aria-expanded="false" style="color: #15FF58">
                        Live TV <span class="label">full list</span>
                    </a>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown dropdown-hover">
                    <a href="#!" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        Xbit Studio <span class="badge bg-default">2</span> <span class="caret"></span> <span class="label">Logged in</span>
                    </a>
                    <div class="dropdown-menu">
                        <ul role="menu">
                            <li><a href="http://html.nkdev.info/youplay/documentation">Documentation</a>
                            </li>
                            <li><a href="http://themeforest.net/item/youplay-game-template-based-on-bootstrap/11306207?ref=_nK">Purchase</a>
                            </li>
                            <li class="divider"></li>

                            <li><a href="user-profile.html">Profile <span class="badge pull-right bg-warning">13</span></a>
                            </li>
                            <li><a href="cart.html">My Cart <span class="badge pull-right bg-default">3</span></a>
                            </li>
                            <li class="divider"></li>

                            <li><a href="login.html">Log Out</a>
                            </li>
                            <li class="dropdown dropdown-submenu pull-left">
                                <a href="#!" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">More..</a>
                                <div class="dropdown-menu">
                                    <ul role="menu">
                                        <li><a href="#!">3rd level</a>
                                        </li>
                                        <li><a href="#!">3rd level</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a class="search-toggle" href="search.html">
                        <i class="fa fa-search"></i>
                    </a>
                </li>
                <li class="dropdown dropdown-hover dropdown-cart">
                    <a href="#!" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        <i class="fa fa-shopping-cart"></i>
                    </a>
                    <div class="dropdown-menu" style="width: 300px;">
                        <div class="row youplay-side-news">
                            <div class="col-xs-3 col-md-4">
                                <a href="#" class="angled-img">
                                    <div class="img">

                                        <img src="assets/images/game-bloodborne-500x375.jpg" alt="">
                                    </div>
                                </a>
                            </div>
                            <div class="col-xs-9 col-md-8">
                                <a href="#" style="text-decoration: none;" class="pull-right mr-10"><i class="fa fa-times"></i></a>

                                <h4 class="ellipsis"><a href="#">Bloodborne</a></h4>
                                <span class="quantity">1 × <span class="amount">$50.00</span></span>
                            </div>
                        </div>

                        <div class="row youplay-side-news">
                            <div class="col-xs-3 col-md-4">
                                <a href="#" class="angled-img">
                                    <div class="img">

                                        <img src="assets/images/game-kingdoms-of-amalur-reckoning-500x375.jpg" alt="">
                                    </div>
                                </a>
                            </div>
                            <div class="col-xs-9 col-md-8">
                                <a href="#" style="text-decoration: none;" class="pull-right mr-10"><i class="fa fa-times"></i></a>

                                <h4 class="ellipsis"><a href="#">Kingdoms of Amalur</a></h4>
                                <span class="quantity">1 × <span class="amount">$20.00</span></span>
                            </div>
                        </div>

                        <div class="ml-20 mr-20 pull-right"><strong>Subtotal:</strong>  <span class="amount">$70.00</span>
                        </div>

                        <div class="btn-group pull-right m-15">
                            <a href="#" class="btn btn-default btn-sm">View Cart</a>
                            <a href="#" class="btn btn-default btn-sm">Checkout</a>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
</body>
</html>
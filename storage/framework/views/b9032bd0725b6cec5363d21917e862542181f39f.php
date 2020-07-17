<!DOCTYPE html>
<html>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo e(config('app.name', 'Laravel')); ?></title>

    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- Icon -->
    <link rel="icon" type="image/png" href="<?php echo e(asset('default_images/favicon.png')); ?>">
    <!-- Google Fonts -->

    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>

    <!-- Bootstrap -->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('../assets/bower_components/bootstrap/dist/css/bootstrap.min.css')); ?>" />

    <!-- FontAwesome -->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('../assets/bower_components/font-awesome/css/font-awesome.min.css')); ?>" />

    <!-- Magnific Popup -->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('../assets/bower_components/magnific-popup/dist/magnific-popup.css')); ?>" />

    <!-- Social Likes -->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('../assets/bower_components/social-likes/dist/social-likes_flat.css')); ?>" />
    <!-- Youplay -->

    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('../assets/youplay/css/youplay.min.css')); ?>" />

    <!-- Custom Styles -->
    <link rel="stylesheet" type="text/css" href="<?php echo e("assets/css/custom.css"); ?>" />

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css" integrity="sha384-/rXc/GQVaYpyDdyxK+ecHPVYJSN9bmVFBvjA/9eOB+pb3F2w2N6fc5qB9Ew5yIns" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Titillium+Web" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo e(asset('/css/demo.css')); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style type="text/css">
        body {
            background-color: white;
        }

        /* The Modal (background) */
        .movie_modal {
            display: none;
            /* Hidden by default */
            position: fixed;
            /* Stay in place */
            z-index: 1;
            /* Sit on top */
            padding-top: 100px;
            /* Location of the box */
            left: 0;
            top: 0;
            width: 100%;
            /* Full width */
            height: 100%;
            /* Full height */
            overflow: hidden;
            background-color: rgb(0, 0, 0);
            /* Fallback color */
            background-color: rgba(0, 0, 0, .9);
            /* Black w/ opacity */
        }

        /* Modal Content */
        .movie_modal-content {
            width: 100%;
            margin: auto;
            background-color: rgba(0, 0, 0, 0);
        }

        /* The Close Button */
        .close {
            color: white;
            float: right;
            font-size: 38px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            text-decoration: none;
            cursor: pointer;
            color: #fff;
        }

        .videoWrapper {
            position: relative;
            padding-bottom: 56.25%;
            /* 16:9 */
            padding-top: 25px;
            height: 0;
        }

        .videoWrapper iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        .container-login {
            position: relative;
            text-align: center;
            color: white;
            border-radius: 10px;

        }

        .centered {
            position: absolute;
            top: 60%;
            left: 42%;
            transform: translate(-50%, -50%);
            border-radius: 10px;
            -webkit-box-shadow: 10px 10px 130px -9px rgba(0, 0, 0, 0.55);
            -moz-box-shadow: 10px 10px 130px -9px rgba(0, 0, 0, 0.55);
            box-shadow: 10px 10px 130px -9px rgba(0, 0, 0, 0.55);
        }
    </style>
</head>

<body>

    <!-- Preloader -->


    <!-- /Preloader -->

    <!-- Navbar -->
    

    

    <section class="content-wrap">
        <!-- Banner -->

        <div class="youplay-banner banner-top youplay-banner-parallax">
            <div class="image" id="main_image">
                <?php
                $url = substr($result->trailer_value, -11);
                $name = $result->title;
                $download_link = explode("$$", $result->download_link);
                $a = '"https://www.youtube.com/embed/' . $url;
                $url_value = $a . '?rel=1&amp;autoplay=1&loop=1&playlist=' . $url . '&amp;controls=0&amp;showinfo=0;mute=1" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen';
                ?>
                <div class="videoWrapper">
                    <iframe id="iframe" width="560" height="349" src=<?php echo $url_value; ?>></iframe>
                    <div class="overlay_slide">
                    </div>
                </div>
            </div>

            <div class="info">
                <div>
                    <div class="container" style="margin-left: 10%">
                        <div class="row">
                            <div class="img col-md-4">
                                <img class="sround" id="poster_img" src="<?php echo e(asset($result->poster_url_value)); ?>" alt="">
                            </div>
                            <div class="col-md-7">
                                <p style="font-size: 22px;"><i class="fas fa-film"></i> Plot: </p>
                                <p><?php echo e($result->plot); ?></p>

                                <div class="youplay-review-rating">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="col-lg-4" style="padding-top: 10%;">
                                                <img class="rating_img img-responsive" src="<?php echo e(asset('assets/images/IMDb.ico')); ?>">
                                            </div>
                                            <div class="col-lg-8">
                                                <div class="youplay-hexagon-rating" data-max="10" data-size="80">
                                                    <span><?php echo e(substr($result->imdbrating,0,3)); ?></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="col-lg-4" style="padding-top: 10%;">
                                                <img class="rating_img img-responsive" src="<?php echo e(asset('assets/images/rottenTomatoes.png')); ?>">
                                            </div>
                                            <div class="col-lg-8">
                                                <div class="youplay-hexagon-rating" data-max="100" data-size="80">
                                                    <span><?php echo e($result->rottentomatoesrating); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="col-lg-4" style="padding-top: 10%;">
                                                <img class="rating_img img-responsive" src="<?php echo e(asset('assets/images/metacritic.png')); ?>">
                                            </div>
                                            <div class="col-lg-8">
                                                <div class="youplay-hexagon-rating" data-max="100" data-size="80">
                                                    <span><?php echo e($result->metacriticrating); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <p><i class="fas fa-video"></i> Cast:</p>
                                <p style="color: #0c5460"><?php
                                                            $actors = explode(',', $result->actors);
                                                            foreach ($actors as $actors_value) {
                                                                echo "<a class='actor' href=";
                                                                echo ('/movie/actors/' . urlencode(trim($actors_value)));
                                                                echo ">";
                                                                echo $actors_value;
                                                                echo "</a>";
                                                            }
                                                            ?> </p>
                                <p><i class="fas fa-user-secret"></i> Director: </p>
                                <p><a href="<?php echo e(url('/movie/director',[$result->director])); ?>"> <?php echo e($result->director); ?></a></p>
                                <p><i class="fas fa-folder-open"></i> Genre: </p>
                                <?php echo e($result->genre); ?>

                                <p><i class="fas fa-bullhorn"></i> Released: </p>
                                <?php echo e($result->released); ?>

                            </div>
                            <div class="col-md-1" style="padding-top: 38%">
                                <a href="<?php echo e($result->trailer_value); ?>" class="btn btn-primary video-popup">Show Trailer</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- /Banner -->
        <div class="container-fluid" id="container" elemType="movie" elemId="<?php echo e($result->id); ?>" style="margin: 20px">
            <div class="row">
                <div class="col-lg-9">
                    <?php
                    if ($first_copy != "N/A") {
                    ?>
                        <video poster="<?php echo e($result->cover_url_value); ?>" class="centered-and-cropped" style="border-radius: 10px;margin-top: 3px" type='video/x-matroska; codecs="theora, vorbis"' autoplay controls id="video_player" controls controlsList="nodownload" link="<?php echo e($first_copy); ?>">
                            <source id="player_source" src="<?php echo e($first_copy); ?>">
                            Your browser does not support HTML5 video.
                        </video>

                    <?php } ?>


                    <div style="margin: 50px 10px 10px 10px">
                        
                        <h3>File List</h3>
                        <div class="file_list" style="font-size: 16px; margin: 20px">
                            <table class="table  table-hover" style="width: 91%">
                                <tbody>
                                    <?php
                                    foreach ($links as $link) {

                                    ?>
                                        <tr>
                                            <td>
                                                <?php echo e($link); ?>

                                            </td>

                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="side-block">
                        <p style="font-size: 22px;">Popular Movies</p>
                        <div class="block-content p-0">
                            <!-- Single News Block -->
                            <?php
                            $i = 0;
                            foreach ($most_popular as $popular) {
                                $i++;
                            ?>
                                <div class="row youplay-side-news">
                                    <div class="col-xs-3 col-md-4">
                                        <a href="<?php echo e(url('/movie',[$popular->id])); ?>">
                                            <div class="img">
                                                <img style="border-radius: 10px" class="rating_img img-responsive" width="100%" src="<?php echo e(asset($popular->poster_url_value)); ?>" alt="">
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-xs-9 col-md-8">
                                        <h4 class="ellipsis"><a href="<?php echo e(url('/movie',[$popular->id])); ?>" title="Popular Title"><?php echo e($popular->title); ?></a></h4>
                                        <h6><i class="fa fa fa-bullhorn"></i> <?php echo e($popular->released); ?></h6>
                                        <h6 style="color: #15FF58"><i class="fa fa-star"></i> <?php echo e($popular->imdbrating); ?></h6>
                                        <h6><i class="fa fa fa-folder-open"></i> <?php echo e($popular->genre); ?></h6>
                                        <h6><i class="fa fa fa-eye"></i> <?php echo e($popular->total_view); ?></h6>
                                    </div>
                                </div>

                            <?php
                                if ($i == 6)
                                    break;
                            } ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>

        <!-- Footer -->
        
        <!-- /Footer -->
    </section>
    <!-- /Search Block -->

    <!-- jQuery -->
    <script type="text/javascript" src="<?php echo e(asset('../assets/bower_components/jquery/dist/jquery.min.js')); ?>"></script>

    <!-- Hexagon Progress -->
    <script type="text/javascript" src="<?php echo e(asset('../assets/bower_components/HexagonProgress/jquery.hexagonprogress.min.js')); ?>"></script>


    <!-- Bootstrap -->
    <script type="text/javascript" src="<?php echo e(asset('../assets/bower_components/bootstrap/dist/js/bootstrap.min.js')); ?>"></script>

    <!-- Jarallax -->
    <script type="text/javascript" src="<?php echo e(asset('./assets/bower_components/jarallax/dist/jarallax.min.js')); ?>"></script>

    <!-- Smooth Scroll -->
    <script type="text/javascript" src="<?php echo e(asset('../assets/bower_components/smoothscroll-for-websites/SmoothScroll.js')); ?>"></script>

    <!-- Magnific Popup -->
    <script type="text/javascript" src="<?php echo e(asset('../assets/bower_components/magnific-popup/dist/jquery.magnific-popup.min.js')); ?>"></script>
    <!-- Social Likes -->
    <script type="text/javascript" src="<?php echo e(asset('../assets/bower_components/social-likes/dist/social-likes.min.js')); ?>"></script>
    <!-- Youplay -->
    <script type="text/javascript" src="<?php echo e(asset('../assets/youplay/js/youplay.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('../assets/youplay/js/comment.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('../assets/youplay/js/search.js')); ?>"></script>

    <script>
        var isChrome = 0;
        var isChromium = window.chrome;
        var winNav = window.navigator;
        var vendorName = winNav.vendor;
        var isOpera = typeof window.opr !== "undefined";
        var isIEedge = winNav.userAgent.indexOf("Edge") > -1;
        var isIOSChrome = winNav.userAgent.match("CriOS");
        if (isIOSChrome) {
            // is Google Chrome on IOS
        } else if (
            isChromium !== null &&
            typeof isChromium !== "undefined" &&
            vendorName === "Google Inc." &&
            isOpera === false &&
            isIEedge === false
        ) {
            // is Google Chrome
            isChrome = 1;
        } else {
            isChrome = 0;
        }
    </script>

    <script>
        var video = document.getElementById("video_player");
        var src = video.getAttribute("link");
        if (isChrome == 0 && src.includes("mkv")) {
            alert("This video is only playable in Chrome Browser!");
        } else if (src.includes("avi")) {
            alert("This video is not playable in browser!");
        }
    </script>
    <script>
        function play_video(id) {
            var video = document.getElementById("video_player");

            if (id.includes("avi")) {
                alert("This file is not playable!");
            } else if (isChrome == 0 && src.includes("mkv")) {
                alert("This file is only playable in Chrome Browser");
            } else {
                video.src = id;
                video.load();
                video.scrollIntoView({
                    behavior: "smooth"
                });
            }
        }
    </script>


    <script>
        if (typeof youplay !== 'undefined') {
            youplay.init({
                // enable parallax
                parallax: true,

                // set small navbar on load
                navbarSmall: false,

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


</body>


<!-- Mirrored from html.nkdev.info/youplay/dark/blog-post-1.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 26 May 2016 12:53:28 GMT -->

</html>
<?php echo $__env->make('layouts.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('layouts.navbar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
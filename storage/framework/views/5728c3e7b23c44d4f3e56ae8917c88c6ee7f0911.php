<!DOCTYPE html>
<html>
<meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo e(config('app.name', 'Laravel')); ?></title>

    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- Icon -->
    <link rel="icon" type="image/png" href="<?php echo e(asset('default_images/favicon.png')); ?>">
    <!-- Google Fonts -->

    <link href='<?php echo e(asset('http://fonts.googleapis.com/css?family=Lato:300,400,700')); ?>' rel='stylesheet' type='text/css'>

    <!-- Bootstrap -->
    <link rel="stylesheet" type="text/css"
          href="<?php echo e(asset('../assets/bower_components/bootstrap/dist/css/bootstrap.min.css')); ?>"/>
    <!-- Youplay -->

    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('../assets/youplay/css/youplay.min.css')); ?>"/>

    <!-- Custom Styles -->
    <link rel="stylesheet" href="<?php echo e(asset('https://cdn.jsdelivr.net/npm/animate.css@3.5.2/animate.min.css')); ?>">

    <script src="<?php echo e(asset('https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js')); ?>"></script>
    <link href="https://fonts.googleapis.com/css?family=Titillium+Web" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/hover.css')); ?>">
    <!-- popup -->
    <link rel="stylesheet" type="text/css"
          href="<?php echo e(asset('../assets/bower_components/magnific-popup/dist/magnific-popup.css')); ?>"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css"
          integrity="sha384-/rXc/GQVaYpyDdyxK+ecHPVYJSN9bmVFBvjA/9eOB+pb3F2w2N6fc5qB9Ew5yIns" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


</head>

<body>
<!-- Preloader -->
<!-- /Preloader -->

<!-- Navbar -->



<!-- Main Content -->
<br><br><br>
<section class="content-wrap">

    <div class="container-fluid youplay-store store-grid" id="galleryCategory" category="<?php echo e($category); ?>"
         type="<?php echo e($type); ?>">

        <h4><?php echo e(strtoupper($item)); ?> > <?php echo e(strtoupper($type)); ?> > <?php echo e(strtoupper($category)); ?> </h4>

        <!-- Games List -->
        <div class="col-md-9">
            <!-- Sort Categories -->
            <ul class="pagination">
                <li data-filter="sob" id="all_data"><span>A-Z</span>
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
                <div class="item col-lg-2 col-md-4 col-xs-6 active" data-filters="sob">
                    <a id="id" href="<?php echo e(url('movie',[$value->id])); ?>" class="angled-img">
                        <div class="img img-offset">
                            <div class="box">
                                <img id="poster_image" src="<?php echo e(asset($value->poster_url_value)); ?>" alt="">
                                <div class="box-content" style="margin-top:5%; font-style: bold;">
                                    <h3 class="title"><i class="fas fa-film"></i> <?php echo e($value->title); ?> </h3>
                                    <span class="post">Rotten Tomatoes: <?php echo e($value->rottentomatoesrating); ?></span>
                                    <?php
                                    $chars_replace = array("$$");
                                    ?>
                                    <span class="post">IMDB: <?php echo e($value->imdbrating); ?></span>
                                    <span class="post">Quality: <?php echo e(str_replace($chars_replace," ",$value->print_type)); ?></span>
                                    <br>
                                    <br>
                                    <ul class="icon">
                                        <li><a class="video-popup" href="<?php echo e($value->trailer_value); ?>"><i
                                                        class="fa fa-play"> Trailer</i></a></li>
                                    </ul>
                                </div>
                            </div>
                            
                            <div class="bottom-info">
                                <h4 id="title"><?php echo e($value->title); ?></h4>
                            </div>
                            <?php
                            if(strpos($value->print_type, '$$'))
                            {
                            $print = explode('$$', $value->print_type);
                            ?>

                            <div class="badge bg-default">
                                <?php echo e($print[0]); ?>

                            </div>
                            <div class="badge bg-default-1080">
                                <?php echo e($print[1]); ?>

                            </div>
                            <?php }
                            else { ?>
                            <div class="badge bg-default">
                                <?php echo e($value->print_type); ?>

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
                    <?php for($i=0; $i<sizeof($genre)-3;$i++){ ?>
                    

                    <div class="col-md-4">
                        <a href="<?php echo e(url('/galleryGenreMovie',['movie','all',$genre[$i]->genre_type])); ?>"><?php echo e($genre[$i]->genre_type); ?></a>
                    </div>

                    <div class="col-md-4">
                        <a href="<?php echo e(url('/galleryGenreMovie',['movie','all',$genre[$i+1]->genre_type])); ?>"><?php echo e($genre[$i+1]->genre_type); ?></a>
                    </div>

                    <div class="col-md-4">
                        <a href="<?php echo e(url('/galleryGenreMovie',['movie','all',$genre[$i+2]->genre_type])); ?>"><?php echo e($genre[$i+2]->genre_type); ?></a>
                    </div>
                    <br>
                    <?php $i = $i+3; } ?>
                </ul>
                <br>
                <br>
                <br>

                <h4 class="block-title">Year</h4>
                <ul class="block-content">
                    <?php $year = array_reverse($year, true) ?>

                    <?php for($i = 0;$i < sizeof($year);$i++){
                    $year_data = $year[$i];
                    ?>
                    <div class="col-md-3" style="border: 1px solid white"><a
                                href="<?php echo e(url('/galleryYearMovie',['movie',$type,'all',$year[$i]])); ?>"><?php echo e($year[$i]); ?></a>
                    </div>
                    <?php if(isset($year[$i + 1])){ ?>
                    <div class="col-md-3" style="border: 1px solid white"><a
                                href="<?php echo e(url('/galleryYearMovie',['movie',$type,'all',$year[$i+1]])); ?>"><?php echo e($year[$i+1]); ?></a>
                    </div>
                    <?php } ?>

                    <?php if(isset($year[$i + 2])){ ?>
                    <div class="col-md-3" style="border: 1px solid white"><a
                                href="<?php echo e(url('/galleryYearMovie',['movie',$type,'all',$year[$i+2]])); ?>"><?php echo e($year[$i+2]); ?></a>
                    </div>
                    <?php } ?>

                    <?php if(isset($year[$i + 3])){ ?>
                    <div class="col-md-3" style="border: 1px solid white"><a
                                href="<?php echo e(url('/galleryYearMovie',['movie',$type,'all',$year[$i+3]])); ?>"><?php echo e($year[$i+3]); ?></a>
                    </div>
                    <?php } ?>
                    <?php $i = $i + 4; } ?>
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
                        <?php echo e($result->links('dashboard.paginate')); ?>

                    </div>
                    
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

<script type="text/javascript" src="<?php echo e(asset('../assets/bower_components/jquery/dist/jquery.min.js')); ?>"></script>

<!-- Hexagon Progress -->
<script type="text/javascript"
        src="<?php echo e(asset('./assets/bower_components/HexagonProgress/jquery.hexagonprogress.min.js')); ?>"></script>


<!-- Bootstrap -->
<script type="text/javascript"
        src="<?php echo e(asset('../assets/bower_components/bootstrap/dist/js/bootstrap.min.js')); ?>"></script>

<!-- Jarallax -->
<script type="text/javascript" src="<?php echo e(asset('../assets/bower_components/jarallax/dist/jarallax.min.js')); ?>"></script>

<!-- Smooth Scroll -->
<script type="text/javascript"
        src="<?php echo e(asset('../assets/bower_components/smoothscroll-for-websites/SmoothScroll.js')); ?>"></script>

<!-- Countdown -->
<script type="text/javascript"
        src="<?php echo e(asset('./assets/bower_components/jquery.countdown/dist/jquery.countdown.min.js')); ?>"></script>

<!-- Revolution Slider -->

<!-- ImagesLoaded -->
<script type="text/javascript"
        src="<?php echo e(asset('../assets/bower_components/imagesloaded/imagesloaded.pkgd.min.js')); ?>"></script>

<!-- Isotope -->
<script type="text/javascript" src="<?php echo e(asset('./assets/bower_components/isotope/dist/isotope.pkgd.min.js')); ?>"></script>
<!-- Youplay -->
<script type="text/javascript" src="<?php echo e(asset('../assets/youplay/js/youplay.min.js')); ?>"></script>

<script type="text/javascript" src="<?php echo e(asset('../assets/youplay/js/search.js')); ?>"></script>
<!-- popup -->
<script type="text/javascript"
        src="<?php echo e(asset('../assets/bower_components/magnific-popup/dist/jquery.magnific-popup.min.js')); ?>"></script>

<!-- init youplay -->


<script>
    $category = $('#galleryCategory').attr("category");
    if ($category == "recent") {
        $('#new_data').addClass("active");
    }
    else if ($category == "popular") {
        $('#most_popular_data').addClass("active");
    }
    else if ($category == "imdb") {
        $('#imdb_rating_data').addClass("active");
    }
    else if ($category == "rottentomatoes") {
        $('#rotten_rating_data').addClass("active");
    }
    else if ($category == "all") {
        $('#all_data').addClass("active");
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

<script>
    $(document).ready(function () {
        $('#new_data').click(function () {
            window.location = "<?php echo e(URL::to('/gallery',['movie',$type,'recent'])); ?>";
        });
        $('#most_popular_data').click(function () {
            window.location = "<?php echo e(URL::to('/gallery',['movie',$type,'popular'])); ?>";
        });
        $('#imdb_rating_data').click(function () {
            window.location = "<?php echo e(URL::to('/gallery',['movie',$type,'imdb'])); ?>";
        });
        $('#rotten_rating_data').click(function () {
            window.location = "<?php echo e(URL::to('/gallery',['movie',$type,'rottentomatoes'])); ?>";
        });
        $('#all_data').click(function () {
            window.location = "<?php echo e(URL::to('/gallery',['movie',$type,'all'])); ?>";
        });
    });
</script>

</body>


<!-- Mirrored from html.nkdev.info/youplay/dark/store.blade.php by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 26 May 2016 12:44:32 GMT -->
</html>

<?php echo $__env->make('layouts.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('layouts.navbar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
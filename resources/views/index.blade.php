<html>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{ config('app.name', 'Laravel') }}</title>

  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!--Rashik added code for glyphoicon-->

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <!-- Icon -->

  <link rel="icon" type="image/png" href="{{asset('default_images/favicon.png')}}">

  <!-- Google Fonts -->

  <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>

  <link rel="stylesheet" type="text/css" href="{{asset('../assets/bower_components/bootstrap/dist/css/bootstrap.min.css')}}" /> <!-- Bootstrap -->


  <!-- FontAwesome -->
  <link rel="stylesheet" type="text/css" href="{{asset('../assets/bower_components/font-awesome/css/font-awesome.min.css')}}" />

  <!-- Owl Carousel -->
  <link rel="stylesheet" type="text/css" href="{{asset('../assets/bower_components/owl.carousel/dist/assets/owl.carousel.min.css')}}" />

  <link rel="stylesheet" type="text/css" href="{{asset('../assets/youplay/css/youplay.min.css')}}" />

  <!-- Custom Styles -->
  <link rel="stylesheet" type="text/css" href="assets/css/custom.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/animate.css@3.5.2/animate.min.css">
  <link href="https://fonts.googleapis.com/css?family=Titillium+Web" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="{{asset('css/hover.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('css/carousal.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('../assets/bower_components/magnific-popup/dist/magnific-popup.css')}}" />

</head>

<body>

  <section class="content-wrap" id="body_section">
    <!-- Banner -->
    <div style="padding-top: 40px;">
      <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <!-- Wrapper for slides -->
        <div class="carousel-inner">
          <?php
          $i = 1;
          foreach ($result as $value) {
            if ($i == 1) {
          ?>
              <div class="item active">
              <?php
            } else {
              ?>
                <div class="item">
                <?php
              }
                ?>
                <div class="blur_poster">
                  <img class="centered-and-cropped" width="100%" height="600" src="{{asset($value->cover_url_value)}}" alt="Los Angeles">
                  <div class="overlay_slide"></div>
                </div>
                <div style="position: absolute; top: 10%;left: 10%; color:white; z-index: 3;">
                  <div class="row">
                    <div class="col-md-3 col-sm-3">
                      <img style="float: right; height: 400px; width: 500px" src="{{asset($value->poster_url_value)}}">
                    </div>
                    <div class="col-md-9 col-sm-9 ">
                      <h2 style="font-size: 1.8vw">{{$value->title}} {{'('.$value->year.')'}}</h2>
                      <p style="font-size: 1vw;">{{str_replace(',',' | ',$value->genre)}}</p>
                      <p style="font-size: 1vw;"> <i class="fa fa-star"></i> {{$value->imdbrating}}<span style="padding-left: 10px;"> <i class="fa fa-eye"> {{$value->total_view}}</i></span> </p>
                      <div id="plot">
                        <h2 style="font-size: 1.5vw">Plot:</h2>
                        <p style="width: 600px">
                          {{$value->plot}}
                        </p>
                      </div>
                      <br>
                      <a href="{{url('movie',[$value->id])}}"><button class="btn btn-primary animated infinite bounce"><span style="font-size: 20px;">Download</span></button></a>
                    </div>
                  </div>
                </div>
                </div>
              <?php
              $i++;
            }
              ?>
              </div>
              <!-- Left and right controls -->
              <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="right carousel-control" href="#myCarousel" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
                <span class="sr-only">Next</span>
              </a>
        </div>
      </div>

      <!-- /Banner -->
      {{--Movies--}}
      <!-- Images With Text -->
      <h2 class="container h1 sub">Movies</h2>
      <div class="isotope-list row vertical-gutter">
        <?php foreach ($result as $value) { ?>
          <!-- Single Product Block -->
          <div class="item col-lg-2 col-md-3 col-sm-4 col-xs-6 active" data-filters="sob">
            <a id="id" href="{{url('movie',[$value->id])}}">
              <div>
                <div>
                  <div class="box" style="height: 400px">
                    <img id="poster_image" style="height: 400px" src="{{asset($value->poster_url_value)}}" alt="">
                    <div class="box-content" style="margin-top:5%; font-style: bold;">
                      <h3 class="title"><i class="fas fa-film"></i> {{$value->title}} </h3>
                      <span class="post">Rotten Tomatoes: {{$value->rottentomatoesrating}}</span>
                      <?php
                      $chars_replace = array("$$");
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
                </div>
                {{--Bottom Info--}}
                <div class="bottom-info">
                  <h4 id="title">{{$value->title}}</h4>
                </div>
                <?php
                if (strpos($value->print_type, '$$')) {
                  $print = explode('$$', $value->print_type);
                ?>

                  <div class="badge bg-default">
                    {{$print[0]}}
                  </div>
                  <div class="badge bg-primary">
                    {{ $print[1]}}
                  </div>
                <?php } else { ?>
                  <div class="badge bg-default">
                    {{$value->print_type}}
                  </div>
                <?php } ?>
              </div>
            </a>
          </div>
        <?php } ?>
      </div>
      <a href="{{url('/gallery',['movie','english','all'])}}" class="btn pull-right">See More</a>
      <h2 class="container h1 sub">Games </h2>



      <br>

      <br><br><br>
      <!-- Footer -->
      <br><br>

      <!-- Social Buttons -->
      <!-- /Social Buttons -->

      <!-- Copyright -->

      @extends('layouts.footer')

      <!-- /Copyright -->
    </div>
    </footer>
    <!-- /Footer -->
  </section>

  @extends('layouts.navbar')

  <script type="text/javascript" src="../assets/bower_components/jquery/dist/jquery.min.js"></script>
  <script type="text/javascript" src="../assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

  <!-- Hexagon Progress -->
  <script type="text/javascript" src="../assets/bower_components/HexagonProgress/jquery.hexagonprogress.min.js"></script>

  <script type="text/javascript" src="../assets/bower_components/jarallax/dist/jarallax.min.js"></script>

  <!-- Smooth Scroll -->
  <script type="text/javascript" src="../assets/bower_components/smoothscroll-for-websites/SmoothScroll.js"></script>

  <!-- Owl Carousel -->
  <script type="text/javascript" src="../assets/bower_components/owl.carousel/dist/owl.carousel.min.js"></script>

  <!-- Countdown -->
  <script type="text/javascript" src="../assets/bower_components/jquery.countdown/dist/jquery.countdown.min.js"></script>
  <!-- Youplay -->
  <script type="text/javascript" src="../assets/youplay/js/youplay.min.js"></script>

  <!-- Bootstrap -->
  {{--<script type="text/javascript" src="../assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>--}}
  <script type="text/javascript" src="../assets/youplay/js/search.js"></script>
  {{--<script type="text/javascript" src="../assets/youplay/js/ad.js"></script>--}}
  <script type="text/javascript" src="../assets/youplay/js/youtube.js"></script>
  <script type="text/javascript" src="{{asset('../assets/bower_components/magnific-popup/dist/jquery.magnific-popup.min.js')}}"></script>
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

</html>
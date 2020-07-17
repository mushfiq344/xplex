<html>
<head>
    <link rel="icon" type="image/png" href="assets/images/icon.png">
    <!-- Google Fonts -->
    <!-- Bootstrap -->
    <link rel="stylesheet" type="text/css" href="../assets/bower_components/bootstrap/dist/css/bootstrap.min.css" />

    <!-- FontAwesome -->
    <link rel="stylesheet" type="text/css" href="../assets/bower_components/font-awesome/css/font-awesome.min.css" />

    <!-- Owl Carousel -->
    <link rel="stylesheet" type="text/css" href="../assets/bower_components/owl.carousel/dist/assets/owl.carousel.min.css" />

    <!-- Magnific Popup -->
    <link rel="stylesheet" type="text/css" href="../assets/bower_components/magnific-popup/dist/magnific-popup.css" />

    <!-- Social Likes -->
    <link rel="stylesheet" type="text/css" href="../assets/bower_components/social-likes/dist/social-likes_flat.css" />
    <!-- Youplay -->

    <link rel="stylesheet" type="text/css" href="../assets/youplay/css/youplay.min.css" />

    <!-- Custom Styles -->
    <link rel="stylesheet" type="text/css" href="assets/css/custom.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Titillium+Web" rel="stylesheet">
    <style>
        body {
            background-color: black;
            font-family: 'Montserrat', sans-serif;
        }
    </style>
</head>
<body style="background-color: #000; margin-top:5%">


<div class="container">
    <div class="row">

        <div class="col-lg-3"></div>
        <div class="col-lg-6">
            <img width="50%"  src="{{asset('assets/images/logo.png')}}">
            <h3>Log In With..</h3>
            <br>
            <a href="{{url('/login/google')}}" class="btn btn-danger"><i class="fa fa-google"></i> Google</a>
            <a href="{{url('/facebook')}}" class="btn btn-primary"><i class="fa fa-facebook"></i> Facebook</a>
        </div>
        <div class="col-lg-3"></div>
    </div>


</div>


</body>
</html>
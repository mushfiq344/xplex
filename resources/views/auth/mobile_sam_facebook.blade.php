<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="apple-mobile-web-app-status-bar-style" content="red">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="{{asset('assets/mobile/styles/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/mobile/fonts/css/fontawesome-all.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/mobile/styles/framework.css')}}">
    <link href="https://fonts.googleapis.com/css?family=IBM+Plex+Sans:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i|Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">
</head>

<body>

<div id="page-transitions" class="page-build light-skin highlight-blue">
    <div class="page-content page-content-full">
        <div class=" cover-item cover-item-full">
            <div class="cover-content cover-content-center">
                <div class=" page-login content-boxed content-boxed-padding top-0 bottom-0 bg-white">
                    <img width="250px;" src="{{asset('assets/mobile/images/logo.png')}}">
                    <br>
                    <h1 class="color-black ultrabold top-10 bottom-5 font-27">Hey! you have to register to enjoy our ftp.</h1>

                    <br>
                    <div class="demo-buttons">
                        <a href="{{url('/facebook')}}" class="bg-facebook button-full button-rounded button shadow-medium button-sm button-icon regularbold bottom-10"><i class="fab fa-facebook"></i>Login with Facebook</a>

                        <a href="{{url('/login/google')}}" class="bg-google button-full button-rounded button shadow-medium button-sm button-icon regularbold bottom-10"><i class="fab fa-google"></i>Login with Google</a>
                    </div>

                </div>
            </div>
            <div class="cover-item cover-item-full" style="background-image:url(images/pictures_vertical/bg1.jpg);"></div>
            <div class="cover-overlay overlay bg-black opacity-80"></div>
        </div>

    </div>
</div>


<script type="text/javascript" src="{{asset('assets/mobile/scripts/jquery.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/mobile/scripts/plugins.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/mobile/scripts/custom.js')}}"></script>





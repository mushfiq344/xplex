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


<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$facebook_id  =   $_SESSION['facebook_id'];
$name =        $_SESSION['name'];
$email =    $_SESSION['email'];
$avatar = $_SESSION['avatar'];
?>

<div id="page-transitions" class="page-build light-skin highlight-blue">
    <div class="page-content page-content-full">
        <div class=" cover-item cover-item-full">
            <div class="cover-content cover-content-center" >
                <div class=" page-login content-boxed-padding top-0 bottom-0 bg-white" style="border-radius: 10px;">
                    <form method="post" action="{{route('user_registration')}}">
                        @csrf
                    <br>
                    <img style="border-radius: 50%; display: block; margin-right: auto; margin-left: auto" width="120px;" src="{{$avatar}}">
                    <br>
                    <h1 style="text-align: center; margin-top: 5px;" class="color-black ultrabold top-10 bottom-5 font-27">{{$name}}</h1>
                    <br>
                    <div class="input-simple-1 has-icon input-green"><strong>Required Field</strong><em class="color-highlight" style="font-size: 17px;">Your ISP Username</em><i class="fa fa-user"></i><input id="isp_username" name="isp_username" style="font-size: 15px;" type="text" placeholder="Jonh Doe"></div>
                    <br>
                    <div class="input-simple-1 has-icon input-green"><em class="color-highlight" style="font-size: 17px;">ISP Name</em><i class="fa fa-edit"></i><input id="isp_name" name="isp_name" style="font-size: 15px;" type="text" placeholder="Ex: Samonline..."></div>
                    <br>
                    <div class="input-simple-1 has-icon input-green"><em class="color-highlight" style="font-size: 17px;">Address</em><i class="fa fa-map-marker"></i><input id="address" name="address" style="font-size: 15px;" type="text" placeholder="Ex: Badda, Gulshan...etc"></div>
                    <br>
                    <div class="demo-buttons">
                        <input type="submit" value="submit" onclick="return empty()" style="float: right;"  class="button shadow-medium button-rounded button-blue"></input>
                    </div>
                    </form>
                </div>
            </div>
            <div class="cover-item cover-item-full" style="background-image:url(images/pictures_vertical/bg1.jpg);"></div>
            <div class="cover-overlay overlay bg-black opacity-80"></div>
        </div>
    </div>
</div>

<script>


    function empty() {

        if($('#isp_name').val() == "" || $('#isp_username').val() == "" || $('#address').val() == ""){
            alert('Please fill all fields of the form!');
            return false;
        }

        else {
            return true;
        }

    }


</script>
<script type="text/javascript" src="{{asset('assets/mobile/scripts/jquery.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/mobile/scripts/plugins.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/mobile/scripts/custom.js')}}"></script>



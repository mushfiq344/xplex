<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="viewport"
          content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover"/>
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" type="text/css" href="{{asset('assets/mobile/styles/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/mobile/styles/framework.css')}}">
    <link href="https://fonts.googleapis.com/css?family=IBM+Plex+Sans:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i|Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i"
          rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        ul.pagination li {
            display: inline;
        }
    </style>
</head>
<body>

<div>
    <div class="content">
        <ul class="link-list">
            <?php foreach ($rawlist as $value){
            if($value['type'] == "folder"){
            ?><a style="text-decoration: none" href="{{url($value['path'])}}"><i
                        style="font-size:24px;padding-right: 10px" class="fa fa-folder-open"></i>
                {{$value['name']}}</a>
            <?php }
            else {
            ?><a style="text-decoration: none" href="{{$value['path']}}">

                <i style="font-size: 20px;padding-right: 10px" class="<?php echo $value['icon'] ?>"></i>

                {{$value['name']}}  {{$value['size']}}</a>

            <?php } ?>
           

            <?php  } ?>
        </ul>
    </div>
</div>
<script>
    function myFunc(value) {
        var ip = 'ftp://192.168.60.247/';
        ip = ip+value;
        alert(ip);

        //window.open(ip);
        return false;
    }
</script>
<script type="text/javascript" src="{{asset('assets/mobile/scripts/jquery.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/mobile/scripts/plugins.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/mobile/scripts/custom.js')}}"></script>
</body>
</html>
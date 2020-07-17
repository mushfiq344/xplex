<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="{{asset('../assets/video/css/ckin.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('../assets/video/css/demo.css')}}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="{{asset("https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js")}}"></script>
    <!-- Favicon -->
    <link href="https://fonts.googleapis.com/css?family=Titillium+Web" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Titillium+Web" rel="stylesheet">

    <style>

        #loader {
            position: absolute;
            left: 50%;
            top: 50%;
            z-index: 1;
            width: 100px;
            height: 100px;
            margin: -75px 0 0 -75px;
            border: 16px solid #f3f3f3;
            border-radius: 50%;
            border-top: 16px solid #3498db;
            -webkit-animation: spin 2s linear infinite;
            animation: spin 2s linear infinite;
        }

        @-webkit-keyframes spin {
            0% { -webkit-transform: rotate(0deg); }
            100% { -webkit-transform: rotate(360deg); }
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>

<body style="background: transparent; ">
    <div class="container" style="background: transparent">

        <div id="loader"></div>

        <video style="display: none" poster="{{$result->poster_url_value}}" imdb="{{$result->imdbrating}}" id="videoPlay" title="{{$result->title}}" src="{{$video_file}}" data-ckin="default" data-color="#ffffff" data-overlay="2" type='video/{{$src}}; codecs="theora, vorbis"'></video>
    </div>
<script src="{{asset('../assets/video/js/ckin.js')}}"></script>

    <script>
        var vid = document.getElementById("videoPlay");
        vid.addEventListener("loadeddata",function () {
            if(vid.readyState == 4){                                 //when video is loaded,hide loader and show player
                document.getElementById("loader").style.display = "none";
                vid.style.display = "block";
            }
        })
    </script>
</body>

</html>




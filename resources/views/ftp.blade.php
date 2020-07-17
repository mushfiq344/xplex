<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <link rel="icon" type="image/png" href="{{asset('default_images/favicon.png')}}">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <!-- Styles -->
        <style>
        body{
        background-color: #212529;
        font-family: 'Raleway', sans-serif !important;
        font-weight: 700;
        }
        a{
        color: #fff;
        font-size: 20px;
        }
        a:hover{
        color: #6cb2eb;
        }
        tr:hover{
        background-color: grey;
        }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height m-4">
            @if(
            
            $back_button!="ftp/Games/"
            && $back_button!="ftp/Others/"
            
            )
            <a href="{{url($back_button)}}"><i class="fa fa-arrow-left" style="font-size:30px;color:#fff; padding: 10px"></i></a>
            @endif

            @if(strpos($back_button, "ftp/Games") === false)

            <a href="/"><img height="10%" width="10%" style="display: block;margin: auto;padding-bottom: 10px" src="{{asset('default_images/site_logo.png')}}" alt="LINK 71"></a>
             @endif
            <table class="table table-dark ">
                <tr>
                    <th>Name</th>
                    <th>FileSize</th>
                </tr>
                @foreach($rawlist as $value)
                <tr>
                    @if($value['type'] == "folder")
                    
                    <td>   <a style="text-decoration: none" href="{{url($value['path'])}}"><i style="font-size:24px;padding-right: 10px" class="fa">&#xf114;</i>
                    {{$value['name']}}</a>
                </td>
                @else
                <td>
                    <a style="text-decoration: none" href="{{url($value['path'])}}">
                        <i style="font-size: 20px;padding-right: 10px" class="<?php echo $value['icon'] ?>"></i>{{$value['name']}}
                    </a>
                </td>
                @endif
                <td>{{$value['size']}}</td>
            </tr>
            @endforeach
        </table>
    </div>
    <br>
    <br>
    <br>
    <div class="container-fluid">
        <div class="row ">
            <div class="col-lg-4">
                <h3 style="z-index: 1000;color: white;">Connect socially with us</h3>
                <div>
                    <a href="https://www.facebook.com/asiancityonline/" target="_blank">
                        <i class="fa fa-facebook-square"></i>
                        <span>Like on Facebook</span>
                    </a>
                </div>
                
            </div>
            <div class="col-lg-4">
                
                
            </div>
            <div class="col-lg-4">
                <div>
                    <h4 class="text-right" style="color: white;">Designed And Developed By <strong><a href="https://www.facebook.com/xplex.ftp/" target="_blank">XPLEX</a></strong> &copy; 2018.</h4>
                    <h4 class="text-right" style="color: white">Want Movie Server for your ISP ?</h4><i class="fa fa-phone"></i>
                    <div class="text-right">
                        <h4 style="color: white">Call us:</h4>
                        <a href="tel:+88 01904440314">09638151515 </a>
                        , <a href="tel:+88 01904440314">+88 01904440314
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
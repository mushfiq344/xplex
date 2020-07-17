<!DOCTYPE html>
<html>
<head>
    <title></title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <style type="text/css">

        body {
            background-color: #50B5ED;
            min-width: 100%;
            min-height: 100%;
        }

    </style>
</head>
<body>

<div class="container-fluid">

    <div class="row" style="display: flex; height: 180px;">

        <h1 style="margin: auto; margin-top: 80px; color: white; letter-spacing: 1.5px; font-size: 48px;">ERROR 404</h1>

    </div>

    <div class="row" style="height: 500px">

        <div class="col-lg-4">

        </div>

        <div class="col-lg-4" style="display: flex; height: 500px">

            <img src="{{asset('error.svg')}}" width="100%" style="margin: auto;">

        </div>

        <div class="col-lg-4">

        </div>

    </div>

    <div class="row" style="display: flex; height: 140px;">

        <h1 style="margin: auto; color: white; letter-spacing: 1.5px; font-size: 24px; text-align: center;">Page is not found. <br> The page doesn't exist or was deleted</h1>

    </div>

    <div class="row" style="display: flex; height: 30px;">

        <button id="btn" type="button" class="btn" style="margin: auto; background-color: #AED948; color: #fff; border-radius: 20px; font-weight: 600;" onclick="location.href='/'">Back to Home</button>

    </div>

    <div class="row" style="display: flex; height: 30px;">

        <h1 style="margin: 20px auto; position: absolute; right: 0; color: white; letter-spacing: 1.5px; font-size: 20px; text-align: center;"> <a href="http://xbit.com.bd" style="text-decoration: none; color: white">	&copy; Xbit Studio Ltd| 2018 </a> </h1>

    </div>

</div>

</body>
</html>
<html>
<head>
    <title></title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body style="background-color: #000;">


<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
    }

   $facebook_id  =   $_SESSION['facebook_id'];
   $name =        $_SESSION['name'];
   $email =    $_SESSION['email'];
   $avatar = $_SESSION['avatar'];
?>


<div style="display: flex; height: 100%; font-family: calibri">
    <div style="background-color: #fff; margin: auto; width: 25%; height: 600px; border-radius: 30px">
        <div style="width: 100%; height: 210px; display: flex;">
            <img src="{{$avatar}}" width="35%" style="margin: auto; margin-top: 70px; border-radius: 50%"> <br>
        </div>
        <div style="width: 80%; display: flex; margin: auto; margin-top: 80px;">

            <form style="margin: auto; width: 90%" method="post" action="{{route('user_registration')}}">
                @csrf
                <div class="input-group">
                    <span class="input-group-addon glyphicon glyphicon-user" id="basic-addon1"  aria-hidden="true"></span>
                    <input type="text" class="form-control" id="name" placeholder="Name" name="name" aria-describedby="basic-addon1" value="{{$name}}">
                </div> <br>
                <div class="input-group">
                    <span class="input-group-addon glyphicon glyphicon-edit" id="basic-addon1"></span>
                    <input type="text" class="form-control" id="isp_username" placeholder="ISP Username" name="isp_username" aria-describedby="basic-addon1">
                </div> <br>
                <div class="input-group">
                    <span class="input-group-addon glyphicon glyphicon-globe" id="basic-addon1"></span>
                    <input type="text" class="form-control" id="isp_name" placeholder="Your ISP" name="isp_name" aria-describedby="basic-addon1">
                </div> <br>
                <div class="input-group">
                    <span class="input-group-addon glyphicon glyphicon-map-marker" id="basic-addon1"></span>
                    <input type="text" class="form-control" id="address" placeholder="Address" name="address" aria-describedby="basic-addon1">
                </div> <br>
                <div class="input-group" style="display: flex;">
                    <input type="submit" value="submit" onclick="return empty()" class="btn btn-primary" style="margin: auto; border-radius: 20px; padding: 5px 30px 5px 30px; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);"></input>
                </div>
            </form>
        </div>
    </div>
</div>


<script>


    function empty() {

        if($('#isp_name').val() == "" || $('#isp_username').val() == "" || $('#address').val() == "" || $('#name').val() ==""){
        alert('Please fill all fields of the form!');
        return false;
        }

        else {
            return true;
        }

    }


</script>





</body>
</html>
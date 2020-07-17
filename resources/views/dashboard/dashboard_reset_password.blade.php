@extends('layouts.dashboard_app')
@section('head_js')
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
@endsection
@section('content')

    @if (session('alert'))
        <div class="alert alert-success">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{ session('alert') }}
        </div>
    @endif
    <div class="tab sticky-top">
        <a href="{{url('dashboard_movie')}}">
            <button class="tablinks">Movies</button>
        </a>
        <a href="{{url('dashboard_tv_show')}}">
            <button class="tablinks">TV Shows</button>
        </a>
        <a href="{{url('dashboard_explore')}}">
            <button class="tablinks">Explore</button>
        </a>
        @if(Session::get('admin_type')=='admin')
            <a href="{{url('dashboard_game')}}">
                <button class="tablinks">Games</button>
            </a>

            <a href="{{url('dashboard_reset_password')}}">
                <button class="tablinks  active">Reset Password
                </button>
            </a>
            <a href="{{url('/dashboard_backup')}}">
                <button class="tablinks">Scan
                </button>
            </a>
            <a href="{{url('/dashboard_users')}}">
                <button class="tablinks">Users
                </button>
            </a>
            <a href="{{url('dashboard_ads')}}">
                <button class="tablinks">Ads</button>
            </a>
        @endif

    </div>
    <div id="Reset Password" class="tabcontent" style="display:block;">
        <!--/////////////////////////////////////////-->
        <form class="pure-form" method="POST" action="{{ url('reset_password') }}">
            <?php echo csrf_field(); ?>
            <h3>Master Password:</h3>
            <input class="form-control" style="width: 30%;" type="password" id="master_password"
                   name="master_password" value="" placeholder="Enter the master password" required autofocus>
            <h3>New Password:</h3>
            <input class="form-control" style="width: 30%;" type="password" id="new_password"
                   name="new_password" placeholder="Enter new password" value="" required autofocus>
            <h3>Confirm New Password:</h3>
            <input class="form-control" style="float: left; margin-right: 20px; width: 30%;"
                   type="password" id="confirm_new_password" placeholder="Confirm new password"
                   name="confirm_new_password"
                   value="" required autofocus>
            <h2 id="message"></h2>
            <br>
            <br>
            <button class="btn btn-primary" onclick="confirmPass(event)">Confirm</button>
        </form>
        <script type="text/javascript">
            function confirmPass(event) {
                var pass = document.getElementById("new_password").value
                var confPass = document.getElementById("confirm_new_password").value
                if (pass != confPass) {
                    event.preventDefault();
                    alert('Wrong confirm password !');
                }
            }
        </script>
    </div>
    <!--//////////////////Reset Password  Ends /////////////////////////-->
    <!--/////////////////////////////////////////-->



@endsection
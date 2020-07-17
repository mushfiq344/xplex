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
                <button class="tablinks">Reset Password
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
                <button class="tablinks  active">Ads</button>
            </a>
        @endif

    </div>
    <div id="backup">
        <h2 class="text-center">Advertisement Upload Form</h2>
        <form method="post" action="{{url('/upload_channel_ads')}}" enctype="multipart/form-data" files="true">
            @csrf
            <h4>Link of Ad:</h4>
            <input type="text" class="form-control" name="link" value="#" required style="margin-bottom: 10px">
            <div class="custom-file mb-3">
                <input type="file" class="custom-file-input" id="load_image_1" name="channel_logos[]"
                       onchange="preview_image(this)" required>
                <label class="custom-file-label" for="customFile">Choose logo</label>
            </div>
            <img class="img-fluid" id="preview_image_1" style="display: block;
        margin: 0 auto;" src="" width="300px">
            <br>
            <button type="submit" class="btn btn-primary col-md-12 mt-2">Submit</button>
        </form>
    </div>
    <script type="text/javascript">
        function preview_image(input) {
            console.log(input.id);
            var str = input.id;
            str = str.toString();
            var product_image_id = str.replace("load_image", "preview_image");

            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e, id) {
                    console.log(e);
                    $('#' + product_image_id)
                        .attr('src', e.target.result);
                    $('#logo_name')
                        .attr('value', input.files[0].name);
                };
                reader.readAsDataURL(input.files[0]);
            } else {
                $('#' + product_image_id)
                    .attr('src', '');
            }
        }
    </script>

@endsection
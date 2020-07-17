@extends('layouts.dashboard_app')
@section('head_css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
    <style>
        body {
            overflow-x: hidden;
        }

        div#navbar_id {
            position: relative;
            padding-bottom: 5px;
            padding-top: 10px;
            left: 40%;
        }
    </style>
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
            <button class="tablinks active">Explore</button>
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
                <button class="tablinks">Ads</button>
            </a>
        @endif
    </div>
    <div id="Explore" class="tabcontent" style="display:block;">
        <br>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('dashboard_explore')}}">Explore</a></li>
                <li class="breadcrumb-item active" aria-current="page">Movies For Approval</li>
            </ol>
        </nav>
        <h1 class="text-center">Movies For Approval</h1>
        <!--/////////////////////////////////////////-->
        <div class="row">
            <div style="margin-top: 30px;width: 100%">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Year</th>
                            <th>Uploader</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($movies as $movie)
                            <tr id="{{'row_'.$movie->id}}">
                                <td>
                                    {{$movie->title}}
                                </td>
                                <td>
                                    {{$movie->year}}
                                </td>
                                <td>
                                    {{$movie->user_name}}
                                </td>
                                <td>
                                    <a href="{{url('edit_movie/movie_approval/'.$movie->id)}}">Edit Movie</a>
                                    <button onclick="delete_movie('movie_approval','{{$movie->id}}')">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
                <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
                <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
                <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
                <script>
                    $(document).ready(function () {
                        $('#example').DataTable();
                    });

                    function delete_movie(table, id) {

                        var choice = confirm("You want to delete this movie ?");
                        if (choice == true) {
                            $table = table;
                            $id = id;
                            $.ajax({
                                type: 'get',
                                url: "{{URL::to('delete_content')}}",
                                data: {'id': $id, 'table': $table},
                                success: function (data) {
                                    console.log(data);
                                    var row = document.getElementById('row_' + id);
                                    row.parentNode.removeChild(row);
                                }
                            });
                        } else {
                        }

                    }
                </script>
            </div>
        </div>
    </div>

@endsection
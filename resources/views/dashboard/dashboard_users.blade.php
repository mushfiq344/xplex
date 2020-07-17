@extends('layouts.dashboard_app')
@section('head_js')
    {{--<link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}
    {{--<script src="{{ asset('js/app.js') }}" defer></script>--}}

@endsection
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
                <button class="tablinks active">Users
                </button>
            </a>
            <a href="{{url('dashboard_ads')}}">
                <button class="tablinks">Ads</button>
            </a>
        @endif
    </div>
    <div id="users" class="tabcontent" style="display: block">
        <form method="post" action="{{url('/upload_admin')}}">
            @csrf
            <div class="row">
                <div class="col-md-4 mt-2">
                    <input class="form-control" name="username" placeholder="Enter Username" required>
                </div>
                <div class="col-md-4 mt-2">
                    <input class="form-control" name="password" placeholder="Enter password" required>
                </div>
                <div class="col-md-4 mt-2 ">
                    <input type="submit" class="btn btn-success" value="Add new Admin">
                </div>
            </div>

        </form>
        <div  style="padding-top: 30px">
            <table class="table table-bordered" id="subscribers">
                <thead>
                    <th><h3>Created At</h3></th>
                    <th><h3>User Name</h3></th>
                    <th><h3>Admin Type</h3></th>
                    <th><h3>Movie Uploaded</h3></th>
                    <th><h3>Movie Approved</h3></th>
                    <th><h3>Action</h3></th>
                </thead>
                <tbody>
                    @forelse($admins as $admin)
                        <tr id="row_{{$admin->user_name}}">
                            <td>{{ $admin->created_at}}</td>
                            <td>{{ $admin->user_name}}</td>
                            <td>{{ $admin->admin_type}}</td>
                            <td>{{ $admin->uploaded}}</td>
                            <td>{{ $admin->approved}}</td>
                            <td>
                                <button class="form-control btn-success" onclick="edit_admin('{{$admin->user_name}}')">
                                    Edit
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3">No entries found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="modal" tabindex="-1" role="dialog" id="myModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input id="username" class="form-control" readonly>
                    <br>
                    <input id="password" class="form-control">

                </div>
                <div class="modal-footer">
                    <button onclick="save_edited()" type="button" class="btn btn-primary">Save changes</button>
                    <button onclick="delete_admin()" type="button" class="btn btn-primary">Delete Admin</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script>
        function edit_admin(user_name) {
            $('#username').val(user_name);
            $('#myModal').modal('show');
        }

        function save_edited() {
            $password = $('#password').val();
            $username = $('#username').val();


            if ($('#password').val().trim().length != 0) {
                $.ajax({
                    type: 'get',
                    url: "{{URL::to('/edit_admin')}}",
                    data: {'username': $username, 'password': $password},
                    success: function (data) {
                        console.log(data);
                        $('#password').val('');
                        $('#myModal').modal('hide');

                    }
                });
            } else {
                $('#password').val('');
                alert('No Password Given');
            }

        }

        function delete_admin() {
            $username = $('#username').val();
            var row = document.getElementById('row_' + $username);
            row.parentNode.removeChild(row);


            $.ajax({
                type: 'get',
                url: "{{URL::to('/delete_admin')}}",
                data: {'username': $username,},
                success: function (data) {
                    console.log(data);
                    $('#password').val('');
                    $('#myModal').modal('hide');

                }
            });

        }
    </script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
    <script>

        $(document).ready(function () {
            $('#subscribers').DataTable();
        });
    </script>
@endsection
@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                @if (session('alert'))
                <div class="alert alert-success">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    {{ session('alert') }}
                </div>
                @endif
                <div class="card-body">
                    <form method="POST" action="{{ url('login') }}">
                        @csrf
                        <h1>Username:</h1>
                        <input placeholder="Enter Username" class="form-control" name="username" required>
                        <h1>Password:</h1>
                        <input  type="password" id="password" class="form-control"  name="password" value="" required>
                        <br>
                        <input class="btn btn-primary col-md-12"  type = 'submit' value = "Login"/>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
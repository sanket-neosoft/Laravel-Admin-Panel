@extends('index')
@section('content')
<div class="container pt-5">
    <div class="w-50 m-auto shadow rounded p-4 position-absolute top-50 start-50 translate-middle">
        <h3 class="mb-3 text-muted">Register</h3>
        <hr>
        @if (Session::has('errMsg'))
        <div class="alert alert-danger">{{Session::get('errMsg')}}</div>
        @endif
        <form method="POST" action="/register-user" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="mb-3 col-md-6">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter name">
                    @if ($errors->has('name'))
                    <div id="" class="form-text text-danger">{{$errors->first('name')}}</div>
                    @endif
                </div>
                <div class="mb-3 col-md-6">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" class="form-control" id="email" name="email" placeholder="Enter email">
                    @if ($errors->has('email'))
                    <div id="" class="form-text text-danger">{{$errors->first('email')}}</div>
                    @endif
                </div>
                <div class="mb-3 col-md-6">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Enter username">
                    @if ($errors->has('username'))
                    <div id="" class="form-text text-danger">{{$errors->first('username')}}</div>
                    @endif
                </div>
                <div class="mb-3 col-md-6">
                    <label for="age" class="form-label">Age</label>
                    <input type="number" class="form-control" id="age" name="age" placeholder="Enter age">
                    @if ($errors->has('age'))
                    <div id="" class="form-text text-danger">{{$errors->first('age')}}</div>
                    @endif
                </div>
                <div class="mb-3 col-md-6">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
                    @if ($errors->has('password'))
                    <div id="" class="form-text text-danger">{{$errors->first('password')}}</div>
                    @endif
                </div>
                <div class="mb-3 col-md-6">
                    <label for="cnf-password" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" name="password_confirmation" id="cnf-password" placeholder="Confirm password">
                    @if ($errors->has('password_confirmation'))
                    <div id="" class="form-text text-danger">{{$errors->first('password_confirmation')}}</div>
                    @endif
                </div>
                <div class="mb-3 col-md-6">
                    <label for="city" class="form-label">City</label>
                    <input type="text" class="form-control" id="city" name="city" placeholder="Enter city">
                    @if ($errors->has('city'))
                    <div id="" class="form-text text-danger">{{$errors->first('city')}}</div>
                    @endif
                </div>
                <div class="mb-3 col-md-6">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" class="form-control" id="file" name="image">
                    @if ($errors->has('image'))
                    <div id="" class="form-text text-danger">{{$errors->first('image')}}</div>
                    @endif
                </div>
                <div class="d-grid gap-2 col-md-6 mt-3 mx-auto">
                    <a href="/" class="btn btn-dark">Already a User</a>
                </div>
                <div class="d-grid gap-2 col-md-6 mt-3 mx-auto">
                    <button type="submit" class="btn btn-success">Register</button>
                </div>
            </div>
        </form>
    </div>
</div>
@stop
@extends('index')
@section('content')
<div class="container pt-5">
    <div class="w-25 m-auto shadow rounded p-4 position-absolute top-50 start-50 translate-middle">
        <h3 class="mb-3 text-muted">Login</h3>
        <hr>
        @if (Session::has('errMsg'))
        <div class="alert alert-danger">{{Session::get('errMsg')}}</div>
        @endif
        <form method="POST" action="{{url('/login-user')}}">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="text" class="form-control" id="email" name="email" placeholder="Enter email">
                @if ($errors->has('email'))
                <div id="" class="form-text text-danger">{{$errors->first('email')}}</div>
                @endif
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                @if ($errors->has('password'))
                <div id="" class="form-text text-danger">{{$errors->first('password')}}</div>
                @endif
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="remember-me">
                <label class="form-check-label" for="remember-me">Remember Me</label>
            </div>
            <div class="row">
                <div class="d-grid gap-2 col-md-12 mx-auto mb-3">
                    <button type="submit" class="btn btn-success">Login</button>
                </div>
                <div class="d-grid gap-2 col-md-12 mx-auto">
                    <a href="/register" class="btn btn-dark">Create New User</a>
                </div>
            </div>
        </form>
    </div>
</div>
@stop
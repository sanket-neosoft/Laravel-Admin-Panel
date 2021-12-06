@extends('index')
@include('components.navbar')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            @include('components.card')
        </div>
        <div class="col-md-9">
            <div class="container-fluid pt-5">
                <div class="w-50 m-auto shadow rounded p-4">
                    <h3 class="mb-3 text-muted">Change Password</h3>
                    <hr>
                    <form method="POST" action="{{url('/chng-pass')}}">
                        @csrf
                        <div class="mb-3">
                            <label for="old-password" class="form-label">Old Password</label>
                            <input type="password" class="form-control" id="old-password" name="oldpassword" placeholder="Password">
                            @if ($errors->has('oldpassword'))
                            <div id="" class="form-text text-danger">{{$errors->first('oldpassword')}}</div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="new-password" class="form-label">New Password</label>
                            <input type="password" class="form-control" id="new-password" name="newpassword" placeholder="Password">
                            @if ($errors->has('newpassword'))
                            <div id="" class="form-text text-danger">{{$errors->first('newpassword')}}</div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="cnf-password" name="cnfpassword" placeholder="Password">
                            @if ($errors->has('cnfpassword'))
                            <div id="" class="form-text text-danger">{{$errors->first('cnfpassword')}}</div>
                            @endif
                        </div>
                        <div class="d-grid gap-2 col-md-12 mx-auto mb-3">
                            <button type="submit" class="btn btn-success">Change Password</button>
                        </div>
                        @if (session()->has('status'))
                        <div class="alert alert-danger">{{ session('status') }}</div>
                        @endif
                        @if (session()->has('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
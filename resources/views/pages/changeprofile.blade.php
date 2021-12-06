@extends('index')
@include('components.navbar')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            @include('components.card')
        </div>
        <div class="col-md-9">
            <div class="container-fluid pt-3">
                <div class="w-75 m-auto shadow rounded p-4">
                    <h3 class="mb-3 text-muted">Edit Profile</h3>
                    <hr>
                    <form method="POST" class="mb-0" action="{{url('/chng-profile')}}">
                        @csrf
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="old-password" class="form-label">Email</label>
                                <input type="text" class="form-control" id="" name="" disabled placeholder="Enter email" value="{{ session('user')[0]->email }}">
                                <div id="picture" class="form-text">Cannot Change email address</div>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="new-password" class="form-label">Username</label>
                                <input type="text" class="form-control" disabled id="" name="" placeholder="Enter username" value="{{ session('user')[0]->uname }}">
                                <div id="picture" class="form-text">Cannot Change username</div>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter city" value="{{ session('user')[0]->name }}">
                                @if ($errors->has('name'))
                                <div id="" class="form-text text-danger">{{$errors->first('name')}}</div>
                                @endif
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="age" class="form-label">Age</label>
                                <input type="number" class="form-control" id="age" name="age" placeholder="Enter age"  value="{{ session('user')[0]->age }}">
                                @if ($errors->has('age'))
                                <div id="" class="form-text text-danger">{{$errors->first('age')}}</div>
                                @endif
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="city" class="form-label">City</label>
                                <input type="text" class="form-control" id="city" name="city" placeholder="Enter city" value="{{ session('user')[0]->city }}">
                                @if ($errors->has('city'))
                                <div id="" class="form-text text-danger">{{$errors->first('city')}}</div>
                                @endif
                            </div>
                            <div class="mb-3 col-md-6 m-auto">
                                <div class="d-grid gap-2 col-md-12 mx-auto">
                                    <button type="submit" class="btn btn-success"><i class="bi bi-pencil"></i> Edit Profile</button>
                                </div>
                            </div>
                            @if (session()->has('status'))
                            <div class="alert alert-danger">{{ session('status') }}</div>
                            @endif
                            @if (session()->has('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
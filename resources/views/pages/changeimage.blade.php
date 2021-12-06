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
                <!-- @if (Session::has('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif -->
                @if (Session::has('errMsg'))
                    <div class="alert alert-danger">{{ session('errMsg') }}</div>
                @endif
                <div class="w-50 m-auto shadow rounded p-4">
                    <h3 class="mb-3 text-muted">Update Profile Picture</h3>
                    <hr>
                    <form action="{{ url('/chng-image') }}" class="mb-0" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <div class="row">
                                    <div id="preview" class="col-12 text-center mb-3">
                                        <img src="{{ asset('uploads/' . session('user')[0]->image) }}" class="logotype preview">
                                        <div id="picture" class="form-text text-center">Current profile Picture</div>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label for="image" class="form-label">Select Image</label>
                                        <input type="file" name="image" class="form-control" id="image">
                                        @if ($errors->has('image'))
                                        <div id="picture" class="form-text text-center">{{ $errors->first('image') }}
                                        </div>
                                        @endif
                                    </div>
                                    <div class="d-grid gap-2">
                                        <button class="btn btn-success" type="submit"><i class="bi bi-image"></i> Change Picture</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
@extends('index')
<header>
    @include('components.navbar')
</header>
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            @include('components.card')
        </div>
        <div class="col-md-9">
            <div class="container-fluid pt-3">
                @if (Session::has('errMsg'))
                <div class="alert alert-danger">{{ session('errMsg') }}</div>
                @endif
                <div class="w-75 m-auto shadow rounded p-4">
                    <h3 class="mb-3 text-muted">Add Category</h3>
                    <hr>
                    <form action="{{ url('/add-category') }}" class="mb-0" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Name</label>
                                            <input type="name" class="form-control" id="name" name="name" placeholder="Enter category name">
                                            @if ($errors->has('name'))
                                            <div id="" class="form-text text-danger">{{$errors->first('name')}}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="image" class="form-label">Select Image</label>
                                            <input type="file" name="image" class="form-control" id="image">
                                            @if ($errors->has('image'))
                                            <div id="picture" class="form-text text-center">{{ $errors->first('image') }}
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="desc" class="form-label">Description</label>
                                            <textarea class="form-control" id="desc" name="desc" rows="8"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div id="preview" class="col-12 text-center mb-3">
                                            <img src="https://www.bastiaanmulder.nl/wp-content/uploads/2013/11/dummy-image-square.jpg" class="logotype preview">
                                        </div>
                                    </div>

                                    <div class="col-12 mb-3">

                                    </div>
                                    <div class="d-grid gap-2">
                                        <button class="btn btn-success" type="submit"><i class="bi bi-plus-circle"></i> Add Category</button>
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
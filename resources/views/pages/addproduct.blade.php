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
                <div class="w-100 m-auto shadow rounded p-4">
                    <h3 class="mb-3 text-muted">Add Product</h3>
                    <hr>
                    <form action="{{ url('/add-product') }}" class="mb-0" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Product Name</label>
                                            <input type="name" class="form-control" id="name" name="name" placeholder="Enter product name">
                                            @if ($errors->has('name'))
                                            <div id="" class="form-text text-danger">{{$errors->first('name')}}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="category" class="form-label">Select Category</label>
                                        <select name="category" class="form-select" id="category">
                                            <option value="" disabled selected>-- Select Category --</option>
                                            @foreach ($cat as $c)
                                            <option value="{{ $c->id }}">{{ $c->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="image" class="form-label">Product Image</label>
                                            <input type="file" name="image" class="form-control" id="image">
                                            @if ($errors->has('image'))
                                            <div id="picture" class="form-text text-center">{{ $errors->first('image') }}
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="price" class="form-label">Product Price</label>
                                            <input type="number" name="price" class="form-control" id="price" placeholder="Enter product price">
                                            @if ($errors->has('price'))
                                            <div id="picture" class="form-text text-center">{{ $errors->first('price') }}
                                            </div>
                                            @endif
                                        </div>
                                        <div class="mb-3">
                                            <label for="image" class="form-label">Quantity</label>
                                            <input type="number" name="quantity" class="form-control" id="quantity" placeholder="Enter product quantity">
                                            @if ($errors->has('quantity'))
                                            <div id="picture" class="form-text text-center">{{ $errors->first('quantity') }}
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="features" class="form-label">Features</label>
                                            <textarea class="form-control" id="features" name="features" rows="5"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div id="preview" class="col-12 text-center mb-3">
                                            <img src="https://www.bastiaanmulder.nl/wp-content/uploads/2013/11/dummy-image-square.jpg" class="logotype" height="170px" width="100%">
                                        </div>
                                    </div>
                                    <div class="col-md-4 d-grid">
                                        <button class="btn btn-success" type="submit"><i class="bi bi-plus-circle"></i> Add Product</button>
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
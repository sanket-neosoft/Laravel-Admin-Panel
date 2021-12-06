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
            <div class="">
                <div class="pt-3">
                    <div class="row">
                        <div class="col-md-6">
                            <h4>Products</h4>
                        </div>
                        <div class="col-md-6 text-end">
                            <a href="{{ url('/dashboard/products/add-product') }}" class="btn btn-success"><i class="bi bi-plus-circle mx-1"></i>Add Product</a>
                        </div>
                    </div>
                    <hr>
                    <table id="table" class="table text-center">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Cat_id</th>
                                <th>Cat_name</th>
                                <th>Quantity</th>
                                <th>Features</th>
                                <th></th>
                            </tr>
                        <tbody>
                            @foreach ($products as $product)
                            <tr>
                                <td class="text-center">{{ $product->id }}</td>
                                <td><img src="{{ asset('products/' . $product->image )}}" alt="" width="150px" height="100px" class="logotype"></td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->price }}</td>
                                <td>{{ $product->c_id }}</td>
                                <td>{{ $product->category->name }}</td>
                                <td>{{ $product->quantity }}</td>
                                <td>{{ $product->features }}</td>
                                <td>
                                    <button class="btn btn-danger m-1 delete" data-id="{{ $product->id }}"><i class="bi bi-trash mx-1"></i>Delete</button>
                                    <button class="btn btn-warning m-1 edit" data-bs-toggle="modal" data-bs-target="#exampleModal" data-id="{{ $product->id }}"><i class="bi bi-pencil mx-1"></i>Update</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ url('/dashboard/product/edit') }}" method="POST" id="form">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" value="" name="id" id="id">
                    <div class="row">
                        <div class="col">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Product Name</label>
                                        <input type="name" class="form-control" id="name" name="name" placeholder="Enter product name">
                                        <div id="" class="form-text text-danger"></div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="category" class="form-label">Select Category</label>
                                    <select name="category" id="category" class="form-select" id="category">
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
                                        <div id="picture" class="form-text text-center">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="price" class="form-label">Product Price</label>
                                        <input type="number" name="price" class="form-control" id="price" placeholder="Enter product price">
                                        <div id="picture" class="form-text text-center">
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="image" class="form-label">Quantity</label>
                                        <input type="number" name="quantity" class="form-control" id="quantity" placeholder="Enter product quantity">
                                        <div id="picture" class="form-text text-center">
                                        </div>
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
                                        <img src="" id="img" class="logotype" height="170px" width="100%">
                                    </div>
                                </div>
                                <div class="col-md-4 d-grid">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-warning" type="submit"><i class="bi bi-pencil"></i>Update Product</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(() => {
        $(".delete").on("click", function() {
            $.ajax({
                url: "{{ url('/dashboard/product/delete') }}",
                type: "delete",
                data: {
                    _token: "{{ csrf_token() }}",
                    pid: $(this).data("id"),
                },
                success: function(response) {
                    if (response) {
                        $("#table").load(location.href + " #table")
                    }
                }
            });
        });

        $("#form").on("submit", function(e) {
            e.preventDefault();
            $.ajax({
                url: "{{ url('dashboard/product/edit') }}",
                method: "post",
                data: new FormData(this),
                contentType: false,
                processData: false,
                cache: false,
                success: function(response) {
                    if (response) {
                        location.reload();
                    } 
                }
            });
        });

        $(".edit").on("click", function() {
            let id = $(this).data("id");
            $.ajax({
                url: `{{ url('/dashboard/product/${id}') }}`,
                method: "get",
                success: function(response) {
                    $("#id").val(response["id"]);
                    $("#name").val(response["name"]);
                    $("#quantity").val(response["quantity"]);
                    $("#price").val(response["price"]);
                    $("#features").val(response["features"]);
                    $("#category").val(response["c_id"]);
                    let image = response["image"];
                    $("#img").attr("src", `{{ asset('products/${image}') }}`);
                }
            });
        });
    });
</script>
@stop
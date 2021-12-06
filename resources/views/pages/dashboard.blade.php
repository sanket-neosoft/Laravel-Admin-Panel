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
                        <div class="col">
                            <h4>Categories</h4>
                        </div>
                        <div class="col text-end">
                            <a href="{{ url('/dashboard/add-category') }}" class="btn btn-success"><i class="bi bi-plus-circle mx-1"></i>Add Category</a>
                        </div>
                    </div>
                    <hr>
                    <table id="table" class="table text-center">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th></th>
                            </tr>
                        <tbody>
                            @foreach ($categories as
                            $category)
                            <tr>
                                <td>{{ $category->id }}</td>
                                <td><img src="{{ asset('categories/' . $category->image )}}" alt="" width="150px" height="100px" class="logotype"></td>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->description }}</td>
                                <td>
                                    <button class="btn btn-danger m-1 delete" data-id="{{ $category->id }}"><i class="bi bi-trash mx-1"></i>Delete</button>
                                    <button class="btn btn-warning m-1 edit" data-id="{{ $category->id }}" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="bi bi-pencil mx-1"></i>Update</button>
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
                <h5 class="modal-title" id="exampleModalLabel">Edit Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ url('dashborad/category/edit') }}" id="form" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" id="id" name="id">
                    <div class="row">
                        <div class="col">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="name" class="form-control" id="name" name="name" placeholder="Enter category name" value="">
                                        <div id="error-name" class="form-text text-danger"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="image" class="form-label">Select Image</label>
                                        <input type="file" name="image" class="form-control" id="image">
                                        <div id="error-picture" class="form-text text-center">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="desc" class="form-label">Description</label>
                                        <textarea class="form-control" id="desc" name="desc" rows="8"></textarea>
                                        <div id="error-desc" class="form-text text-center">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div id="preview" class="col-12 text-center mb-3">
                                        <img id="img" src="" class="logotype preview">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="d-grid gap-2">
                        <button class="btn btn-warning" type="submit"><i class="bi bi-pencil"></i> Update Category</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(() => {
        $('.delete').on('click', function() {
            $.ajax({
                url: "{{ url('dashboard/category/delete') }}",
                method: "delete",
                data: {
                    _token: "{{csrf_token()}}",
                    cid: $(this).data("id"),
                },
                success: function(response) {
                    if (response) {
                        $("#table").load(location.href + " #table");
                    }
                }
            });
        });

        $(".edit").on("click", function() {
            let id = $(this).data("id");
            $.ajax({
                url: `{{ url('dashboard/category/${id})') }}`,
                method: "get",
                success: function(response) {
                    $("#id").val(response["id"]);
                    $("#name").val(response["name"]),
                        $("#desc").val(response["description"]);
                    let image = response["image"];
                    $("#img").attr("src", `{{ asset('categories/${image}') }}`);
                }
            });
        });

        $("#form").on("submit", function(e) {
            e.preventDefault();
            $.ajax({
                url: "{{ url('dashboard/category/edit') }}",
                method: "post",
                data: new FormData(this),
                contentType: false,
                processData: false,
                cache: false,
                success: function(response) {
                    if (response) {
                        location.reload();
                    } else {
                        $("#error-name").text(`{{ $errors->first('name') }}`);
                        $("#error-desc").text(`{{ $errors->first('desc') }}`);
                    }
                }
            });
        });
    });
</script>

@stop
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Admin Panel</title>

    <!-- bootstrap -->
    @include('includes.head')

    <!-- custom css -->
    <style>
        .logotype {
            object-fit: cover;
            object-position: center;
        }

        .preview {
            height: 250px;
            width: 100%;
        }

        td {
            vertical-align: middle;
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</head>

<body class="antialiased">
    @yield('content')

    <!-- bootstrap script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script>
        $(() => {
            $("#image").change(function(event) {
                let imagePreview = URL.createObjectURL(event.target.files[0]);
                let image = `<img src=${imagePreview} class='logotype preview'><div id="picture" class="form-text text-center">Preview</div>`
                $("#preview").html(image);
            });
        });
    </script>
</body>

</html>
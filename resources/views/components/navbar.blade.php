<nav class="navbar navbar-expand-lg navbar-light bg-light shadow">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ url('/dashboard') }}">Admin Panel</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 mx-3">
                <li class="nav-item">
                    <a href="{{ url('/dashboard/products') }}" class="nav-link"><i class="bi bi-cart mx-1"></i>Products</a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 mx-3">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-success" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person-circle"></i> {{ session('user')[0]->uname }}
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="{{ url('/change-password') }}">Change Password</a></li>
                        <li><a class="dropdown-item" href="/change-image">Edit Profile Picture</a></li>
                    </ul>
                </li>
                <li class="nav-item"><a class="btn btn-outline-success" href="/logout">Logout</a></li>
            </ul>
        </div>
    </div>
</nav>
<div class="card m-3" style="min-width: 18rem; width: 18rem;">
    <img src="{{ asset('uploads/' . session('user')[0]->image) }}" class="card-img-top" alt="...">
    <div class="card-body">
        <div class="text-center mb-3">
            <h5 class="card-title">{{ session('user')[0]->uname }}</h5>
        </div>
        <div class="mx-auto">
            <table class="mx-auto mb-3">
                <tr>
                    <td><i class="bi bi-envelope p-3"></i> </td>
                    <td class="py-1">{{ session('user')[0]->email }}</td>
                </tr>
                <tr>
                    <td><i class="bi bi-person p-3"></i> </td>
                    <td class="py-1">{{ session('user')[0]->name }}</td>
                </tr>
                <tr>
                    <td><i class="bi bi-building p-3"></i> </td>
                    <td class="py-1">{{ session('user')[0]->city }}</td>
                </tr>
                <tr>
                    <td><i class="bi bi-calendar3 p-3"></i> </td>
                    <td class="py-1">{{ session('user')[0]->age }}</td>
                </tr>
            </table>
        </div>
        <div class="d-grid gap-2">
            <a href="/change-profile" class="btn btn-success"><i class="bi bi-pencil"></i> Edit Profile</a>
        </div>
    </div>
</div>
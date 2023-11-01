@extends('admin.master')

@section('content')
    <div class="container">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Active</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->phone }}</td>
                    <td>{{ $user->address }}</td>
                    <td>
                        @if ($user->active == 1)
                            <span class="badge badge-success">Yes</span>
                        @else
                            <span class="badge badge-danger">No</span>
                        @endif
                    </td>
                    <td>{{ $user->created_at }}</td>
                    <td>
                        <a href="/admin/users/edit/{{ $user->id }}" class="btn btn-primary btn-sm">
                            <i class="ti-pencil-alt"></i>
                        </a>
                        <!-- Trong view hiển thị danh sách người dùng -->
                        <a href="/admin/users/delete/{{ $user->id }}" class="btn btn-danger btn-sm">
                            <i class="ti-trash"></i>
                        </a>

                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <script>
        document.getElementById('delete-user').addEventListener('click', function (e) {
            e.preventDefault();
            if (confirm("Bạn có chắc chắn muốn xóa tài khoản?")) {
                window.location.href = "/admin/users/destroy/{{ $user->id }}"; // Chuyển đến route xóa
            }
        });
    </script>

@endsection

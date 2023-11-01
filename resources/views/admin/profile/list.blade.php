@extends('admin.master')

@section('content')

    <div class="container mt-4">
{{--        <h1 class="mb-4">Thông Tin Cá Nhân</h1>--}}
        <p><strong>Tên:</strong> {{ $user->name }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <p><strong>Số điện thoại:</strong> {{ $user->phone }}</p>
        <p><strong>Địa chỉ:</strong> {{ $user->address }}</p>

        <!-- Nút Chỉnh Sửa -->
        <a href="/admin/profile/edit" class="btn btn-primary">Chỉnh Sửa</a>
    </div>
<!-- Hiển thị các thông tin cá nhân khác -->
@endsection

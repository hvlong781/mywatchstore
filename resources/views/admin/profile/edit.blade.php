@extends('admin.master') <!-- Nếu bạn đang sử dụng layout -->

@section('content')
    <div class="container mt-4">
{{--        <h1>Chỉnh Sửa Thông Tin Cá Nhân</h1>--}}

        <form action="/admin/profile/update" method="post">
            @csrf

            <div class="form-group">
                <label for="name">Tên:</label>
                <input type="text" name="name" id="name" value="{{ $user->name }}" class="form-control">
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" value="{{ $user->email }}" class="form-control">
            </div>

            <div class="form-group">
                <label for="phone">Số điện thoại:</label>
                <input type="text" name="phone" id="phone" value="{{ $user->phone }}" class="form-control">
            </div>

            <div class="form-group">
                <label for="address">Địa chỉ:</label>
                <input type="text" name="address" id="address" value="{{ $user->address }}" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Cập Nhật</button>
        </form>
    </div>
@endsection

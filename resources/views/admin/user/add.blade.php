@extends('admin.master') <!-- Import layout mặc định của Laravel (nếu có) -->

@section('content')
    <div class="container">
        <form action="/admin/users/add-user" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Tên:</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Tên người dùng" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Vui lòng nhập email" required>
            </div>
            <div class="form-group">
                <label for="password">Mật khẩu:</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Nhập mật khẩu" required>
            </div>
            <div class="form-group">
                <label for="password_confirmation">Xác nhận mật khẩu:</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Xác nhận mật khẩu" required>
            </div>

            <div class="form-group">
                <label for="phone">Số điện thoại:</label>
                <input type="text" name="phone" id="phone" class="form-control" placeholder="Vui lòng nhập số điện thoại" required>
            </div>
            <div class="form-group">
                <label for="address">Địa chỉ:</label>
                <input type="text" name="address" id="address" class="form-control" placeholder="Vui lòng nhập địa chỉ" required>
            </div>
            <div class="form-group">
                <label for="role">Loại tài khoản:</label>
                <select name="role" id="role" class="form-control" required>
                    <option value="customer">Customer</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Tạo người dùng</button>
        </form>
    </div>
@endsection

@extends('admin.master')

@section('content')
    <form action="" method="POST">
        <div class="card-body">
            <div class="form-group">
                <label for="brand">Tên nhà cung cấp</label>
                <input type="text" value="{{ $supplier->name }}" class="form-control" name="name" placeholder="Nhập tên nhà cung cấp">
            </div>

            <div class="form-group">
                <label>Địa chỉ</label>
                <input type="text" value="{{ $supplier->address }}" class="form-control" name="address" placeholder="Nhập địa chỉ">
            </div>

            <div class="form-group">
                <label>Sô điện thoại</label>
                <input type="text" value="{{ $supplier->phone }}" class="form-control" name="phone" placeholder="Nhập sô điện thoại">
            </div>

            <div class="form-group">
                <label>Website</label>
                <input type="text" value="{{ $supplier->website }}" class="form-control" name="website" placeholder="Nhập URL">
            </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Cập nhật</button>
        </div>

        @csrf
    </form>
@endsection

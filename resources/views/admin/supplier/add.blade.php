@extends('admin.master')

@section('content')
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="supplier">Tên nhà cung cấp</label>
                        <input type="text" value="{{ old('name') }}" class="form-control" name="name" placeholder="Nhập tên nhà cung cấp">
                    </div>

                    <div class="form-group">
                        <label>Địa chỉ</label>
                        <input type="text" value="{{ old('address') }}" class="form-control" name="address" placeholder="Nhập địa chỉ">
                    </div>

                    <div class="form-group">
                        <label>Số điện thoại</label>
                        <input type="text" value="{{ old('phone') }}" class="form-control" name="phone" placeholder="Nhập số điện thoại">
                    </div>

                    <div class="form-group">
                        <label>Website</label>
                        <input type="text" value="{{ old('website') }}" class="form-control" name="website" placeholder="Nhập URL">
                    </div>

                    <button type="submit" class="btn btn-primary">Thêm nhà cung cấp</button>

                    @csrf
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

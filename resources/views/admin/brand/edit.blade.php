@extends('admin.master')

@section('content')
    <form action="" method="POST">
        <div class="card-body">
            <div class="form-group">
                <label for="brand">Tên thương hiệu</label>
                <input type="text" value="{{ $brand->name }}" class="form-control" name="name" placeholder="Nhập tên thương hiệu">
            </div>

            <div class="form-group">
                <label>Mô tả</label>
                <textarea name="description" class="form-control">{{ $brand->description }}</textarea>
            </div>

            <div class="form-group">
                <label>Quốc gia</label>
                <input type="text" value="{{ $brand->country }}" class="form-control" name="country" placeholder="Nhập quốc gia">
            </div>

            <div class="form-group">
                <label>Năm thành lập</label>
                <input type="number" value="{{ $brand->founded_year }}" class="form-control" name="founded_year" placeholder="Nhập năm thành lập">
            </div>

            <div class="form-group">
                <label>Website</label>
                <input type="text" value="{{ $brand->website }}" class="form-control" name="website" placeholder="Nhập URL">
            </div>

            <div class="form-group">
                <label>Kích hoạt</label>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="1" type="radio" id="active" name="active"
                        {{ $brand->active == 1 ? 'checked=""' : '' }}>
                    <label for="active" class="custom-control-label">Có</label>
                </div>

                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="0" type="radio" id="no_active" name="active"
                        {{ $brand->active == 0 ? 'checked=""' : '' }}>
                    <label for="no_active" class="custom-control-label">Không</label>
                </div>
            </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Cập nhật</button>
        </div>

        @csrf
    </form>
@endsection

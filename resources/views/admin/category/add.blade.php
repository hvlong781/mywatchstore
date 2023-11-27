@extends('admin.master')

@section('content')
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="menu">Tên danh mục</label>
                        <input type="text" value="{{ old('name') }}" class="form-control" name="name" placeholder="Nhập tên danh mục">
                    </div>

                    <div class="form-group">
                        <label>Danh mục</label>
                        <select class="form-control" name="parent_id">
                            <option value="0">Danh mục cha</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Mô tả</label>
                        <textarea name="description" class="form-control">{{ old('description') }}</textarea>
                    </div>

                    <div class="form-group">
                        <label>Ảnh sản phẩm</label>
                        <input type="file" name="file" id="upload" class="form-control">
                        <div id="image_show">

                        </div>
                        <input type="hidden" name="image" id="image">
                    </div>

                    <div class="form-group">
                        <label>Kích hoạt</label>
                        <div class="custom-control custom-radio">
                            <input class="custom-control-input" value="1" type="radio" id="active" name="active" checked="">
                            <label for="active" class="custom-control-label">Có</label>
                        </div>

                        <div class="custom-control custom-radio">
                            <input class="custom-control-input" value="0" type="radio" id="no_active" name="active">
                            <label for="no_active" class="custom-control-label">Không</label>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Thêm danh mục</button>

                    @csrf
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

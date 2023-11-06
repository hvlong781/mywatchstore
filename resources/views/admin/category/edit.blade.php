@extends('admin.master')

@section('content')
    <form action="" method="POST">
        <div class="card-body">

            <div class="form-group">
                <label for="name">Tên danh mục</label>
                <input type="text" class="form-control" value="{{ $category->name }}" name="name"
                       placeholder="Nhập tên danh mục">
            </div>

            <div class="form-group">
                <label>Danh mục</label>
                <select class="form-control" name="parent_id">
                    <option value="0" {{ $category->parent_id == 0 ? 'selected' : '' }}>Danh mục cha</option>
                    @foreach($categories as $menuParent)
                        <option value="{{ $menuParent->id }}"
                            {{ $category->parent_id == $menuParent->id ? 'selected' : '' }}>
                            {{ $menuParent->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Mô tả</label>
                <textarea name="description" class="form-control">{{ $category->description }}</textarea>
            </div>

            <div class="form-group">
                <label>Ảnh sản phẩm</label>
                <input type="file" name="file" id="upload" class="form-control">
                <div id="image_show">
                    <a href="{{ $category->image }}" target="_blank">
                        <img src="{{ $category->image }}" width="100px">
                    </a>

                </div>
                <input type="hidden" value="{{ $category->image }}" name="image" id="image">
            </div>

            <div class="form-group">
                <label>Kích hoạt</label>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="1" type="radio" id="active" name="active"
                        {{ $category->active == 1 ? 'checked=""' : '' }}>
                    <label for="active" class="custom-control-label">Có</label>
                </div>

                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="0" type="radio" id="no_active" name="active"
                        {{ $category->active == 0 ? 'checked=""' : '' }}>
                    <label for="no_active" class="custom-control-label">Không</label>
                </div>
            </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Cập nhật danh mục</button>
        </div>

        @csrf
    </form>
@endsection

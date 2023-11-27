@extends('admin.master')

@section('content')
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <form action="" method="POST">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="product">Tên sản phẩm</label>
                                <input type="text" value="{{ $product->name }}" class="form-control" name="name" placeholder="Nhập tên sản phẩm">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Giá sản phẩm</label>
                                <input type="number" value="{{ $product->price }}" class="form-control" name="price" placeholder="Nhập giá sản phẩm">
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Danh mục</label>
                                <select class="form-control" name="category_id">
                                    @foreach($menus as $menu)
                                        <option value="{{ $menu->id }}" {{ $product->category_id == $menu->id ? 'selected' : '' }}>
                                            {{ $menu->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Thương hiệu</label>
                                <select class="form-control" name="brand_id">
                                    @foreach($brands as $brand)
                                        <option value="{{ $brand->id }}" {{ $product->brand_id == $brand->id ? 'selected' : '' }}>
                                            {{ $brand->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </div>

                    <div class="form-group">
                        <label>Mô tả</label>
                        <textarea name="description" class="form-control">{{ $product->description }}</textarea>
                    </div>

                    <div class="form-group">
                        <label>Mô tả chi tiết</label>
                        <textarea name="content" id="content" class="form-control">{{ $product->content }}</textarea>
                    </div>

                    <div class="form-group">
                        <label>Ảnh sản phẩm</label>
                        <input type="file" name="file" id="upload" class="form-control">
                        <div id="image_show">
                            <a href="{{ $product->image }}" target="_blank">
                                <img src="{{ $product->image }}" width="100px">
                            </a>

                        </div>
                        <input type="hidden" value="{{ $product->image }}" name="image" id="image">
                    </div>

                    <div class="form-group">
                        <label>Kích hoạt</label>
                        <div class="custom-control custom-radio">
                            <input class="custom-control-input" value="1" type="radio" id="active" name="active"
                                {{ $product->active == 1 ? 'checked=""' : '' }}>
                            <label for="active" class="custom-control-label">Có</label>
                        </div>

                        <div class="custom-control custom-radio">
                            <input class="custom-control-input" value="0" type="radio" id="no_active" name="active"
                                {{ $product->active == 0 ? 'checked=""' : '' }}>
                            <label for="no_active" class="custom-control-label">Không</label>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Cập nhật sản phẩm</button>

                    @csrf
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

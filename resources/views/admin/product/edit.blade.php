@extends('admin.main')

@section('head')
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.2/classic/ckeditor.js"></script>
@endsection

@section('content')
    <form action="" method="POST">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="product">Tên sản phẩm</label>
                        <input type="text" value="{{ $product->name }}" class="form-control" name="name" placeholder="Nhập tên sản phẩm">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Danh mục</label>
                        <select class="form-control" name="menu_id">
                            @foreach($menus as $menu)
                                <option value="{{ $menu->id }}" {{ $product->menu_id == $menu->id ? 'selected' : '' }}>
                                    {{ $menu->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Giá sản phẩm</label>
                        <input type="number" value="{{ $product->price }}" class="form-control" name="price" placeholder="Nhập giá sản phẩm">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Giá giảm</label>
                        <input type="number" value="{{ $product->price_sale }}" class="form-control" name="price_sale" placeholder="Nhập giá sản phẩm đã giảm">
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
                    <a href="{{ $product->thumb }}" target="_blank">
                        <img src="{{ $product->thumb }}" width="100px">
                    </a>

                </div>
                <input type="hidden" value="{{ $product->thumb }}" name="thumb" id="thumb">
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
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Cập nhật sản phẩm</button>
        </div>

        @csrf
    </form>
@endsection

@section('footer')
    <script>
        ClassicEditor
            .create( document.querySelector( '#content' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>
@endsection

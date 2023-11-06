@extends('admin.master')

@section('content')
    <form action="" method="POST">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Tiêu đề</label>
                        <input type="text" value="{{ $slider->name }}" class="form-control" name="name" placeholder="Nhập tiêu đề">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Đường dẫn</label>
                        <input type="text" value="{{ $slider->url }}" class="form-control" name="url" placeholder="Nhập đường dẫn">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>Sắp xếp</label>
                <input type="number" value="{{ $slider->sort_by }}" class="form-control" name="sort_by" placeholder="">
            </div>

            <div class="form-group">
                <label>Hình ảnh</label>
                <input type="file" name="file" id="upload" class="form-control">
                <div id="image_show">
                    <a href="{{ $slider->image }}" target="_blank">
                        <img src="{{ $slider->image }}" width="100px">
                    </a>
                </div>
                <input type="hidden" value="{{ $slider->image }}" name="image" id="image">
            </div>

            <div class="form-group">
                <label>Kích hoạt</label>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="1" type="radio" id="active" name="active"
                        {{ $slider->active == 1 ? 'checked=""' : '' }}>
                    <label for="active" class="custom-control-label">Có</label>
                </div>

                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="0" type="radio" id="no_active" name="active"
                        {{ $slider->active == 0 ? 'checked=""' : '' }}>
                    <label for="no_active" class="custom-control-label">Không</label>
                </div>
            </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Cập nhật Slider</button>
        </div>

        @csrf
    </form>
@endsection

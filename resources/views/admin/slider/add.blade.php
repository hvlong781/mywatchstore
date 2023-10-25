@extends('admin.main')

@section('content')
    <form action="" method="POST">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="product">Tiêu đề</label>
                        <input type="text" value="{{ old('name') }}" class="form-control" name="name" placeholder="Nhập tiêu đề">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="product">Đường dẫn</label>
                        <input type="text" value="{{ old('url') }}" class="form-control" name="url" placeholder="Nhập đường dẫn">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>Sắp xếp</label>
                <input type="number" value="1" class="form-control" name="sort_by" placeholder="">
            </div>

            <div class="form-group">
                <label>Hình ảnh</label>
                <input type="file" name="file" id="upload" class="form-control">
                <div id="image_show">

                </div>
                <input type="hidden" name="thumb" id="thumb">
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
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Thêm Slider</button>
        </div>

        @csrf
    </form>
@endsection

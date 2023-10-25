@extends('admin.main')

@section('head')
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.2/classic/ckeditor.js"></script>

{{--<script src="//cdn.ckeditor.com/4.23.0-lts/full/ckeditor.js"></script>--}}
@endsection

@section('content')
    <form action="" method="POST">
        <div class="card-body">

            <div class="form-group">
                <label for="menu">Tên danh mục</label>
                <input type="text" value="{{ old('name') }}" class="form-control" name="name" placeholder="Nhập tên danh mục">
            </div>

            <div class="form-group">
                <label>Danh mục</label>
                <select class="form-control" name="parent_id">
                    <option value="0">Danh mục cha</option>
                    @foreach($menus as $menu)
                        <option value="{{ $menu->id }}">{{ $menu->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Mô tả</label>
                <textarea name="description" class="form-control">{{ old('description') }}</textarea>
            </div>

            <div class="form-group">
                <label>Mô tả chi tiết</label>
                <textarea name="content" id="content" class="form-control">{{ old('content') }}</textarea>
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
            <button type="submit" class="btn btn-primary">Thêm danh mục</button>
        </div>

        @csrf
    </form>
@endsection

@section('footer')
{{--    <script>--}}
{{--        CKEDITOR.replace('content');--}}
{{--    </script>--}}

    <script>
        ClassicEditor
            .create( document.querySelector( '#content' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>

@endsection

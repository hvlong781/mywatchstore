@extends('admin.main')

@section('content')
    <table class="table">
        <thead>
            <tr>
                <th style="width: 50px">ID</th>
                <th>Tên danh mục</th>
                <th>Trạng thái</th>
                <th>Cập nhật</th>
                <th style="width: 100px">&nbsp;</th>
            </tr>
        </thead>

        <tbody>
            {!! \app\Helpers\Helper::menu($menus) !!}
        </tbody>
    </table>
@endsection

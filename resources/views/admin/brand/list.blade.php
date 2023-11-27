@extends('admin.master')

@section('content')
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <table class="table">
                    <thead>
                    <tr>
                        <th style="width: 50px">ID</th>
                        <th>Tên thương hiệu</th>
                        <th>Quốc gia</th>
                        <th>Năm thành lập</th>
                        <th>Trạng thái</th>
                        <th>Cập nhật</th>
                        <th style="width: 100px">&nbsp;</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($brands as $brand)
                        <tr>
                            <td>{{ $brand->id }}</td>
                            <td>{{ $brand->name }}</td>
                            <td>{{ $brand->country }}</td>
                            <td>{{ $brand->founded_year }}</td>
                            <td>{!! \App\Helpers\Helper::active($brand->active) !!}</td>
                            <td>{{ $brand->updated_at }}</td>

                            <td>
                                <a href="/admin/brands/edit/{{ $brand->id }}" class="btn btn-info btn-sm">Sửa</a>

                                <form action="/admin/brands/destroy/{{ $brand->id }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa thương hiệu này?')">Xóa</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="card-footer clearfix">
                    {!! $brands->links() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

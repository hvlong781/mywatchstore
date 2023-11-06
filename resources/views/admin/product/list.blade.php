@extends('admin.master')

@section('content')
    <table class="table">
        <thead>
        <tr>
            <th style="width: 50px">ID</th>
            <th style="width: 350px">Tên sản phẩm</th>
            <th>Danh mục</th>
            <th>Hãng</th>
            <th>Giá gốc</th>
            <th>Trạng thái</th>
            <th>Cập nhật</th>
            <th style="width: 100px">&nbsp;</th>
        </tr>
        </thead>

        <tbody>
        @foreach($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->category->name }}</td>
                <td>{{ $product->brand->name }}</td>
                <td>{{ $product->price }}</td>
                <td>{!! \App\Helpers\Helper::active($product->active) !!}</td>
                <td>{{ $product->updated_at }}</td>
                <td>
                    <a class="btn btn-primary btn-xs" href="/admin/products/edit/{{ $product->id }}">
                        <i class="ti-pencil-alt"></i>
                    </a>

                    <a class="btn btn-danger btn-xs" href="#"
                       onclick="removeRow({{ $product->id }},  '/admin/products/destroy')">
                        <i class="ti-trash"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="card-footer clearfix">
        {!! $products->links() !!}
    </div>

@endsection

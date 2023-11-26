@extends('admin.master')

@section('content')
    <table class="table">
        <thead>
        <tr>
            <th style="width: 50px">ID</th>
            <th>Nhà cung cấp</th>
            <th>Tổng tiền</th>
            <th>Cập nhật</th>
            <th style="width: 100px">&nbsp;</th>
        </tr>
        </thead>

        <tbody>
        @foreach($purchase as $purchaseOrder)
            <tr>
                <td>{{ $purchaseOrder->id }}</td>
                <td>{{ $purchaseOrder->supplier->name }}</td>
                <td>{{ number_format($purchaseOrder->total_price, 0, '', '.') }}</td>
                <td>{{ $purchaseOrder->updated_at }}</td>
                <td>
                    <a href="/admin/purchase/detail/{{ $purchaseOrder->id }}" class="btn btn-primary btn-xs">
                        <i class="ti-eye"></i>
                    </a>

                    <a class="btn btn-danger btn-xs" href="#"
                       onclick="removeRow({{ $purchaseOrder->id }},  '/admin/purchase/destroy')">
                        <i class="ti-trash"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="card-footer clearfix">
        {!! $purchase->links() !!}
    </div>

@endsection

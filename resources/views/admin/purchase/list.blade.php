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
                <td>{{ $purchaseOrder->supplier->name }}</td>
                <td>{{ $purchaseOrder->total_price }}</td>
                <td>
                    <a href="{{ route('purchase_orders.show', $purchaseOrder->id) }}" class="btn btn-info">View Details</a>


                    <a class="btn btn-primary btn-xs" href="/admin/products/edit/{{ $purchaseOrder->id }}">
                        <i class="ti-pencil-alt"></i>
                    </a>

                    <a class="btn btn-danger btn-xs" href="#"
                       onclick="removeRow({{ $purchaseOrder->id }},  '/admin/products/destroy')">
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

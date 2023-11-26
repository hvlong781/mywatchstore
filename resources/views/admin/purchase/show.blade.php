@extends('admin.master')

@section('content')
        <div>
            <strong>Nhà cung cấp:</strong> {{ $purchase->supplier->name }}
        </div>

        <div>
            <strong>Tổng tiền:</strong> {{ number_format($purchase->total_price, 0, '', '.') }} VND
        </div>
<div>--</div>
        <h4>Chi tiết</h4>

        <table class="table">
            <thead>
            <tr>
                <th>Sản phẩm</th>
                <th>Hình ảnh</th>
                <th>Số lượng</th>
                <th>Đơn giá (VND)</th>
            </tr>
            </thead>
            <tbody>
            @foreach($purchase->details as $detail)
                <tr>
                    <td>{{ $detail->product->name }}</td>
                    <td>
                        <img src="{{ $detail->product->image }}">
                    </td>
                    <td>{{ $detail->quantity }}</td>
                    <td>{{ number_format($detail->price_per_item, 0, '', '.') }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <a href="/admin/purchase" class="btn btn-primary">Trở lại</a>
@endsection

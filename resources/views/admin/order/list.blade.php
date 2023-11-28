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
                        <th>Mã Đơn Hàng</th>
                        <th>Tên Khách Hàng</th>
                        <th>Trạng Thái</th>
                        <th>Thanh Toán</th>
                        <th>Ngày Đặt hàng</th>
                        <th style="width: 80px">&nbsp;</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($orders as $key => $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->invoice_number }}</td>
                            <td>{{ $order->user_name }}</td>
                            <td>
                                <span class="badge
                                    @if($order->status === 'Đang chờ xử lý') badge-secondary
                                    @elseif($order->status === 'Đơn hàng đã được đặt') badge-primary
                                    @elseif($order->status === 'Sẵn sàng để vận chuyển') badge-info
                                    @elseif($order->status === 'Đang trên đường giao') badge-warning
                                    @elseif($order->status === 'Tiến hành giao hàng') badge-dark
                                    @elseif($order->status === 'Đã giao') badge-success
                                    @elseif($order->status === 'Đã hủy') badge-danger
                                    @endif">
                                    {{ $order->status }}
                                </span>
                            </td>
                            <td>{{ $order->status_payment }}</td>
                            <td>{{ $order->created_at }}</td>
                            <td>
                                <a class="btn btn-primary btn-xs" href="/admin/orders/view-detail/{{ $order->id }}">
                                    <i class="ti-eye"></i>
                                </a>
            {{--                    <a href="#" class="btn btn-danger btn-xs"--}}
            {{--                       onclick="removeRow({{ $order->id }}, '/admin/customers/destroy')">--}}
            {{--                        <i class="ti-trash"></i>--}}
            {{--                    </a>--}}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <div class="card-footer clearfix">
                    {!! $orders->links() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



<!-- resources/views/orders/show.blade.php -->
@extends('main')

@section('content')
    <div class="bg0 m-t-35 p-b-140 p-t-80">
        <div class="container">
            @if($order->status == 'Đã giao')
                <h3>Đơn hàng đã hoàn tất</h3>
            @endif

            @if($order->status == 'Đã hủy')
                <h3>Đơn hàng đã được hủy</h3>
            @endif

            @if($order->status == 'Tiến hành giao hàng')
                <h3>Đang tiến hành giao hàng</h3>
            @endif

            @if($order->status == 'Đang trên đường giao')
                <h3>Đơn hàng đang trên đường giao</h3>
            @endif

            @if($order->status == 'Sẵn sàng để vận chuyển')
                <h3>Đơn hàng đã sẵn sàng</h3>
            @endif

            @if($order->status == 'Đơn hàng đã được đặt')
                <h3>Đơn hàng đã được đặt</h3>
            @endif

            @if($order->status == 'Đang chờ xử lý')
                <h3>Đang chờ được xử lý</h3>
            @endif

                <div class="m-t-20">
                    @include('admin.alert')
                </div>

            <!-- Hiển thị thông tin chi tiết đơn hàng -->
            <div class="row m-t-15">
                <div class="col-md-6">
                    <h4>Thông tin giao hàng</h4>
{{--                    <p><strong>Ngày đặt hàng:</strong> {{ $order->created_at }}</p>--}}
                    <p><strong>Tên:</strong> {{ $order->user_name }}</p>
                    <p><strong>Số điện thoại:</strong> {{ $order->shipping_phone }}</p>
                    <p><strong>Địa chỉ:</strong> {{ $order->shipping_address }}</p>
                    <!-- Thêm các thông tin khác cần hiển thị -->

                    @if($order->status == 'Đang chờ xử lý')
                        <form method="POST" action="/orders/view-detail/{{ $order->id }}/cancel">
                            @csrf
                            @method('POST')
                            <button type="submit" class="btn btn-danger" onclick="return confirmDeletion();">Hủy đơn hàng</button>
                        </form>
                    @endif
                </div>

                <div class="col-md-6">
                    <h4>Chi tiết sản phẩm</h4>
                    <ul class="list-group p-t-5">
                        @foreach($order->orderDetails as $item)
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-md-3">
                                        <img src="{{ $item->product->image }}" alt="img" style="width: 100%; height: 100%">
                                    </div>
                                    <div class="col-md-9">
                                        <div class="m-b-50">{{ $item->product->name }}</div>

                                        <div>{{ number_format($item->price, 0, '', '.') }}đ x {{ $item->quantity }}</div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class=" m-t-20">
                <h4>Chi tiết đơn hàng</h4>

                <div class="row">
                    <div class="col-6">
                        <div>
                            <div>Số đơn hàng: {{ $order->invoice_number }}</div>
                        </div>

                        <div>
                            <div>Ngày đặt hàng: {{ $order->created_at }}</div>
                        </div>
                        <div>
                            <div>Phương thức thanh toán: Thanh toán khi nhận hàng</div>
                        </div>

                        <div>
                            <span>Thời gian thanh toán: </span>
                            <span>{{ $order->updated_at }}</span>
                        </div>
                        @if($order->status == 'Đã giao')
                            <div>
                                <span>Ngày vận chuyển: </span>
                                <span>{{ $shippingReadyDate->updated_at }}</span>
                            </div>
                        @endif


                        <div>
                            <span>Ngày giao hàng: </span>
                            <span>{{ $order->updated_at }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script>
    function confirmDeletion() {
        return confirm("Bạn chắc chắn muốn hủy?");
    }

</script>

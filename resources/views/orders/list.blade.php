<!-- resources/views/order/history.blade.php -->
@extends('main')

@section('content')
    <div class="bg0 m-t-23 p-b-140 p-t-80">
        <div class="container">
{{--            <div class="flex-w flex-sb-m p-b-52">--}}
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="all-tab" data-toggle="tab" href="#allOrders"
                       role="tab" aria-controls="home" aria-selected="true">Tất cả</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="mot-tab" data-toggle="tab" href="#motOrders"
                       role="tab" aria-controls="profile" aria-selected="false">Đang chờ</a>
                </li>
{{--                <li class="nav-item">--}}
{{--                    <a class="nav-link" id="hai-tab" data-toggle="tab" href="#haiOrders"--}}
{{--                       role="tab" aria-controls="contact" aria-selected="false">Đã đặt</a>--}}
{{--                </li>--}}
{{--                <li class="nav-item">--}}
{{--                    <a class="nav-link" id="ba-tab" data-toggle="tab" href="#baOrders"--}}
{{--                       role="tab" aria-controls="contact" aria-selected="false">Sẵn sàng</a>--}}
{{--                </li>--}}
                <li class="nav-item">
                    <a class="nav-link" id="bon-tab" data-toggle="tab" href="#bonOrders"
                       role="tab" aria-controls="contact" aria-selected="false">Đang trên đường</a>
                </li>
{{--                <li class="nav-item">--}}
{{--                    <a class="nav-link" id="nam-tab" data-toggle="tab" href="#namOrders"--}}
{{--                       role="tab" aria-controls="contact" aria-selected="false">Đang giao</a>--}}
{{--                </li>--}}
                <li class="nav-item">
                    <a class="nav-link" id="sau-tab" data-toggle="tab" href="#sauOrders"
                       role="tab" aria-controls="contact" aria-selected="false">Đã giao</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="bay-tab" data-toggle="tab" href="#bayOrders"
                       role="tab" aria-controls="contact" aria-selected="false">Đã hủy</a>
                </li>
            </ul>

            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="allOrders" role="tabpanel" aria-labelledby="all-tab">
                    <h2 class="mt-4 mb-4">Lịch Sử Đặt Hàng</h2>
                    @if(count($allOrders) > 0)
                        <ul class="list-group">
                            @foreach($allOrders as $order)
                                <li class="list-group-item mb-3 d-flex justify-content-between align-items-center">
                                    <div>
                                        <h5>Ngày đặt hàng: {{ $order->created_at->format('d/m/Y H:i:s') }}</h5>
                                        <p><strong>Mã đơn hàng:</strong> #{{ $order->invoice_number }}</p>
                                        <p><strong>Tổng tiền:</strong> {{ number_format($order->total_price, 0, '', '.') }} VND</p>
                                        <!-- Thêm thông tin khác cần thiết từ đơn đặt hàng -->

                                        <p>
                                            <strong>Trạng thái: </strong>
                                            <span>
                                            {{ $order->status }}
                                        </span>
                                        </p>

                                    </div>

                                    <a class="btn btn-secondary btn-xs" href="/orders/view-detail/{{ $order->id }}">
                                        Chi tiết
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p>Không có đơn đặt hàng nào.</p>
                    @endif
                </div>

                <div class="tab-pane fade" id="motOrders" role="tabpanel" aria-labelledby="mot-tab">
                    <h2 class="mt-4 mb-4">Đơn hàng đang chờ xử lý</h2>
                    @if(count($motOrders) > 0)
                        <ul class="list-group">
                            @foreach($motOrders as $order)
                                <li class="list-group-item mb-3 d-flex justify-content-between align-items-center">
                                    <div>
                                        <h5>Ngày đặt hàng: {{ $order->created_at->format('d/m/Y H:i:s') }}</h5>
                                        <p><strong>Mã đơn hàng:</strong> #{{ $order->invoice_number }}</p>
                                        <p><strong>Tổng tiền:</strong> {{ number_format($order->total_price, 0, '', '.') }} VND</p>
                                        <!-- Thêm thông tin khác cần thiết từ đơn đặt hàng -->

                                        <p>
                                            <strong>Trạng thái: </strong>
                                            <span>
                                            {{ $order->status }}
                                        </span>
                                        </p>

                                    </div>

                                    <a class="btn btn-secondary btn-xs" href="/orders/view-detail/{{ $order->id }}">
                                        Chi tiết
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p>Không có đơn đặt hàng nào.</p>
                    @endif
                </div>

                <div class="tab-pane fade" id="haiOrders" role="tabpanel" aria-labelledby="hai-tab">
                    <h2 class="mt-4 mb-4">Đơn hàng đã được đặt</h2>
                    @if(count($haiOrders) > 0)
                        <ul class="list-group">
                            @foreach($haiOrders as $order)
                                <li class="list-group-item mb-3 d-flex justify-content-between align-items-center">
                                    <div>
                                        <h5>Ngày đặt hàng: {{ $order->created_at->format('d/m/Y H:i:s') }}</h5>
                                        <p><strong>Mã đơn hàng:</strong> #{{ $order->invoice_number }}</p>
                                        <p><strong>Tổng tiền:</strong> {{ number_format($order->total_price, 0, '', '.') }} VND</p>
                                        <!-- Thêm thông tin khác cần thiết từ đơn đặt hàng -->

                                        <p>
                                            <strong>Trạng thái: </strong>
                                            <span>
                                            {{ $order->status }}
                                        </span>
                                        </p>

                                    </div>

                                    <a class="btn btn-secondary btn-xs" href="/orders/view-detail/{{ $order->id }}">
                                        Chi tiết
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p>Không có đơn đặt hàng nào.</p>
                    @endif
                </div>

                <div class="tab-pane fade" id="baOrders" role="tabpanel" aria-labelledby="ba-tab">
                    <h2 class="mt-4 mb-4">Đã đóng gói</h2>
                    @if(count($baOrders) > 0)
                        <ul class="list-group">
                            @foreach($baOrders as $order)
                                <li class="list-group-item mb-3 d-flex justify-content-between align-items-center">
                                    <div>
                                        <h5>Ngày đặt hàng: {{ $order->created_at->format('d/m/Y H:i:s') }}</h5>
                                        <p><strong>Mã đơn hàng:</strong> #{{ $order->invoice_number }}</p>
                                        <p><strong>Tổng tiền:</strong> {{ number_format($order->total_price, 0, '', '.') }} VND</p>
                                        <!-- Thêm thông tin khác cần thiết từ đơn đặt hàng -->

                                        <p>
                                            <strong>Trạng thái: </strong>
                                            <span>
                                            {{ $order->status }}
                                        </span>
                                        </p>

                                    </div>

                                    <a class="btn btn-secondary btn-xs" href="/orders/view-detail/{{ $order->id }}">
                                        Chi tiết
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p>Không có đơn đặt hàng nào.</p>
                    @endif
                </div>

                <div class="tab-pane fade" id="bonOrders" role="tabpanel" aria-labelledby="bon-tab">
                    <h2 class="mt-4 mb-4">Đơn hàng đang trên đường giao</h2>
                    @if(count($bonOrders) > 0)
                        <ul class="list-group">
                            @foreach($bonOrders as $order)
                                <li class="list-group-item mb-3 d-flex justify-content-between align-items-center">
                                    <div>
                                        <h5>Ngày đặt hàng: {{ $order->created_at->format('d/m/Y H:i:s') }}</h5>
                                        <p><strong>Mã đơn hàng:</strong> #{{ $order->invoice_number }}</p>
                                        <p><strong>Tổng tiền:</strong> {{ number_format($order->total_price, 0, '', '.') }} VND</p>
                                        <!-- Thêm thông tin khác cần thiết từ đơn đặt hàng -->

                                        <p>
                                            <strong>Trạng thái: </strong>
                                            <span>
                                            {{ $order->status }}
                                        </span>
                                        </p>

                                    </div>

                                    <a class="btn btn-secondary btn-xs" href="/orders/view-detail/{{ $order->id }}">
                                        Chi tiết
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p>Không có đơn đặt hàng nào.</p>
                    @endif
                </div>

                <div class="tab-pane fade" id="namOrders" role="tabpanel" aria-labelledby="nam-tab">
                    <h2 class="mt-4 mb-4">Tiến hành giao hàng</h2>
                    @if(count($namOrders) > 0)
                        <ul class="list-group">
                            @foreach($namOrders as $order)
                                <li class="list-group-item mb-3 d-flex justify-content-between align-items-center">
                                    <div>
                                        <h5>Ngày đặt hàng: {{ $order->created_at->format('d/m/Y H:i:s') }}</h5>
                                        <p><strong>Mã đơn hàng:</strong> #{{ $order->invoice_number }}</p>
                                        <p><strong>Tổng tiền:</strong> {{ number_format($order->total_price, 0, '', '.') }} VND</p>
                                        <!-- Thêm thông tin khác cần thiết từ đơn đặt hàng -->

                                        <p>
                                            <strong>Trạng thái: </strong>
                                            <span>
                                            {{ $order->status }}
                                        </span>
                                        </p>

                                    </div>

                                    <a class="btn btn-secondary btn-xs" href="/orders/view-detail/{{ $order->id }}">
                                        Chi tiết
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p>Không có đơn đặt hàng nào.</p>
                    @endif
                </div>

                <div class="tab-pane fade" id="sauOrders" role="tabpanel" aria-labelledby="sau-tab">
                    <h2 class="mt-4 mb-4">Đơn hàng đã giao</h2>
                    @if(count($sauOrders) > 0)
                        <ul class="list-group">
                            @foreach($sauOrders as $order)
                                <li class="list-group-item mb-3 d-flex justify-content-between align-items-center">
                                    <div>
                                        <h5>Ngày đặt hàng: {{ $order->created_at->format('d/m/Y H:i:s') }}</h5>
                                        <p><strong>Mã đơn hàng:</strong> #{{ $order->invoice_number }}</p>
                                        <p><strong>Tổng tiền:</strong> {{ number_format($order->total_price, 0, '', '.') }} VND</p>
                                        <!-- Thêm thông tin khác cần thiết từ đơn đặt hàng -->

                                        <p>
                                            <strong>Trạng thái: </strong>
                                            <span>
                                            {{ $order->status }}
                                        </span>
                                        </p>

                                    </div>

                                    <a class="btn btn-secondary btn-xs" href="/orders/view-detail/{{ $order->id }}">
                                        Chi tiết
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p>Không có đơn đặt hàng nào.</p>
                    @endif
                </div>

                <div class="tab-pane fade" id="bayOrders" role="tabpanel" aria-labelledby="bay-tab">
                    <h2 class="mt-4 mb-4">Đơn hàng đã hủy</h2>
                    @if(count($bayOrders) > 0)
                        <ul class="list-group">
                            @foreach($bayOrders as $order)
                                <li class="list-group-item mb-3 d-flex justify-content-between align-items-center">
                                    <div>
                                        <h5>Ngày đặt hàng: {{ $order->created_at->format('d/m/Y H:i:s') }}</h5>
                                        <p><strong>Mã đơn hàng:</strong> #{{ $order->invoice_number }}</p>
                                        <p><strong>Tổng tiền:</strong> {{ number_format($order->total_price, 0, '', '.') }} VND</p>
                                        <!-- Thêm thông tin khác cần thiết từ đơn đặt hàng -->

                                        <p>
                                            <strong>Trạng thái: </strong>
                                            <span>
                                            {{ $order->status }}
                                        </span>
                                        </p>

                                    </div>

                                    <a class="btn btn-secondary btn-xs" href="/orders/view-detail/{{ $order->id }}">
                                        Chi tiết
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p>Không có đơn đặt hàng nào.</p>
                    @endif
                </div>
            </div>
{{--            </div>--}}
        </div>
    </div>
@endsection

@extends('admin.master')

@section('content')
    <div class="row">
        <div class="col-8">
            <div class="orders mt-3">
                <ul>
                    <li><h4>Đơn Hàng #{{ $order->invoice_number }}</h4></li>
                    <li>Tên khách hàng: <strong>{{ $order->user_name }}</strong></li>
                    <li>Số điện thoại: <strong>{{ $order->shipping_phone }}</strong></li>
                    <li>Email: <strong>{{ $order->user_email }}</strong></li>
                    <li>Địa chỉ: <strong>{{ $order->shipping_address }}</strong></li>
                    <li>Tin nhắn: <strong>{{ $order->message }}</strong></li>
                </ul>
            </div>

            <div class="order-status mt-3">
                <form action="/admin/orders/edit/{{ $order->id }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="status">Trạng thái:</label>
                        <select id="statusSelect" name="status" class="form-control">
                            @foreach(['Đang chờ xử lý', 'Đơn hàng đã được đặt', 'Sẵn sàng để vận chuyển', 'Đang trên đường giao', 'Tiến hành giao hàng', 'Đã giao', 'Đã hủy'] as $status)
                                @php
                                    $notes = [
                                        'Đang chờ xử lý' => 'Đơn hàng đang được xử lý',
                                        'Đơn hàng đã được đặt' => 'Đơn hàng của bạn đã được đặt',
                                        'Sẵn sàng để vận chuyển' => 'Đơn hàng của bạn đã được đóng gói',
                                        'Đang trên đường giao' => 'Kiện hàng của bạn hiện đang ở ',
                                        'Tiến hành giao hàng' => 'Kiện hàng của bạn sẽ sớm được giao, vui lòng chú ý đến thông tin giao hàng',
                                        'Đã giao' => 'Kiện hàng của bạn đã được giao!',
                                        'Đã hủy' => 'Đơn hàng của bạn đã bị hủy'
                                        // Thêm các ghi chú tương ứng với từng trạng thái khác
                                    ];
                                @endphp
                                <option value="{{ $status }}" data-note="{{ $notes[$status] }}"
                                    {{ $order->status == $status ? 'selected' : '' }}>
                                    {{ $status }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="note">Chú thích:</label>
                        <textarea class="form-control" name="note" id="note"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Cập nhật Trạng thái</button>
                </form>
            </div>
        </div>

        <div class="col-4">
            <div class="status mt-3">
                <h3>Tiến độ đơn hàng</h3>
                @php
                    $previousStatus = '';
                @endphp

                @foreach($order->orderStatusUpdates as $statusUpdate)
                    @if ($previousStatus != $statusUpdate->status)
                        @if ($previousStatus != '')
                            </ul> <!-- Đóng danh sách trước khi bắt đầu một trạng thái mới -->
                @endif
                <h5>{{ $statusUpdate->status }}</h5>
                <ul>
                    @php
                        $previousStatus = $statusUpdate->status;
                    @endphp
                    @endif
                    <li>
                        {{ $statusUpdate->note }} <br>
                        {{ $statusUpdate->updated_at }}
                    </li>
                    @endforeach
                </ul> <!-- Đóng danh sách cuối cùng sau khi vòng lặp kết thúc -->
            </div>
        </div>

    </div>


    <div class="details mt-3">
        @php $total = 0; @endphp
        <table class="table">
            <tbody>
            <tr class="table_head">
                <th class="column-1">IMG</th>
                <th class="column-2">Tên sản phẩm</th>
                <th class="column-3">Giá</th>
                <th class="column-4">Số lượng</th>
                <th class="column-5">Tổng</th>
            </tr>

            @foreach($order->orderDetails as $detail)
                @php
                    $price = $detail->price * $detail->quantity;
                    $total += $price;
                @endphp
                <tr>
                    <td class="column-1">
                        <div class="how-itemcart1">
                            <img src="{{ $detail->product->image }}" alt="IMG" style="width: 100px; height: 100px">
                        </div>
                    </td>
                    <td class="column-2">{{ $detail->product->name }}</td>
                    <td class="column-3">{{ number_format($detail->price, 0, '', '.') }}</td>
                    <td class="column-4">{{ $detail->quantity }}</td>
                    <td class="column-5">{{ number_format($price, 0, '', '.') }}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="4" class="text-right">Tổng Tiền</td>
                <td>{{ number_format($total, 0, '', '.') }}</td>
            </tr>
            </tbody>
        </table>
    </div>

    <script>
        document.getElementById('statusSelect').addEventListener('change', function() {
            var selectedOption = this.options[this.selectedIndex];
            var noteValue = selectedOption.getAttribute('data-note');
            document.getElementById('note').value = noteValue;
        });

        // Set initial note value based on the selected status
        document.addEventListener("DOMContentLoaded", function() {
            var selectedOption = document.getElementById('statusSelect').options[document.getElementById('statusSelect').selectedIndex];
            var noteValue = selectedOption.getAttribute('data-note');
            document.getElementById('note').value = noteValue;
        });
    </script>

@endsection



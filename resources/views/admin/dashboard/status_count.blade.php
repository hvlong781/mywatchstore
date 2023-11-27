<h2>Thống kê theo trạng thái đơn đặt hàng</h2>

        <table class="table">
            <thead>
                <tr>
                    <th>Trạng thái</th>
                    <th>Số lượng</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orderStatusCount as $statusCount)
                    <tr>
                        <td>{{ $statusCount->status }}</td>
                        <td>{{ $statusCount->count }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

<div class="col-md-6 grid-margin transparent">
    <div class="row">
      <div class="col-md-6 mb-4 stretch-card transparent">
        <div class="card card-tale">
          <div class="card-body">
            <p class="mb-4">Lượt truy cập hôm nay</p>

            @php
                // Trong view (ví dụ: home.blade.php)
                $dailyStats = \App\Models\DailyStat::whereDate('date', now()->toDateString())->first();
                $dailyCount = $dailyStats ? $dailyStats->count : 0;

                $endDate = now()->toDateString();
                $startDate = now()->subDays(29)->toDateString();

                $totalVisits = \App\Models\DailyStat::whereBetween('date', [$startDate, $endDate])
                    ->get()
                    ->sum('count');
                // Hiển thị số lượt truy cập
            @endphp

            <p class="fs-30 mb-2">{{ number_format($dailyCount, 0, '', '.') }}</p>

            @if (isset($totalVisits))
                {{-- <p class="mb-2">Tổng lượt truy cập trong 30 ngày gần nhất: {{ $totalVisits }}</p> --}}

                @php
                    $ratio = $totalVisits ? ($dailyCount / max(1, $totalVisits)) : 0;
                @endphp

                <p class="mb-2">{{ number_format($ratio * 100, 2) }}% (30 ngày) trên {{ number_format($totalVisits, 0, '', '.') }} lượt</p>
            @endif
          </div>
        </div>
      </div>
      <div class="col-md-6 mb-4 stretch-card transparent">
        <div class="card card-dark-blue">
          <div class="card-body">
            <p class="mb-4">Doanh thu trong tháng {{ $currentMonth }}</p>
            <p class="fs-30 mb-2">{{ number_format($monthlyRevenue , 0, '', '.') }}</p>
            <p>({{ $monthlyOrderCount }} đơn hàng)</p>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent">
        <div class="card card-light-blue">
          <div class="card-body">
            <p class="mb-4">Tổng doanh thu</p>
            <p class="fs-30 mb-2">{{ number_format($totalRevenue, 0, '', '.') }}</p>
            <p>Đã bán {{ $totalSoldProducts }} sản phẩm</p>
          </div>
        </div>
      </div>
      <div class="col-md-6 stretch-card transparent">
        <div class="card card-light-danger">
          <div class="card-body">
            <p class="mb-4">Tổng tiền nhập hàng</p>
            <p class="fs-30 mb-2">{{ number_format($totalPurchase, 0, '', '.') }}</p>
            <p>Đã nhập {{ $totalBuyProducts }} sản phẩm</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

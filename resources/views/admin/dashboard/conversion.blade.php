<div class="row">
    <div class="col-lg-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <p class="card-title">Tỉ lệ mua hàng</p>
                <div>
                    <p>Tỷ lệ chuyển đổi từ lượt xem đến quyết định mua hàng: {{ number_format($conversionRate, 2) }}%</p>
                </div>
                <div>
                    <canvas id="conversionChart" width="400" height="200"></canvas>
                </div>

                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/moment"></script>

                <script>
                    var ctx = document.getElementById('conversionChart').getContext('2d');
                    var conversionChart = new Chart(ctx, {
                        type: 'doughnut', // Có thể thay đổi loại biểu đồ tại đây
                        data: {
                            labels: ['Lượt xem', 'Đơn hàng đã mua'],
                            datasets: [{
                                data: [{{ $totalViews }}, {{ $totalPurchases }}],
                                backgroundColor: ['#36A2EB', '#FF6384'],
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            title: {
                                display: true,
                                text: 'Biểu đồ tỷ lệ chuyển đổi'
                            }
                        }
                    });
                </script>
            </div>
        </div>
    </div>

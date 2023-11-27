<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <p class="card-title">Doanh số bán hàng</p>
                <div>
                    <canvas id="salesChart" width="400" height="200"></canvas>
                </div>


                <script>
                    if (typeof Chart === 'undefined') {
                        console.error('Chart.js is not loaded!');
                    } else {
                        var salesData = @json($salesData);

                        var dates = salesData.map(function(data) {
                            return moment(data.date).toDate(); // Chuyển đổi ngày thành đối tượng Date
                        });

                        var totals = salesData.map(function(data) {
                            return data.total;
                        });

                        var ctx = document.getElementById('salesChart').getContext('2d');
                        var myChart = new Chart(ctx, {
                            type: 'line',
                            data: {
                                labels: dates,
                                datasets: [{
                                    label: 'Doanh số bán hàng',
                                    data: totals,
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                scales: {
                                    x: [{
                                        type: 'time',
                                        time: {
                                            unit: 'day',
                                            displayFormats: {
                                                day: 'MMM D'
                                            }
                                        }
                                        // time: {
                                        //     unit: 'month', // Thay đổi unit thành 'month' để hiển thị theo tháng
                                        //     displayFormats: {
                                        //         month: 'MMM YYYY' // Format hiển thị tháng và năm
                                        //     }
                                        // }
                                    }],
                                    y: {
                                        beginAtZero: true
                                    }
                                }
                            }
                        });
                    }
                </script>
            </div>
        </div>
    </div>
</div>

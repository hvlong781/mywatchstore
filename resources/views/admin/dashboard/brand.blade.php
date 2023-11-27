
    <div class="col-lg-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <p class="card-title">Số sản phẩm trong mỗi thương hiệu</p>

                <div>
                    <canvas id="productBrandChart" width="400" height="200"></canvas>
                </div>

                <script>
                    if (typeof Chart === 'undefined') {
                        console.error('Chart.js is not loaded!');
                    } else {
                        var productData = @json($productData_brand);

                        var brands = productData.map(function(data) {
                            return data.brand_name;
                        });

                        var quantities = productData.map(function(data) {
                            return data.quantity;
                        });

                        var ctx = document.getElementById('productBrandChart').getContext('2d');
                        var myChart = new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: brands,
                                datasets: [{
                                    label: 'Số lượng sản phẩm',
                                    data: quantities,
                                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                    borderColor: 'rgba(75, 192, 192, 1)',
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                scales: {
                                    x: {
                                        beginAtZero: true
                                    },
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

<div class="row">
    <div class="col-lg-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <p class="card-title">Số sản phẩm trong mỗi danh mục</p>

                <div>
                    <canvas id="productCategoryChart" width="400" height="200"></canvas>
                </div>

                <script>
                    if (typeof Chart === 'undefined') {
                        console.error('Chart.js is not loaded!');
                    } else {
                        var productData = @json($category_count_product);

                        var categories = productData.map(function(data) {
                            return data.category_name;
                        });

                        var quantities = productData.map(function(data) {
                            return data.quantity;
                        });

                        var ctx = document.getElementById('productCategoryChart').getContext('2d');
                        var myChart = new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: categories,
                                datasets: [{
                                    label: 'Số lượng sản phẩm',
                                    data: quantities,
                                    backgroundColor: 'rgba(125, 142, 252, 0.2)',
                                    borderColor: 'rgba(125, 142, 252, 1)',
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

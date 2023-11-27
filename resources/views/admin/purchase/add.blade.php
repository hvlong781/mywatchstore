@extends('admin.master')

@section('content')
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="supplier_id">Nhà cung cấp</label>
                        <select class="form-control" name="supplier_id" required>
                            @foreach($suppliers as $supplier)
                                <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group" id="productsContainer">
                        <label for="products">Sản phẩm:</label>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="product_id">Tên:</label>
                                <select class="form-control product-select" name="products[0][product_id]" required>
                                    @foreach($products as $product)
                                        <option value="{{ $product->id }}" data-price="{{ $product->price }}">{{ $product->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="quantity">Số lượng:</label>
                                <input type="number" class="form-control quantity-input" name="products[0][quantity]" min="1" required>
                            </div>
                            <div class="col-md-4">
                                <label for="price_per_item">Đơn giá:</label>
                                <input type="number" class="form-control price-input" name="products[0][price_per_item]" min="0" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <button type="button" class="btn btn-success" onclick="addProduct()">Thêm</button>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group text-right">
        {{--                        <label>Total Price:</label>--}}
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Tổng tiền</span>
                                    </div>
                                    <p id="totalPrice" class="form-control">0 VND</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Thêm Phiếu</button>

                    @csrf
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    let productIndex = 1;

    function addProduct() {
        const container = document.getElementById('productsContainer');

        const newProduct = document.createElement('div');
        newProduct.className = 'row mb-3';

        newProduct.innerHTML = `
                <div class="col-md-4">
                    <label for="product_id">Product:</label>
                        <select class="form-control product-select" name="products[${productIndex}][product_id]" required>
                                        @foreach($products as $product)
                        <option value="{{ $product->id }}" data-price="{{ $product->price }}">{{ $product->name }}</option>
                                        @endforeach
                        </select>
                </div>
                <div class="col-md-4">
                    <label for="quantity">Quantity:</label>
                    <input type="number" class="form-control quantity-input" name="products[${productIndex}][quantity]" min="1" required>
                </div>
                <div class="col-md-4">
                    <label for="price_per_item">Price per Item:</label>
                    <input type="number" class="form-control price-input" name="products[${productIndex}][price_per_item]" min="0" required>
                </div>
            `;

        container.appendChild(newProduct);
        productIndex++;

        // Lắng nghe sự kiện input trên trường số lượng và đơn giá của sản phẩm mới thêm
        newProduct.querySelectorAll('.quantity-input, .price-input').forEach(input => {
            input.addEventListener('input', updateTotalPrice);
        });

        // Lắng nghe sự kiện change trên trường sản phẩm để cập nhật giá trị đơn giá
        newProduct.querySelector('.product-select').addEventListener('change', updateProductPrice);
    }

    function updateTotalPrice() {
        let total = 0;

        document.querySelectorAll('.row.mb-3').forEach(row => {
            const quantity = parseFloat(row.querySelector('.quantity-input').value) || 0;
            const pricePerItem = parseFloat(row.querySelector('.price-input').value) || 0;
            total += quantity * pricePerItem;
        });

        document.getElementById('totalPrice').textContent = total.toFixed(2);
    }

    function updateProductPrice(event) {
        const selectedOption = event.target.selectedOptions[0];
        const priceInput = event.target.closest('.row').querySelector('.price-input');
        priceInput.value = selectedOption.dataset.price || 0;

        updateTotalPrice();
    }

    // Lắng nghe sự kiện input trên trường số lượng và đơn giá của sản phẩm đầu tiên
    document.querySelectorAll('.quantity-input, .price-input').forEach(input => {
        input.addEventListener('input', updateTotalPrice);
    });

    // Lắng nghe sự kiện change trên trường sản phẩm đầu tiên để cập nhật giá trị đơn giá
    document.querySelector('.product-select').addEventListener('change', updateProductPrice);
</script>
@endsection

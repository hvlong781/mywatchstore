<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\PurchaseOrder;
use App\Models\Supplier;
use Illuminate\Http\Request;

class PurchaseOrderController extends Controller
{
    public function index()
    {
        $purchaseOrders = PurchaseOrder::orderByDesc('id')->paginate(15);
        return view('admin.purchase.list', [
            'title' => 'Danh Sách Phiếu Nhập Hàng',
            'purchase' => $purchaseOrders
        ]);
    }

    public function create()
    {
        $suppliers = Supplier::all();
        $products = Product::all();
        return view('admin.purchase.add', [
            'title' => 'Thêm Phiếu Nhập Hàng',
            'suppliers' => $suppliers,
            'products' => $products,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'products' => 'required|array',
            'products.*.product_id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
            'products.*.price_per_item' => 'required|numeric|min:0',
        ]);

        // Tính toán tổng giá trị của các sản phẩm
        $totalPrice = 0;
        foreach ($request->input('products') as $productData) {
            $totalPrice += $productData['quantity'] * $productData['price_per_item'];
        }

        // Tạo phiếu nhập hàng với tổng giá trị
        $purchaseOrder = PurchaseOrder::create([
            'supplier_id' => $request->input('supplier_id'),
            'total_price' => $totalPrice,
        ]);

        // Thêm chi tiết phiếu nhập hàng
        foreach ($request->input('products') as $productData) {
            $purchaseOrder->details()->create([
                'product_id' => $productData['product_id'],
                'quantity' => $productData['quantity'],
                'price_per_item' => $productData['price_per_item'],
            ]);

            // Cập nhật số lượng sản phẩm
            $product = Product::find($productData['product_id']);
            $product->increaseQuantity($productData['quantity']);
        }

        return redirect('/admin/purchase')->with('success', 'Nhập hàng thành công!');
    }

    public function show($id)
    {
        $purchaseOrder = PurchaseOrder::with('supplier', 'details.product')->findOrFail($id);

        return view('admin.purchase.show', [
            'title' => 'Chi tiết nhập hàng',
            'purchase' => $purchaseOrder
        ]);
    }
}

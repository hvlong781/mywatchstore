<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Carbon;
use App\Models\Product;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderDetail;

class AdminController extends Controller
{
    public function index()
    {
        $salesData = Order::where('status', 'Đã giao')
                    ->select(DB::raw('date(created_at) as date'), DB::raw('sum(total_price) as total'))
                    ->groupBy('date')
                    ->get();

        // $salesData = Order::select(DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month'), DB::raw('SUM(total_price) as total'))
        //             ->groupBy('month')
        //             ->get();

        $orderStatusCount = Order::select('status', DB::raw('count(*) as count'))
                    ->groupBy('status')
                    ->get();

        $newCustomers = User::where('created_at', '>=', Carbon::now()->subDays(30))->count();

        $totalViews = Product::sum('views');
        $totalPurchases = Order::where('status', 'Đã giao')->count();
        $conversionRate = ($totalPurchases / $totalViews) * 100;

        $category_count_product = $this->productData_category();

        $productData_brand = $this->productData_brand();

        $calculateRevenue = $this->calculateRevenue();

        $totalPurchase = $this->calculateTotalPurchase();

        $monthlyRevenue = $this->calculateMonthlyRevenue();

        $currentMonth = Carbon::now()->month;

        $monthlyOrderCount = $this->getMonthlyOrderCount();

        $totalBuyProducts = $this->getTotalBuyProducts();

        $totalSoldProducts = $this->getTotalSoldProducts();

        return view('admin.dashboard.home',[
            'title' => 'Thống Kê',
            'salesData' => $salesData,
            'orderStatusCount' => $orderStatusCount,
            'newCustomers' => $newCustomers,
            'totalViews' => $totalViews,
            'totalPurchases' => $totalPurchases,
            'conversionRate' => $conversionRate,
            'category_count_product' => $category_count_product,
            'productData_brand' => $productData_brand,
            'totalRevenue' => $calculateRevenue,
            'totalPurchase' => $totalPurchase,
            'monthlyRevenue' => $monthlyRevenue,
            'currentMonth' => $currentMonth,
            'monthlyOrderCount' => $monthlyOrderCount,
            'totalBuyProducts' => $totalBuyProducts,
            'totalSoldProducts' => $totalSoldProducts,
        ]);
    }

    public function getMonthlyOrderCount()
    {
        $currentMonth = Carbon::now()->month;

        // Đếm số đơn hàng từ bảng orders trong tháng hiện tại
        $monthlyOrderCount = Order::whereMonth('created_at', $currentMonth)
            ->where('status', 'Đã giao')->count();

        return $monthlyOrderCount;
    }

    public function calculateMonthlyRevenue()
    {
        $currentMonth = Carbon::now()->month;

        // Tính tổng doanh thu từ bảng orders trong tháng hiện tại
        $monthlyRevenue = Order::whereMonth('created_at', $currentMonth)
            ->where('status', 'Đã giao')->sum('total_price');

        return $monthlyRevenue;
    }

    public function productData_category()
    {
        $category_count_product = Product::join('product_categories', 'products.category_id', '=', 'product_categories.id')
                    ->select('product_categories.name as category_name', DB::raw('COUNT(*) as quantity'))
                    ->groupBy('product_categories.name')
                    ->get();

        return $category_count_product;
    }

    public function productData_brand()
    {
        $productData_brand = Product::join('brands', 'products.brand_id', '=', 'brands.id')
                    ->select('brands.name as brand_name', DB::raw('COUNT(*) as quantity'))
                    ->groupBy('brands.name')
                    ->get();

        return $productData_brand;
    }

    public function calculateRevenue()
    {
        // Tính tổng doanh thu từ bảng orders
        $totalRevenue = Order::where('status', 'Đã giao')->sum('total_price');

        return $totalRevenue;
    }

    public function getTotalSoldProducts()
    {
        // Tính tổng số lượng sản phẩm từ bảng order_details cho các đơn hàng có trạng thái success
        $totalSoldProducts = DB::table('order_details')
            ->join('orders', 'order_details.order_id', '=', 'orders.id')
            ->where('orders.status', 'Đã giao')
            ->sum('order_details.quantity');

        return $totalSoldProducts;
    }

    public function calculateTotalPurchase()
    {
        // Tính tổng tiền nhập hàng từ bảng purchase_orders
        $totalPurchase = PurchaseOrder::sum('total_price');

        return $totalPurchase;
    }

    public function getTotalBuyProducts()
    {
        // Tính tổng số lượng sản phẩm từ bảng order_details
        $totalBuyProducts = PurchaseOrderDetail::sum('quantity');

        return $totalBuyProducts;
    }
}

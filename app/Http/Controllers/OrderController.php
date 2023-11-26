<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderStatusUpdate;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        $user = auth()->user(); // Lấy thông tin người dùng đã đăng nhập
        $allOrders = Order::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();
        $motOrders = Order::where('user_id', $user->id)->where('status', 'Đang chờ xử lý')->orderBy('created_at', 'desc')->get();
        $haiOrders = Order::where('user_id', $user->id)->where('status', 'Đơn hàng đã được đặt')->orderBy('created_at', 'desc')->get();
        $baOrders = Order::where('user_id', $user->id)->where('status', 'Sẵn sàng để vận chuyển')->orderBy('created_at', 'desc')->get();
        $bonOrders = Order::where('user_id', $user->id)->where('status', 'Đang trên đường giao')->orderBy('created_at', 'desc')->get();
        $namOrders = Order::where('user_id', $user->id)->where('status', 'Tiến hành giao hàng')->orderBy('created_at', 'desc')->get();
        $sauOrders = Order::where('user_id', $user->id)->where('status', 'Đã giao')->orderBy('created_at', 'desc')->get();
        $bayOrders = Order::where('user_id', $user->id)->where('status', 'Đã hủy')->orderBy('created_at', 'desc')->get();

        return view('orders.list', [
            'title' => 'Lịch Sử Đặt Hàng',
            'allOrders' => $allOrders,
            'motOrders' => $motOrders,
            'haiOrders' => $haiOrders,
            'baOrders' => $baOrders,
            'bonOrders' => $bonOrders,
            'namOrders' => $namOrders,
            'sauOrders' => $sauOrders,
            'bayOrders' => $bayOrders,

            'menus' => ProductCategory::select('name', 'image', 'id')
                ->where('parent_id', 0)
                ->orderbyDesc('id')
                ->get()
        ]);
    }

    // app/Http/Controllers/OrderController.php
    public function show($id)
    {
        $order = Order::with('orderDetails', 'user', 'orderStatusUpdates')->findOrFail($id);

        $latestUpdate = OrderStatusUpdate::where('order_id', $id)
            ->where('status', 'Sẵn sàng để vận chuyển')
            ->orderBy('updated_at', 'desc')
            ->first();

        // Truyền đối tượng đơn hàng đến view chi tiết
        return view('orders.show', [
            'title' => 'Chi Tiết Đơn Hàng',
            'order' => $order,
            'shippingReadyDate' => $latestUpdate,
            'menus' => ProductCategory::select('name', 'image', 'id')
                ->where('parent_id', 0)
                ->orderbyDesc('id')
                ->get(),

        ]);
    }

    public function cancel(Order $order)
    {
        try {
            DB::beginTransaction();

            // Lấy danh sách chi tiết đơn hàng
            $orderDetails = $order->orderDetails;

            // Duyệt qua danh sách chi tiết đơn hàng và hoàn trả số lượng sản phẩm
            foreach ($orderDetails as $orderDetail) {
                $product = Product::find($orderDetail->product_id);

                // Kiểm tra xem sản phẩm có tồn tại không
                if ($product) {
                    // Tăng số lượng sản phẩm
                    $product->quantity += $orderDetail->quantity;
                    $product->save();
                }
            }

            // Cập nhật trạng thái đơn hàng thành 'Đã hủy'
            $order->update(['status' => 'Đã hủy']);

            DB::commit();

            // Redirect hoặc trả về thông báo thành công
            return redirect()->back()->with('success', 'Đơn hàng đã được hủy.');
        } catch (\Exception $err) {
            DB::rollBack();

            // Redirect hoặc trả về thông báo lỗi
            return redirect()->back()->with('error', 'Có lỗi xảy ra khi hủy đơn hàng.');
        }
    }


}

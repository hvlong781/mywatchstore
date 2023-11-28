<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderStatusUpdate;
use Illuminate\Http\Request;

class OrderAdminController extends Controller
{
    public function index()
    {
        $orders = Order::orderByDesc('id')->paginate(15);

        return view('admin.order.list', [
            'title' => 'Danh Sách Đơn Đặt Hàng',
            'orders' => $orders,
        ]);
    }

    public function show($id)
    {
        $order = Order::with('orderDetails', 'user', 'orderStatusUpdates')->findOrFail($id);

        $order->orderStatusUpdates = $order->orderStatusUpdates->sortByDesc('updated_at');

        return view('admin.order.detail', [
            'title' => 'Chi Tiết Đơn Đặt Hàng',
            'order' => $order
        ]);
    }


    public function update(Request $request, Order $order)
    {
        $status = $request->status;

        $statuses = [
            'Đang chờ xử lý' => 1,
            'Đơn hàng đã được đặt' => 2,
            'Sẵn sàng để vận chuyển' => 3,
            'Đang trên đường giao' => 4,
            'Tiến hành giao hàng' => 5,
            'Đã giao' => 6,
            'Đã hủy' => 7
        ];

        $previousStatusUpdates = $order->orderStatusUpdates()->orderByDesc('updated_at')->get();
        $latestStatus = $previousStatusUpdates->first()->status ?? 'Đang chờ xử lý';

        if ($status === 'Đang chờ xử lý') {
            return redirect()->back()->with('error', 'Hãy xử lý đơn hàng.');
        }

        if ($order->status === 'Đơn hàng đã được đặt' && $status === 'Đơn hàng đã được đặt') {
            return redirect()->back()->with('error', 'Hãy xử lý bước kế tiếp.');
        }

        if ($order->status === 'Sẵn sàng để vận chuyển' && $status === 'Sẵn sàng để vận chuyển') {
            return redirect()->back()->with('error', 'Hãy xử lý bước kế tiếp.');
        }

        if ($order->status === 'Tiến hành giao hàng' && $status === 'Tiến hành giao hàng') {
            return redirect()->back()->with('error', 'Hãy xử lý bước kế tiếp.');
        }

        if ($order->status === 'Đã hủy' || $order->status === 'Đã giao') {
            return redirect()->back()->with('error', 'Không thể cập nhật đơn hàng.');
        }

        if ($statuses[$status] > $statuses[$latestStatus] + 1 && $status !== 'Đã hủy') {
            return redirect()->back()->with('error', 'Không thể cập nhật trạng thái do chưa hoàn thành bước trước.');
        }

        if ($status === 'Đã hủy') {
            // Lấy chi tiết đơn hàng (sản phẩm đã đặt)
            $orderDetails = $order->orderDetails;

            // Lặp qua từng chi tiết đơn hàng để hoàn lại số lượng sản phẩm
            foreach ($orderDetails as $orderDetail) {
                // Lấy sản phẩm và cập nhật số lượng trong kho
                $product = $orderDetail->product;
                $product->quantity += $orderDetail->quantity;
                $product->save();
            }
        }

        if ($status === 'Đã giao') {
            // Cập nhật giá trị cho order
            $order->status_payment = 1;
        }

        OrderStatusUpdate::create([
            'order_id' => $order->id,
            'status' => $status,
            'note' => $request->note,
        ]);

        $order->update(['status' => $status]);

        return redirect()->back()->with('success', 'Cập nhật trạng thái thành công');
    }

}

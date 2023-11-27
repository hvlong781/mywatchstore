<?php


namespace App\Http\Services;


use App\Jobs\SendMail;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CartService
{
    public function create($request)
    {
        $qty = (int)$request->input('num_product');
        $product_id = (int)$request->input('product_id');

        if ($qty <= 0 || $product_id <= 0) {
            Session::flash('error', 'Số lượng hoặc Sản phẩm không chính xác');
            return false;
        }

        if (!$this->checkProductQuantity($product_id, $qty)) {
            Session::flash('error', 'Số lượng sản phẩm không đủ');
            return false;
        }

        $carts = Session::get('carts');
        if (is_null($carts)) {
            Session::put('carts', [
                $product_id => $qty
            ]);
            return true;
        }

        $exists = Arr::exists($carts, $product_id);

        // Kiểm tra nếu sản phẩm đã tồn tại và số lượng mới không vượt qua số lượng sản phẩm
        if ($exists && !$this->checkProductQuantity($product_id, $carts[$product_id] + $qty)) {
            Session::flash('error', 'Số lượng sản phẩm không đủ');
            return false;
        }

        if ($exists) {
            $carts[$product_id] = $carts[$product_id] + $qty;
        } else {
            // Thêm sản phẩm mới vào đầu mảng
            $carts = [$product_id => $qty] + $carts;
        }

        Session::put('carts', $carts);
        return true;
    }

    private function checkProductQuantity($product_id, $qty)
    {
        $product = Product::find($product_id);
        return $product->quantity >= $qty;
    }



//    public function getProduct()
//    {
//        $carts = Session::get('carts');
//        if (is_null($carts)) return [];
//
//        $productId = array_keys($carts);
//        return Product::select('id', 'name', 'price', 'price_sale', 'thumb')
//            ->where('active', 1)
//            ->whereIn('id', $productId)
//            ->orderByRaw(DB::raw("FIELD(id, " . implode(',', $productId) . ")"))
//            ->get();
//    }
    public function getProduct()
    {
        $carts = Session::get('carts') ?? [];

        $productId = array_keys($carts);

        // Kiểm tra nếu $productId không rỗng
        if (!empty($productId)) {
            $orderingString = "FIELD(id, " . implode(',', $productId) . ")";

            $products = Product::select('id', 'name', 'price', 'quantity', 'image')
                ->where('active', 1)
                ->whereIn('id', $productId)
                ->orderByRaw($orderingString)
                ->get();
        } else {
            // Nếu không có sản phẩm nào trong giỏ hàng
            $products = collect([]);
        }

        return $products;
    }


    public function update($request)
    {
        $carts = $request->input('num_product');

        // Kiểm tra số lượng sản phẩm trước khi cập nhật giỏ hàng
        if (!$this->checkProductQuantities($carts)) {
            Session::flash('error', 'Số lượng sản phẩm không đủ');
            return false;
        }

        Session::put('carts', $carts);
        Session::flash('success', 'Cập nhật Thành Công');

        return true;
    }

    private function checkProductQuantities($carts)
    {
        foreach ($carts as $product_id => $qty) {
            $product = Product::find($product_id);
            if ($product->quantity < $qty) {
                return false;
            }
        }

        return true;
    }


    public function remove($id)
    {
        $carts = Session::get('carts');
        unset($carts[$id]);

        Session::put('carts', $carts);
        Session::flash('success', 'Đã xóa sản phẩm khỏi giỏ hàng');
        return true;
    }

    public function placeOrder($request)
    {
        try {
            DB::beginTransaction();

            $carts = Session::get('carts');

            if (is_null($carts)) {
                return false;
            }

            $user = Auth::user();

            $order = new Order();
            $order->user_id = $user->id;
            $order->status = 'Đang chờ xử lý';
            $order->user_name = $request->name;
            $order->user_email = $request->email;
            $order->shipping_address = $request->address;
            $order->shipping_phone = $request->phone;
            $order->total_price = $request->total_price;
            $order->payment_method = 'pay_on_delivery';
            $order->message = $request->message;
            $order->invoice_number = 'INV-' . time() . '-' . mt_rand(1000, 9999);
            $order->save();

            $productId = array_keys($carts);
            $products = Product::select('id', 'price', 'quantity')
                ->whereIn('id', $productId)
                ->where('active', 1)
                ->get();

            foreach ($carts as $productId => $quantity) {
                $product = $products->firstWhere('id', $productId);
                if ($product && $product->quantity >= $quantity) {
                    $orderDetail = new OrderDetail();
                    $orderDetail->order_id = $order->id;
                    $orderDetail->product_id = $product->id;
                    $orderDetail->quantity = $quantity;
                    $orderDetail->price = $product->price;
                    $orderDetail->save();

                    // Giảm số lượng sản phẩm từ kho
                    $product->quantity -= $quantity;
                    $product->save();
                } else {
                    // Nếu số lượng không đủ, hủy đơn đặt hàng và hiển thị thông báo lỗi
                    DB::rollBack();
                    session()->flash('error', 'Số lượng sản phẩm không đủ');
                    return false;
                }
            }

            DB::commit();
            Session::flash('success', 'Đặt Hàng Thành Công');

            SendMail::dispatch($request->input('email'))->delay(now()->addSeconds(2));

            Session::forget('carts');
        } catch (\Exception $err) {
            DB::rollBack();
            session()->flash('error', 'Đặt Hàng Lỗi, Vui lòng thử lại sau');
            return false;
        }

        return true;
    }

}

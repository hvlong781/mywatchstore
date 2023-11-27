<?php

namespace App\Http\Controllers;


use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use App\Http\Services\CartService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function index(Request $request)
    {
        $result = $this->cartService->create($request);
        if ($result === false) {
            return redirect()->back();
        }

        return redirect('/carts')->with('success', 'Thêm thành công sản phẩm vào giỏ hàng');
    }

    public function show()
    {
        $products = $this->cartService->getProduct();
        $user = Auth::user();

        return view('carts.list', [
            'title' => 'Giỏ Hàng',
            'products' => $products,
            'user' => $user,
            'carts' => Session::get('carts'),
            'menus' => ProductCategory::select('name', 'image', 'id')
                ->where('parent_id', 0)
                ->orderbyDesc('id')
                ->get()
        ]);
    }

    public function update(Request $request)
    {
        $this->cartService->update($request);

        return redirect('/carts');
    }

    public function remove($id = 0)
    {
        $this->cartService->remove($id);

        return redirect('/carts');
    }

    public function placeOrder(Request $request)
    {
        $result = $this->cartService->placeOrder($request);

        if (!$result) {
            // Xử lý nếu đặt hàng không thành công
            return redirect()->back()->with('error', 'Đặt Hàng Lỗi, Vui lòng thử lại sau');
        }

        // Đặt hàng thành công
        return redirect()->back()->with('success', 'Đặt Hàng Thành Công');
    }

    public function vnPayment(Request $request)
    {

    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Vnsoft\Vnpay\Facades\Vnpay;

class PaymentController extends Controller
{
    public function createPayment(Request $request)
    {
        // Lấy thông tin giỏ hàng và tổng giá trị
        // $cart = getCart(); // Hàm lấy thông tin giỏ hàng của bạn
        // $totalAmount = calculateTotal($cart); // Hàm tính tổng giá trị của giỏ hàng

        // Tạo request thanh toán
        $data = [
            'vnp_TmnCode' => config('vnpay.VNPAY_TMNC'),
            'vnp_Amount' => 1000000 * 100, // Đơn vị là đồng
            'vnp_Command' => 'pay',
            'vnp_CreateDate' => now()->format('YmdHis'),
            'vnp_CurrCode' => 'VND',
            'vnp_IpAddr' => $request->ip(),
            'vnp_Locale' => 'vn',
            'vnp_OrderInfo' => 'Thông tin đơn hàng',
            'vnp_OrderType' => 'billpayment',
            'vnp_ReturnUrl' => url('/payment/callback'),
            'vnp_TxnRef' => uniqid(),
            'vnp_Version' => '2.0.0',
        ];

        // Tạo URL thanh toán
        $vnpayUrl = Vnpay::createRequestUrl($data);

        // Chuyển hướng người dùng đến trang thanh toán VNPAY
        return redirect($vnpayUrl);
    }

    public function paymentCallback(Request $request)
    {
        $vnpayData = $request->all();

        // Kiểm tra xác thực response từ VNPAY
        if (Vnpay::validateResponse($vnpayData)) {
            // Xác nhận thanh toán thành công
            // Thực hiện các xử lý sau khi thanh toán thành công
            // Ví dụ: cập nhật trạng thái đơn hàng, gửi email xác nhận, v.v.

            return 'Thanh toán thành công';
        } else {
            // Xác nhận thanh toán thất bại
            // Thực hiện các xử lý sau khi thanh toán thất bại
            return 'Thanh toán thất bại';
        }
    }
}

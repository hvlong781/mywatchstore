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

        if ($result) {
            return redirect()->back()->with('success', 'Đặt Hàng Thành Công');
        }
        return redirect()->back()->with('error', 'Đặt Hàng Lỗi, Vui lòng thử lại sau');
    }

    public function vnPayment(Request $request)
    {
        $data = $request->all();
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://mywatchstore.vn/vnpayment/callback";
        $vnp_TmnCode = "NYGGCAOQ";//Mã website tại VNPAY
        $vnp_HashSecret = "QZPYPAHQUDGTQQJSLITXQHVDEXJBILIF"; //Chuỗi bí mật

        $vnp_TxnRef = 'INV-' . time() . '-' . mt_rand(1000, 9999); //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = 'Test thanh toán VNpay';
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = $data['total_vnpay'] * 100;
        $vnp_Locale = 'vn';
        $vnp_BankCode = 'NCB';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        //Add Params of 2.0.1 Version
        // $vnp_ExpireDate = $_POST['txtexpire'];
        //Billing

        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
            // "vnp_ExpireDate"=>$vnp_ExpireDate,
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        // if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
        //     $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        // }

        //var_dump($inputData);
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array('code' => '00'
            , 'message' => 'success'
            , 'data' => $vnp_Url);

        $this->cartService->vnPayment_service($request, $vnp_TxnRef);

        if (isset($_POST['redirect'])) {
            header('Location: ' . $vnp_Url);
            die();
        } else {
            echo json_encode($returnData);
        }
    }

    public function returnUrl(Request $request)
    {
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_apiUrl = "http://sandbox.vnpayment.vn/merchant_webapi/merchant.html";
        $apiUrl = "https://sandbox.vnpayment.vn/merchant_webapi/api/transaction";
        $vnp_Returnurl = "http://mywatchstore.vn/vnpayment/callback";
        $vnp_TmnCode = "NYGGCAOQ";//Mã website tại VNPAY
        $vnp_HashSecret = "QZPYPAHQUDGTQQJSLITXQHVDEXJBILIF"; //Chuỗi bí mật


        $inputData = array();
        $returnData = array();


        foreach ($_GET as $key => $value) {
            if (substr($key, 0, 4) == "vnp_") {
                $inputData[$key] = $value;
            }
        }

        $vnp_SecureHash = $inputData['vnp_SecureHash'];
        unset($inputData['vnp_SecureHash']);
        ksort($inputData);
        $i = 0;
        $hashData = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashData = $hashData . '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashData = $hashData . urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
        }

        $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);
        $vnpTranId = $inputData['vnp_TransactionNo']; //Mã giao dịch tại VNPAY
        $vnp_BankCode = $inputData['vnp_BankCode']; //Ngân hàng thanh toán
        $vnp_Amount = $inputData['vnp_Amount']/100; // Số tiền thanh toán VNPAY phản hồi

        $Status = 0; // Là trạng thái thanh toán của giao dịch chưa có IPN lưu tại hệ thống của merchant chiều khởi tạo URL thanh toán.
        $orderId = $inputData['vnp_TxnRef'];

        try {
            //Check Orderid
            //Kiểm tra checksum của dữ liệu
            if ($secureHash == $vnp_SecureHash) {
                //Lấy thông tin đơn hàng lưu trong Database và kiểm tra trạng thái của đơn hàng, mã đơn hàng là: $orderId
                //Việc kiểm tra trạng thái của đơn hàng giúp hệ thống không xử lý trùng lặp, xử lý nhiều lần một giao dịch
                //Giả sử: $order = mysqli_fetch_assoc($result);

                $order = Order::where('invoice_number', $orderId)->first();

                if ($order != NULL) {
                    if($order["total_price"] == $vnp_Amount) //Kiểm tra số tiền thanh toán của giao dịch: giả sử số tiền kiểm tra là đúng. //$order["Amount"] == $vnp_Amount
                    {
                        if ($order["status_payment"] == 0) {
                            if ($inputData['vnp_ResponseCode'] == '00' || $inputData['vnp_TransactionStatus'] == '00') {
                                $Status = 1; // Trạng thái thanh toán thành công

                            } else {
                                $Status = 2; // Trạng thái thanh toán thất bại / lỗi
                            }

                            //Cài đặt Code cập nhật kết quả thanh toán, tình trạng đơn hàng vào DB

                            if($Status == 1){
                                DB::beginTransaction();

                                $order->status_payment = 1;

                                // Lưu thay đổi
                                $order->save();

                                // Commit giao dịch
                                DB::commit();

                            Session::forget('carts');
                            session()->flash('success', 'Thanh toán thành công');
                            }
                            else {
                                if ($order) {
                                    // Kiểm tra xem đơn hàng đã thanh toán hay chưa
                                    if ($order->payment_status == 0) {
                                        // Bắt đầu một giao dịch cơ sở dữ liệu
                                        DB::beginTransaction();

                                        // Xóa chi tiết đơn hàng
                                        $order->orderDetails()->delete();

                                        // Xóa đơn hàng
                                        $order->delete();

                                        // Commit giao dịch
                                        DB::commit();

                                        // Thông báo xóa đơn hàng thành công
                                        session()->flash('success', 'Đã hủy thanh toán.');
                                    } else {
                                        // Thông báo không thể xóa đơn hàng đã thanh toán
                                        session()->flash('error', 'Không thể xóa đơn hàng đã thanh toán');
                                    }
                                } else {
                                    // Thông báo không tìm thấy đơn hàng
                                    session()->flash('error', 'Không tìm thấy đơn hàng');
                                }
                            }
                            //
                                                //
                            //Trả kết quả về cho VNPAY: Website/APP TMĐT ghi nhận yêu cầu thành công
                        } else {
                            $returnData['RspCode'] = '02';
                            $returnData['Message'] = 'Order already confirmed';
                        }
                    }
                    else {
                        $returnData['RspCode'] = '04';
                        $returnData['Message'] = 'invalid amount';
                    }
                } else {
                    $returnData['RspCode'] = '01';
                    $returnData['Message'] = 'Order not found';
                }
            } else {
                $returnData['RspCode'] = '97';
                $returnData['Message'] = 'Invalid signature';
            }
        } catch (\Exception $e) {
            $returnData['RspCode'] = '99';
            $returnData['Message'] = 'Unknow error';
        }
        //Trả lại VNPAY theo định dạng JSON
        echo json_encode($returnData);
        $products = $this->cartService->getProduct();
        $user = Auth::user();

        return view('carts.list',[
            'title' => 'Thông Báo',
            'products' => $products,
            'carts' => Session::get('carts'),
            'user' => $user,
            'menus' => ProductCategory::select('name', 'image', 'id')
                ->where('parent_id', 0)
                ->orderbyDesc('id')
                ->get()
        ]);
    }


}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderAdminController extends Controller
{
    public function index()
    {
        return view('admin.order.list', [
            'title' => 'Danh Sách Đơn Đặt Hàng',

        ]);
    }
}

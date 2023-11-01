<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class CategoryAdminController extends Controller
{
    public function index()
    {
        return view('admin.category.list', [
           'title' => 'Danh Sách Danh Mục',

        ]);
    }

    public function create()
    {
        return view('admin.category.add', [
            'title' => 'Thêm Danh Mục',
        ]);
    }
}

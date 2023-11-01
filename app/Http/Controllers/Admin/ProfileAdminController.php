<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\Profile\ProfileAdminService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ProfileAdminController extends Controller
{
    protected $profileAdminService;

    public function __construct(ProfileAdminService $profileAdminService)
    {
        $this->profileAdminService = $profileAdminService;
    }
    public function index()
    {
        $user = Auth::user();
        return view('admin.profile.list', [
            'title' => 'Thông Tin Cá Nhân',
//            'profile' => $this->profileAdminService->getMe(),
            'user' => $user,
        ]);
    }

    public function show()
    {
        $user = Auth::user();
        return view('admin.profile.edit', [
            'title' => 'Chỉnh Sửa Thông Tin Cá Nhân',
            'user' => $user,
        ]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $result = $this->profileAdminService->update($request, $user);

        if ($result) {
            return redirect('/admin/profile');
        }
        // Chuyển hướng người dùng sau khi cập nhật thông tin cá nhân

        return redirect()->back();
    }
}

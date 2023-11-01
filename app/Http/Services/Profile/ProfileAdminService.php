<?php

namespace App\Http\Services\Profile;

use App\Models\User;
use Illuminate\Support\Facades\Session;

class ProfileAdminService
{
    public function getMe()
    {
//        return User::
    }

    public function update($request, $user)
    {
        try {
            $user->fill($request->input());
            $user->save();
            Session::flash('success', 'Cập nhật thông tin thành công');
        } catch (\Exception $err) {
            Session::flash('error', 'Có lỗi xãy ra, vui lòng điền đầy đủ thông tin!');
//            \Log::info($err->getMessage());
            return false;
        }
        return true;
    }
}

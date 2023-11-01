<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $customers = User::where('role', 'customer')->get();
        return view('admin.user.list', [
            'title' => 'Danh Sách Tài Khoản Người Dùng',
            'users' => $customers,
        ]);
    }

    public function create()
    {
        return view('admin.user.add',[
            'title' => 'Thêm tài khoản mới'
        ]);
    }

    public function store(Request $request)
    {
        // Validate the user input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed', // Kiểm tra mật khẩu và xác nhận mật khẩu
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'role' => 'required|in:admin,customer',
        ]);


        // Tạo một đối tượng User và gán các giá trị từ dữ liệu gửi qua form
        $user = new User([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'phone' => $request->input('phone'),
            'address' => $request->input('address'),
            'role' => $request->input('role'),
        ]);

        // Lưu người dùng vào cơ sở dữ liệu
        $user->save();

        // Chuyển hướng sau khi tạo người dùng hoặc hiển thị thông báo thành công
        return redirect('/admin/users/list-user')->with('success', 'Người dùng đã được tạo thành công.');
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.user.edit', [
            'title' => 'Cập Nhật Trạng Thái',
            'user' => $user
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'active' => 'required|in:0,1', // Chỉ kiểm tra trường "active"
        ]);

        $user = User::find($id);

        if (!$user) {
            return redirect('admin/users/list-user')->with('error', 'Người dùng không tồn tại.');
        }

        $user->active = $request->input('active');
        $user->save();

        return redirect('admin/users/list-user')->with('success', 'Trạng thái kích hoạt của người dùng đã được cập nhật thành công.');
    }



    public function confirmDelete(User $user)
    {
        return view('admin.user.confirm',[
            'title' => 'Xác Nhận Xóa Người Dùng',
            'user' => $user
        ]);
    }


    public function destroy(User $user)
    {
        // Kiểm tra xem người dùng có tồn tại không
        if ($user) {
            // Nếu người dùng tồn tại, thực hiện xóa tài khoản người dùng
            $user->delete();
            return redirect('admin/users/list-user')->with('success', 'Tài khoản đã được xóa thành công.');
        } else {
            return redirect('admin/users/list-user')->with('error', 'Tài khoản không tồn tại.');
        }
    }


}

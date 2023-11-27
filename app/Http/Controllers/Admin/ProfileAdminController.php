<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\Profile\ProfileAdminService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

    public function update(Request $request)
    {
        $user = auth()->user();

        // Validate form data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Update user data
        $user->name = $validatedData['name'];
        $user->address = $validatedData['address'];
        $user->phone = $validatedData['phone'];

        // Upload and save avatar if provided
        if ($request->hasFile('avatar')) {
            // Delete old avatar file
            if ($user->avatar) {
                Storage::delete('public/'.$user->avatar);
            }

            // Upload new avatar
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = 'storage/' . $avatarPath;
        }

        $user->save();

        return redirect('/admin/profile')->with('success', 'Cập nhật thành công!');
    }
}

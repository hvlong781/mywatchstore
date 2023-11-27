<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function profile()
    {
        return view('profile', [
            'title' => 'Trang Cá Nhân',
            'menus' => ProductCategory::select('name', 'image', 'id')
                ->where('parent_id', 0)
                ->orderbyDesc('id')
                ->get()
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

        return redirect('/profile')->with('success', 'Cập nhật thành công!');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::orderByDesc('id')->paginate(15);
        return view('admin.supplier.list', [
            'title' => 'Danh Sách Nhà Cung Cấp',
            'suppliers' => $suppliers
        ]);
    }

    public function create()
    {
        return view('admin.supplier.add', [
            'title' => 'Thêm Nhà Cung Cấp',
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'website' => 'nullable|url',
        ]);

        Supplier::create($validatedData);

        return redirect('/admin/suppliers')->with('success', 'Thêm nhà cung cấp thành công.');
    }

    public function show($id)
    {
        $supplier = Supplier::findOrFail($id);
        return view('admin.supplier.edit', [
            'title' => 'Chỉnh Sửa Nhà Cung Cấp',
            'supplier' => $supplier,
        ]);
    }

    public function update(Request $request, $id)
    {
        $supplier = Supplier::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'website' => 'nullable|url',
            // Thêm các quy tắc xác thực khác nếu cần thiết
        ]);

        $supplier->update($validatedData);

        return redirect('/admin/suppliers')->with('success', 'Thông tin nhà cung cấp đã được cập nhật.');
    }

    public function destroy($id)
    {
        $brand = Supplier::findOrFail($id);
        $brand->delete();

        return redirect('/admin/suppliers')->with('success', 'Nhà cung cấp đã được xóa.');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\Brand\BrandService;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandAdminController extends Controller
{
    protected $brandService;

    public function __construct(BrandService $brandService)
    {
        $this->brandService = $brandService;
    }

    public function index()
    {
        $brands = Brand::orderByDesc('id')->paginate(15);
        return view('admin.brand.list', [
            'title' => 'Danh Sách Thương Hiệu',
            'brands' => $brands
        ]);
    }

    public function create()
    {
        return view('admin.brand.add', [
            'title' => 'Thêm Thương Hiệu',
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:brands|max:255',
            'description' => 'nullable',
            'country' => 'nullable',
            'founded_year' => 'nullable|integer',
            'website' => 'nullable|url',
        ]);

        Brand::create($validatedData);

        return redirect('/admin/brands/list-brand')->with('success', 'Thương hiệu đã được thêm.');
    }

    public function show($id)
    {
        $brand = Brand::findOrFail($id);
        return view('admin.brand.edit', [
            'title' => 'Chỉnh Sửa Thương Hiệu',
            'brand' => $brand,
        ]);
    }

    public function update(Request $request, $id)
    {
        $brand = Brand::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|unique:brands,name,' . $id . '|max:255',
            'description' => 'nullable',
            'country' => 'nullable',
            'founded_year' => 'nullable|integer',
            'website' => 'nullable|url',
            'active' => 'required|in:0,1'
            // Thêm các quy tắc xác thực khác nếu cần thiết
        ]);

        $brand->update($validatedData);

        return redirect('/admin/brands/list-brand')->with('success', 'Thông tin thương hiệu đã được cập nhật.');
    }

    public function destroy($id)
    {
        $brand = Brand::findOrFail($id);
        $brand->delete();

        return redirect('/admin/brands/list-brand')->with('success', 'Thương hiệu đã được xóa.');
    }
}

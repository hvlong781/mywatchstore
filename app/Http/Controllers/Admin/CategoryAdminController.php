<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Menu\CreateFormRequest;
use App\Http\Services\Category\CategoryService;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class CategoryAdminController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        return view('admin.category.list', [
           'title' => 'Danh Sách Danh Mục',
            'categories' => $this->categoryService->getAll()
        ]);
    }

    public function create()
    {
        return view('admin.category.add', [
            'title' => 'Thêm Danh Mục',
            'categories' => $this->categoryService->getParent()
        ]);
    }

    public function store(CreateFormRequest $request)
    {
        $this->categoryService->create($request);

        return redirect()->back();
    }

    public function show(ProductCategory $category)
    {
        return view('admin.category.edit', [
            'title' => 'Chỉnh Sửa Danh Mục' . $category->name,
            'category' => $category,
            'categories' => $this->categoryService->getParent()
        ]);
    }

    public function update(ProductCategory $category, CreateFormRequest $request)
    {
        $this->categoryService->update($request, $category);

        return redirect('admin/categories/list-menu');
    }

    public function destroy(Request $request): \Illuminate\Http\JsonResponse
    {
        $result = $this->categoryService->destroy($request);
        if ($result) {
            return response()->json([
                'error' => false,
                'message' => 'Xóa danh mục thành công'
            ]);
        }

        return response()->json([
            'error' => true
        ]);
    }
}

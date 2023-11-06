<?php

namespace App\Http\Services\Category;

use App\Models\ProductCategory;
use Illuminate\Support\Facades\Session;

class CategoryService
{
    public function create($request)
    {
        try {
            ProductCategory::create([
                'name' => (string) $request->input('name'),
                'parent_id' => (int) $request->input('parent_id'),
                'description' => (string) $request->input('description'),
                'image' => (string) $request->input('image'),
                'active' => (string) $request->input('active')
            ]);

            Session::flash('success', 'Tạo danh mục thành công');
        } catch (\Exception $err) {
            Session::flash('error', $err->getMessage());
            return false;
        }

        return true;
    }

    public function getParent()
    {
        return ProductCategory::where('parent_id', 0)->get();
    }

    public function show()
    {
        return ProductCategory::select('name', 'image', 'id')->where('parent_id', 0)->orderbyDesc('id')->get();
    }

    public function getId($id)
    {
        return ProductCategory::where('id', $id)->where('active', 1)->firstOrFail();
    }

    public function getProduct($menu, $request)
    {
        $query = $menu->products()
            ->select('id', 'name', 'price', 'quantity', 'image')
            ->where('active', 1);

        if ($request->input('price')) {
            $query->orderBy('price', $request->input('price'));
        }

        return $query
            ->orderByDesc('id')
            ->paginate(12)
            ->withQueryString();
    }
    public function getAll()
    {
        return ProductCategory::orderbyDesc('id')->paginate(20);
    }

    public function update($request, $category) : bool
    {
        if ($request->input('parent_id') != $category->id) {
            $category->name = (string) $request->input('name');
            $category->parent_id = (int) $request->input('parent_id');
            $category->description = (string) $request->input('description');
            $category->image = (string) $request->input('image');
            $category->active = (string) $request->input('active');
            $category->save();

            Session::flash('success', 'Cập nhật danh mục thành công');
            return true;
        } else {
            Session::flash('error', 'Cập nhật danh mục không thành công!');
            return false;
        }
    }

    public function destroy($request)
    {
        $id = (int) $request->input('id');

        $menu = ProductCategory::where('id', $id)->first();
        if ($menu) {
            return ProductCategory::where('id', $id)->orWhere('parent_id', $id)->delete();
        }

    }
}

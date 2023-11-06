<?php

namespace App\Http\Services\Product;

use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class ProductAdminService
{
    public function getMenu()
    {
        return ProductCategory::where('active', 1)->get();
    }
    public function getBrand()
    {
        return Brand::where('active', 1)->get();
    }

    protected function isValidPrice($request)
    {
        if ($request->input('price') == 0) {
            Session::flash('error', 'Vui lòng nhập giá tiền!');
            return false;
        }

        return true;
    }

    public function insert($request)
    {
        $isValidPrice = $this->isValidPrice($request);
        if ($isValidPrice === false) {
            return false;
        }

        try {
            $request->except('_token');

            Product::create($request->all());
            Session::flash('success', 'Thêm sản phẩm thành công!');
        } catch (\Exception $err) {
            Session::flash('error', 'Thêm sản phẩm không thành công!');
            \Log::info($err->getMessage());
            return false;
        }
        return true;
    }

    public function get()
    {
        return Product::with('category')
            ->orderByDesc('id')->paginate(15);
    }

    public function update($request, $product)
    {
        $isValidatePrice = $this->isValidPrice($request);
        if ($isValidatePrice === false) return false;

        try {
            $product->fill($request->input());
            $product->save();
            Session::flash('success', 'Cập nhật sản phẩm thành công');
        } catch (\Exception $err) {
            Session::flash('error', 'Có lỗi xãy ra, vui lòng điền đầy đủ thông tin!');
            \Log::info($err->getMessage());
            return false;
        }
        return true;
    }

    public function delete($request)
    {
        $product = Product::where('id', $request->input('id'))->first();
        if ($product) {
            $path = str_replace('storage', 'public', $product->image);
            Storage::delete($path);
            $product->delete();
            return true;
        }
        return false;
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Services\Category\CategoryService;
use Illuminate\Http\Request;
use App\Http\Services\Product\ProductService;

class ProductController extends Controller
{
    protected $productService;
    protected $categoryService;

    public function __construct(ProductService $productService, CategoryService $categoryService)
    {
        $this->productService = $productService;
        $this->categoryService = $categoryService;
    }

    public function index($id = '', $slug = '')
    {
        $product = $this->productService->show($id);
        $productsMore = $this->productService->more($id);

        return view('products.content', [
            'title' => $product->name,
            'product' => $product,
            'products' => $productsMore,
            'menus' => $this->categoryService->show(),
        ]);
    }

    public function show(Request $request)
    {
        $products = $this->productService->getProduct($request);

        return view('products.show', [
            'title' => 'Tất cả sản phẩm',
            'menus' => $this->categoryService->show(),
            'products' => $products,
        ]);
    }
}

<?php

namespace App\Http\Services\Product;

use App\Models\Product;

class ProductService
{
    const LIMIT = 15;
    public function get($page = null)
    {
        return Product::select('id', 'name', 'price', 'quantity', 'image')
            ->orderByDesc('id')
            ->when($page != null, function ($query) use ($page) {
              $query->offset($page * self::LIMIT);
            })
            ->limit(self::LIMIT)
            ->get();
    }

    public function show($id)
    {
        return Product::where('id', $id)
            ->where('active', 1)
            ->with('category')
            ->firstOrFail();
    }

    public function more($id)
    {
        return Product::select('id', 'name', 'price', 'quantity', 'image')
            ->where('active', 1)
            ->where('id', '!=', $id)
            ->orderByDesc('id')
            ->limit(8)
            ->get();
    }
}

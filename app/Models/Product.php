<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'content',
        'price',
        'image',
        'quantity',
        'category_id',
        'brand_id',
        'active',
    ];

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function reviews()
    {
        return $this->hasMany(ProductReview::class);
    }

    public function purchaseOrderDetails()
    {
        return $this->hasMany(PurchaseOrderDetail::class, 'product_id');
    }

    // Phương thức để giảm số lượng sản phẩm
    public function decreaseQuantity($quantity)
    {
        $this->decrement('quantity', $quantity);
    }

    // Phương thức để tăng số lượng sản phẩm
    public function increaseQuantity($quantity)
    {
        $this->increment('quantity', $quantity);
    }
}

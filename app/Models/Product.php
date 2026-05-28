<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'description',
        'price',
        'sale_price',
        'image',
        'stock'
    ];

    protected $appends = ['discount_percent', 'is_on_sale'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class)->orderBy('sort_order');
    }

    public function getDiscountPercentAttribute()
    {
        if ($this->sale_price && $this->price > 0) {
            return round((1 - $this->sale_price / $this->price) * 100);
        }
        return 0;
    }

    public function getIsOnSaleAttribute()
    {
        return !is_null($this->sale_price) && $this->sale_price < $this->price;
    }

    public function displayPrice()
    {
        return $this->is_on_sale ? $this->sale_price : $this->price;
    }
}

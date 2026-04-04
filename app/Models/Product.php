<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;
     protected $fillable = [
        'category_id',
        'slug',
        'sale_price',
        'name',
        'description',
        'price',
        'stock',
        'image',
        'is_trendy',
        'expiry_date'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    protected static function boot()
        {
            parent::boot();

            static::creating(function ($product) {
                $product->slug = Str::slug($product->name);
            });
        }

    public function getImageUrlAttribute()
        {
            if ($this->image) {
                return asset('storage/' . $this->image);
            }
      
            return asset('assets/images/default-product.jpg');
        }



}

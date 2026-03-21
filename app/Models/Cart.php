<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
     protected $fillable = [
        'cart_id',
        'product_id',
        'quantity',
        'user_id',
    ];

    public function product(){
        return $this->belongsTo(Product::class);
    }
}

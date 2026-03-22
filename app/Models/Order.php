<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
     use HasFactory;

    protected $fillable = [
        'first_name','last_name','email','phone','address','city','total','user_id','notes','status'
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}

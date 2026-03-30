<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'image',
        'parent_id',
    ];

   
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }


    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function getImageUrlAttribute()
            {
                if ($this->image) {
                    return asset('storage/' . $this->image);
                }
        
                return asset('assets/images/demos/demo-2/banners/banner-1.jpg');
            }

    
}
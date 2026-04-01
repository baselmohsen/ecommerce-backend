<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'address',
        'city',
        'phone',
        'bio',
        'image',
        'social',
    ];

    protected $casts = [
        'social' => 'array', // automatically cast JSON to array
    ];

    // Relationship with User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

               public function getImageUrlAttribute()
        {
            if ($this->image) {
                return asset('storage/' . $this->image);
            }
      
        }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
     protected $fillable = [
        'pharmacy_name',
        'logo',
        'phone',
        'email',
        'address',
        'facebook',
        'instagram',
    ];

    function setting()
        {
            return cache()->remember('settings', 60*60, function () {
                return \App\Models\Setting::first();
            });
        }
}

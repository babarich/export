<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BannerImage extends Model
{
    
       protected $fillable = [
        'active',
        'path',
        'url',
        'mime',
        'size',
        'position',
    ];
}

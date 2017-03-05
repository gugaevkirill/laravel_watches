<?php

namespace App\Models\Catalog;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $dateFormat = 'Y-m-d H:i:sP';
    protected $casts = [
        'images' => 'array',
        'attributes'=>'array',
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}

<?php

namespace App\Models\Catalog;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $timestamps = false;
    public $incrementing = false;
    protected $primaryKey = 'slug';

    const SLUGS = ['watches', 'jewelry', 'accessories'];
}

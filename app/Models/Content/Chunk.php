<?php

namespace App\Models\Content;

use Illuminate\Database\Eloquent\Model;

class Chunk extends Model
{
    public $timestamps = false;
    public $incrementing = false;
    protected $primaryKey = 'slug';
}

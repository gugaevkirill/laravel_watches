<?php

namespace App\Models\Catalog;

use Illuminate\Database\Eloquent\Model;

class Param extends Model
{
    public $timestamps = false;
    public $incrementing = false;
    protected $primaryKey = 'slug';

    public function auctions()
    {
        return $this->belongsToMany('App\Models\Auction\ScandyAuction');
    }
}

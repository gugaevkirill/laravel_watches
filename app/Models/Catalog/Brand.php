<?php

namespace App\Models\Catalog;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Catalog\Brand
 *
 * @property string $slug
 * @property int $order
 * @property string $name
 * @property string $image
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog\Brand whereImage($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog\Brand whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog\Brand whereOrder($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog\Brand whereSlug($value)
 * @mixin \Eloquent
 */
class Brand extends Model
{
    public $timestamps = false;
    public $incrementing = false;
    protected $primaryKey = 'slug';
}

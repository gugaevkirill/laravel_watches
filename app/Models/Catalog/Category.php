<?php

namespace App\Models\Catalog;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Catalog\Category
 *
 * @property string $slug
 * @property int $order
 * @property string $name_ru
 * @property string $name_en
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog\Category whereNameEn($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog\Category whereNameRu($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog\Category whereOrder($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog\Category whereSlug($value)
 * @mixin \Eloquent
 */
class Category extends Model
{
    public $timestamps = false;
    public $incrementing = false;
    protected $primaryKey = 'slug';

    const SLUGS = ['watches', 'jewelry', 'accessories'];
}

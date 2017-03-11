<?php

namespace App\Models\Catalog;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Catalog\Param
 *
 * @property string $slug
 * @property string $title_ru
 * @property string $title_en
 * @property int $order
 * @property string $type
 * @property bool $required
 * @property bool $unique
 * @property bool $in_filter
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog\Param whereInFilter($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog\Param whereOrder($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog\Param whereRequired($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog\Param whereSlug($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog\Param whereTitleEn($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog\Param whereTitleRu($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog\Param whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog\Param whereUnique($value)
 * @mixin \Eloquent
 */
class Param extends Model
{
    public $timestamps = false;
    public $incrementing = false;
    protected $primaryKey = 'slug';

    const TYPES = ['integer', 'string', 'boolean', 'select'];
}

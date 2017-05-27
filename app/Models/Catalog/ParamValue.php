<?php

namespace App\Models\Catalog;

use App\Scopes\OrderByOrderScope;
use Backpack\CRUD\CrudTrait;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Catalog\ParamValue
 *
 * @property int $id
 * @property int $order
 * @property string $param_slug
 * @property string $value_ru
 * @property string $value_en
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog\ParamValue whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog\ParamValue whereOrder($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog\ParamValue whereParamSlug($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog\ParamValue whereValueEn($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog\ParamValue whereValueRu($value)
 * @mixin \Eloquent
 */
class ParamValue extends Model
{
    use CrudTrait;

    public $timestamps = false;
    protected $table = 'param_values';

    protected $fillable = ['order', 'value_ru', 'value_en', 'param_slug'];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new OrderByOrderScope());
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function params()
    {
        return $this->belongsToMany(Param::class, Param::VALUE_PIVOT);
    }
}

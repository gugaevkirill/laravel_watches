<?php

namespace App\Models\Catalog;

use App\Scopes\OrderByOrderScope;
use Backpack\CRUD\CrudTrait;
use Backpack\CRUD\ModelTraits\SpatieTranslatable\HasTranslations;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Catalog\ParamValue
 *
 * @property int $id
 * @property int $order
 * @property array $value
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Catalog\Param[] $params
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\ParamValue whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\ParamValue whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\ParamValue whereValue($value)
 * @mixin \Eloquent
 */
class ParamValue extends Model
{
    use CrudTrait;
    use HasTranslations;

    public $timestamps = false;
    protected $table = 'param_values';

    protected $fillable = ['order', 'value', 'param_slug'];
    protected $translatable = ['value'];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new OrderByOrderScope());
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function params()
    {
        return $this->belongsToMany(Param::class, Param::VALUE_PIVOT);
    }

    /**
     * @return array
     */
    public static function getForAdminPage(): array
    {
        return self::orderByRaw('"order" ASC, "value_ru" DESC')
            ->join(Param::VALUE_PIVOT, 'id', '=', 'param_value_id')
            ->get(['id', 'value_ru', 'param_slug'])
            ->toArray();
    }
}

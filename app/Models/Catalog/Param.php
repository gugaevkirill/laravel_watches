<?php

namespace App\Models\Catalog;

use Backpack\CRUD\CrudTrait;
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
    use CrudTrait;

    public $timestamps = false;
    public $incrementing = false;
    protected $primaryKey = 'slug';

    protected $fillable = ['order', 'title_ru', 'title_en', 'slug', 'type', 'required', 'unique', 'in_filter'];

    /**
     * При изменении перемигрировать БД
     */
    const TYPES = [
        'integer' => 'Integer',
        'string' => 'String',
        'boolean' => 'Boolean',
        'select' => 'Select',
    ];

    /**
     * @return array
     */
    public static function getForAdminPage(): array
    {
        $result = self::orderByRaw('"order" ASC, "title_ru" DESC')
            ->get(['slug', 'title_ru', 'type', 'required'])
            ->map(function (self $product) {
                return $product->toArray();
            })
            ->values();

        $values = ParamValue::orderByRaw('"order" ASC, "value_ru" DESC')
            ->get(['id', 'param_slug', 'value_ru'])
            ->map(function (ParamValue $value) {
                return $value->toArray();
            });

        $result = $result->map(function (&$product) use ($values) {
            if ($product['type'] == 'select') {
                $product['values'] = $values->where('param_slug', '==', $product['slug'])
                    ->values()
                    ->map(function (array $value) {
                        unset($value['param_slug']);
                        return $value;
                    })
                    ->toArray();
            }

            return $product;
        });

        return $result->toArray();
    }
}

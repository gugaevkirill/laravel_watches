<?php

namespace App\Models\Catalog;

use App\Scopes\OrderByOrderScope;
use Backpack\CRUD\CrudTrait;
use Backpack\CRUD\ModelTraits\SpatieTranslatable\HasTranslations;
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
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Catalog\Category[] $categories
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Catalog\ParamValue[] $values
 */
class Param extends Model
{
    use CrudTrait;
    use HasTranslations;

    const CATEGORY_PIVOT = 'categories_params';
    const VALUE_PIVOT = 'params_param_values';

    public $timestamps = false;
    public $incrementing = false;
    protected $primaryKey = 'slug';

    protected $fillable = ['order', 'title', 'slug', 'type', 'required', 'unique', 'in_filter'];
    protected $translatable = ['title'];

    /**
     * При изменении перемигрировать БД
     */
    const TYPES = [
        'integer' => 'Integer',
        'string' => 'String',
        'boolean' => 'Boolean',
        'select' => 'Select',
    ];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new OrderByOrderScope());
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class, self::CATEGORY_PIVOT);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function values()
    {
        return $this->belongsToMany(ParamValue::class, self::VALUE_PIVOT);
    }

    /**
     * @return array
     */
    public static function getForAdminPage(): array
    {
        $params = self::orderByRaw('"order" ASC, "title_ru" DESC')
            ->with('categories')
            ->get(['slug', 'title_ru', 'type', 'required', 'unique'])
            ->toArray();

        foreach ($params as &$param) {
            $tmp = [];
            foreach ($param['categories'] as $cat) {
                $tmp[] = $cat['slug'];
            }
            $param['categories'] = $tmp;
        }

        return $params;
    }
}

<?php

namespace App\Models\Catalog;

use App\Scopes\OrderByOrderScope;
use Backpack\CRUD\CrudTrait;
use Backpack\CRUD\ModelTraits\SpatieTranslatable\HasTranslations;
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
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Catalog\Param[] $params
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Catalog\Product[] $products
 */
class Category extends Model
{
    use CrudTrait;
    use HasTranslations;

    const SLUGS = ['watches', 'luxury', 'accessories'];

    public $timestamps = false;
    public $incrementing = false;
    protected $primaryKey = 'slug';

    protected $fillable = ['slug', 'order', 'name', 'name_en'];
    protected $translatable = ['name'];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new OrderByOrderScope());
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function params()
    {
        return $this->belongsToMany(Param::class, Param::CATEGORY_PIVOT);
    }

    /**
     * @return array
     */
    public static function getForAdminPage(): array
    {
        return self::all(['name_ru', 'slug'])
            ->pluck('name_ru', 'slug')
            ->toArray();
    }
}

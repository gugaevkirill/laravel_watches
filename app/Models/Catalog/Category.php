<?php

namespace App\Models\Catalog;

use App\Models\ModelExtended;
use App\Scopes\OrderByOrderScope;
use Backpack\CRUD\CrudTrait;
use Backpack\CRUD\ModelTraits\SpatieTranslatable\HasTranslations;

/**
 * App\Models\Catalog\Category
 *
 * @property string $slug
 * @property int $order
 * @property array $name
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Catalog\Param[] $params
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Catalog\Product[] $products
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\Category whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\Category whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\Category whereSlug($value)
 * @mixin \Eloquent
 */
class Category extends ModelExtended
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
        return self::all(['name', 'slug'])
            ->pluck('name', 'slug')
            ->toArray();
    }
}

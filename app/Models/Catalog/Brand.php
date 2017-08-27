<?php

namespace App\Models\Catalog;

use App\Models\ImageTrait;
use App\Scopes\OrderByOrderScope;
use Backpack\CRUD\CrudTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * App\Models\Catalog\Brand
 *
 * @property string $slug
 * @property int $order
 * @property string $name
 * @property int|null $imagenew
 * @property-write mixed $imagesnew
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\Brand whereImagenew($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\Brand whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\Brand whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\Brand whereSlug($value)
 * @mixin \Eloquent
 * @property-write mixed $clean_imagesnew
 */
class Brand extends Model
{
    use CrudTrait;
    use ImageTrait;

    public $timestamps = false;
    public $incrementing = false;
    protected $primaryKey = 'slug';

    protected $fillable = ['order', 'name', 'imagenew', 'slug'];

    // Картинка
    protected static $imageFieldName = "imagenew";
    protected static $imageDestination = '/public/brands/';
    public static $imageUrlPrefix = '/storage/brands/';


    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new OrderByOrderScope());
        static::addGlobalScope('name', function (Builder $builder) {
            $builder->orderBy('name');
        });
    }

    public function getHref(): string
    {
        return "/watches/?brand=$this->slug";
    }

    /**
     * Бренды, в которых есть товары
     * @param int $limit
     * @return Collection
     */
    public static function getWithProducts(int $limit = 10): Collection
    {
        return self::rightJoin('products', 'products.brand_slug', '=', 'brands.slug')
            ->distinct()
            ->limit($limit)
            ->get(['brands.*']);
    }
}

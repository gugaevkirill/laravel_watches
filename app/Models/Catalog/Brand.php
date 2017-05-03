<?php

namespace App\Models\Catalog;

use App\Models\SaveImageTrait;
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
 * @property string $image
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog\Brand whereImage($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog\Brand whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog\Brand whereOrder($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog\Brand whereSlug($value)
 * @mixin \Eloquent
 */
class Brand extends Model
{
    use CrudTrait;
    use SaveImageTrait;

    public $timestamps = false;
    public $incrementing = false;
    protected $primaryKey = 'slug';

    protected $fillable = ['order', 'name', 'image', 'slug'];

    // Папка куда складывать картинки
    protected $imageDestination = 'brands';

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
     * @return string
     */
    public function getAdminImageHtml(): string
    {
        return $this->image
            ? "<img src='/$this->image' style='max-width: 70px; max-height: 60px;'>"
            : "";
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

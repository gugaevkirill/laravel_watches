<?php

namespace App\Models\Catalog;

use App\Scopes\IsActiveScope;
use Illuminate\Database\Eloquent\Builder;

/**
 * App\Models\Catalog\ProductArchived
 *
 * @property int $id
 * @property int $order
 * @property string $brand_slug
 * @property string $category_slug
 * @property string $name
 * @property int|null $price_rub
 * @property array $attrs
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property bool|null $is_active
 * @property array $imagesnew
 * @property array $descriptionnew
 * @property int|null $price_usd
 * @property int|null $price_eur
 * @property string|null $url_slug
 * @property-write mixed $clean_imagesnew
 * @property-write mixed $imagenew
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\ProductArchived whereAttrs($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\ProductArchived whereBrandSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\ProductArchived whereCategorySlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\ProductArchived whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\ProductArchived whereDescriptionnew($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\ProductArchived whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\ProductArchived whereImagesnew($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\ProductArchived whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\ProductArchived whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\ProductArchived whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\ProductArchived wherePriceEur($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\ProductArchived wherePriceRub($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\ProductArchived wherePriceUsd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\ProductArchived whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\ProductArchived whereUrlSlug($value)
 * @mixin \Eloquent
 */
class ProductArchived extends Product
{
    protected $table = 'products';

    /**
     * Модифицируем SQL запросы по данной модели.
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(
            IsActiveScope::class,
            function (Builder $builder) {
                $builder->where('is_active', false);
            }
        );
    }
}

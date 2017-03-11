<?php

namespace App\Models\Catalog;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Catalog\Product
 *
 * @property int $id
 * @property int $order
 * @property string $brand_slug
 * @property string $category_slug
 * @property string $name
 * @property string $description
 * @property array $images
 * @property int $price_rub
 * @property int $price_dollar
 * @property array $attributes
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Models\Catalog\Brand $brand
 * @property-read \App\Models\Catalog\Category $category
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog\Product whereAttributes($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog\Product whereBrandSlug($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog\Product whereCategorySlug($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog\Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog\Product whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog\Product whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog\Product whereImages($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog\Product whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog\Product whereOrder($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog\Product wherePriceDollar($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog\Product wherePriceRub($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog\Product whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Product extends Model
{
    protected $dateFormat = 'Y-m-d H:i:sP';
    protected $casts = [
        'images' => 'array',
        'attributes'=>'array',
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * @param string $slug
     * @return mixed
     */
    public function param(string $slug)
    {
        if (!isset($this->attributes[$slug])) {
            return null;
        }

        if (Param::findOrFail($slug)->type == 'select') {
            return ParamValue::findOrFail($this->attributes[$slug]);
        }

        return $this->attributes[$slug];
    }

    /**
     * @return string
     */
    public function getPrice()
    {
        if ($this->price_rub) {
            return number_format($this->price_rub, 0, '.', ' ') . 'руб';
        } elseif ($this->price_dollar) {
            return number_format($this->price_rub, 0, '.', ' ') . '$';
        } else {
            return 'По запросу';
        }
    }

    /**
     * @return string
     */
    public function getHref()
    {
        return "/$this->category_slug/$this->id";
    }
}

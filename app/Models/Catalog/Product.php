<?php

namespace App\Models\Catalog;

use Backpack\CRUD\CrudTrait;
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
 * @property array $attrs
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Models\Catalog\Brand $brand
 * @property-read \App\Models\Catalog\Category $category
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog\Product whereFttrs($value)
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
    use CrudTrait;

    protected $dateFormat = 'Y-m-d H:i:sP';
    protected $casts = [
        'images' => 'array',
        'attrs'=>'array',
    ];

    protected $fillable = [
        'order',
        'brand_slug',
        'category_slug',
        'name',
        'description',
        'images',
        'price_rub',
        'price_dollar',
        'attrs',
    ];

    // Папка куда складывать картинки
    protected $imageDestination = 'products';

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
        if (!isset($this->attrs[$slug])) {
            return null;
        }

        if (Param::findOrFail($slug)->type == 'select') {
            return ParamValue::findOrFail($this->attrs[$slug]);
        }

        return $this->attrs[$slug];
    }

    /**
     * @return array
     */
    public function getPrices(): array
    {
        // Цена в долларах и рублях
        $prices = [];
        if ($this->price_rub) {
            $prices[] = number_format($this->price_rub, 0, '.', ' ') . ' ₽';
        }
        if ($this->price_dollar) {
            $prices[] = number_format($this->price_dollar, 0, '.', ' ') . ' $';
        }

        return $prices;
    }

    /**
     * @return string
     */
    public function getPriceString(): string
    {
        if (!empty($this->getPrices())) {
            return $this->getPrices()[0];
        }

        return 'По запросу';
    }

    /**
     * @return string
     */
    public function getHref()
    {
        return "/$this->category_slug/$this->id";
    }

    /**
     * @param mixed $value
     */
    public function setImagesAttribute($value)
    {
        $attribute_name = "images";

        $this->uploadMultipleFilesToDisk($value, $attribute_name, null, $this->imageDestination);
    }
}

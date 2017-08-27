<?php

namespace App\Models\Catalog;

use App\Models\ImageTrait;
use App\Models\ModelExtended;
use App\Repositories\CurrencyRepository;
use App\Scopes\IsActiveScope;
use App\Scopes\OrderByOrderScope;
use Backpack\CRUD\CrudTrait;
use Backpack\CRUD\ModelTraits\SpatieTranslatable\HasTranslations;
use Illuminate\Database\Eloquent\Builder;

/**
 * App\Models\Catalog\Product
 *
 * @property int $id
 * @property int $order
 * @property string $brand_slug
 * @property string $category_slug
 * @property string $name
 * @property int|null $price_rub
 * @property int|null $price_dollar
 * @property array $attrs
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property bool|null $is_active
 * @property array $imagesnew
 * @property array $descriptionnew
 * @property-read \App\Models\Catalog\Brand $brand
 * @property-read \App\Models\Catalog\Category $category
 * @property-write mixed $imagenew
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\Product whereAttrs($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\Product whereBrandSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\Product whereCategorySlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\Product whereDescriptionnew($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\Product whereImagesnew($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\Product whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\Product whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\Product whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\Product wherePriceDollar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\Product wherePriceRub($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\Product whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int|null $price_usd
 * @property int|null $price_eur
 * @property-write mixed $clean_imagesnew
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\Product wherePriceEur($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\Product wherePriceUsd($value)
 */
class Product extends ModelExtended
{
    const PRICE_PREFIX = 'price_';
    const NO_PRICE = 'По запросу';

    use ImageTrait;
    use CrudTrait;
    use HasTranslations;

    protected $dateFormat = 'Y-m-d H:i:sP';
    protected $casts = [
        'imagesnew' => 'array',
        'attrs'=>'array',
    ];
    protected $fillable = [
        'order',
        'brand_slug',
        'category_slug',
        'name',
        'descriptionnew',
        'imagesnew',
        'price_rub',
        'price_usd',
        'price_eur',
        'attrs',
    ];
    protected $translatable = ['descriptionnew'];

    // Картинки
    protected $imagesFieldName = "imagesnew";
    protected $imageDestination = '/public/products/';
    protected $imageUrlPrefix = '/storage/products/';

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new IsActiveScope());
        static::addGlobalScope(new OrderByOrderScope());
        static::addGlobalScope('id', function (Builder $builder) {
            $builder->orderBy('id', 'desc');
        });
    }

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
     * @return \Illuminate\Contracts\Translation\Translator|mixed|null|string
     * @throws \Exception
     */
    public function param(string $slug)
    {
        if (!isset($this->attrs[$slug])) {
            return null;
        }

        switch (Param::findOrFail($slug)->type) {
            case 'select':
                return ParamValue::findOrFail($this->attrs[$slug])->value;
            case 'boolean':
                return $this->attrs[$slug] ? __('site.system_yes') : __('site.system_no');
            case 'integer':
                return number_format($this->attrs[$slug], 0, '.', ' ');
            case 'string':
                return $this->attrs[$slug];
        }

        throw new \Exception("Not implemented");
    }

    /**
     * @return array
     */
    public function getAttrsForProductPage(): array
    {
        if (!$this->attrs) {
            return [];
        }

        $params = Param::whereIn('slug', array_keys($this->attrs))
            ->orderBy('order')
            ->get(['title', 'type', 'slug']);

        $ans = [];
        foreach ($params as $param) {
            if ($val = $this->param($param->slug)) {
                $ans[$param->title] = $val;
            }
        }

        return $ans;
    }

    /**
     * @return string
     */
    public function getPriceString(): string
    {
        return (new CurrencyRepository())->getProductPrice($this) ?? self::NO_PRICE;
    }

    /**
     * @return string
     */
    public function getHref()
    {
        return "/$this->category_slug/$this->id";
    }
}

<?php

namespace App\Models\Catalog;

use App\Models\ImageTrait;
use App\Scopes\IsActiveScope;
use App\Scopes\OrderByOrderScope;
use Backpack\CRUD\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

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
 * @property bool|null $is_active
 * @property mixed|null $imagesnew
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\Product whereAttrs($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\Product whereImagesnew($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\Product whereIsActive($value)
 */
class Product extends Model
{
    use ImageTrait;
    use CrudTrait;

    protected $dateFormat = 'Y-m-d H:i:sP';
    protected $casts = [
        'images' => 'array',
        'imagesnew' => 'array',
        'attrs'=>'array',
    ];

    protected $fillable = [
        'order',
        'brand_slug',
        'category_slug',
        'name',
        'description',
        'imagesnew',
        'price_rub',
        'price_dollar',
        'attrs',
    ];

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
     * @return mixed
     */
    public function param(string $slug)
    {
        if (!isset($this->attrs[$slug])) {
            return null;
        }

        switch (Param::findOrFail($slug)->type) {
            case 'select':
                // TODO: закрыть получение параметров кешем
                return ParamValue::findOrFail($this->attrs[$slug])->value_ru;
            case 'boolean':
                return $this->attrs[$slug] ? 'Да' : 'Нет';
            case 'integer':
                return number_format($this->attrs[$slug], 0, '.', ' ');
            default:
                return $this->attrs[$slug];
        }
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
            ->get(['title_ru', 'title_en', 'type', 'slug']);

        $ans = [];
        foreach ($params as $param) {
            if ($val = $this->param($param->slug)) {
                $ans[$param->title_ru] = $val;
            }
        }

        return $ans;
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
}

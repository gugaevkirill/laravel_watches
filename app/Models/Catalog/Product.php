<?php

namespace App\Models\Catalog;

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
 */
class Product extends Model
{
    const IMAGES_FIELD_NAME = "imagesnew";

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

    /**
     * @return string
     */
    public function getAdminImageHtml(): string
    {
        return !empty($this->images)
            ? "<img src='/{$this->images[0]}' style='max-width: 60px; max-height: 70px;'>"
            : "";
    }

    /**
     * @param mixed $value
     */
    public function setImagesAttribute($value)
    {
        if ($value == null) {
            $this->attributes[static::IMAGES_FIELD_NAME] = '["img/watches_default.png"]';
        } else {
            $request = \Request::instance();
            $attribute_value = (array) $this->{static::IMAGES_FIELD_NAME};
            $files_to_clear = $request->get('clear_'.static::IMAGES_FIELD_NAME);

            // if a file has been marked for removal,
            // delete it from the disk and from the db
            if ($files_to_clear) {
                $attribute_value = (array) $this->{static::IMAGES_FIELD_NAME};
                foreach ($files_to_clear as $key => $filename) {
                    \Storage::disk('local')->delete($filename);
                    $attribute_value = array_where($attribute_value, function ($value, $key) use ($filename) {
                        return $value != $filename;
                    });
                }

                // Для нормального удаления картинок
                $attribute_value = array_values($attribute_value);
            }

            // if a new file is uploaded, store it on disk and its filename in the database
            if ($request->hasFile(static::IMAGES_FIELD_NAME)) {
                foreach ($request->file(static::IMAGES_FIELD_NAME) as $file) {
                    if ($file->isValid()) {
                        // 1. Generate a new file name
                        $new_file_name = md5($file->getClientOriginalName().time()).'.'.$file->getClientOriginalExtension();

                        // 2. Move the new file to the correct path
                        $file_path = $file->storeAs('public/' . $this->imageDestination, $new_file_name, 'local');

                        // 3. Add the public path to the database
                        $attribute_value[] = 'storage/' . $this->imageDestination . '/' . $new_file_name;
                    }
                }
            }

            $this->attributes[static::IMAGES_FIELD_NAME] = json_encode($attribute_value);
        }
    }
}

<?php declare(strict_types=1);

namespace App\Models\Catalog;

use App\Models\ImageTrait;
use App\Models\ModelExtended;
use App\Repositories\CurrencyRepository;
use App\Repositories\LangRepository;
use App\Scopes\IsActiveScope;
use App\Scopes\OrderByOrderScope;
use Backpack\CRUD\CrudTrait;
use Backpack\CRUD\ModelTraits\SpatieTranslatable\HasTranslations;
use Illuminate\Database\Eloquent\Builder;
use Stichoza\GoogleTranslate\TranslateClient;

/**
 * App\Models\Catalog\Product
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
 * @property string|null $url_slug
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\Product whereUrlSlug($value)
 * @property bool $is_reserved
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\Product whereIsReserved($value)
 */
class Product extends ModelExtended
{
    const URL_SLUG = 'url_slug';
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
    protected static $imagesFieldName = "imagesnew";
    protected static $imageDestination = '/public/products/';
    public static $imageUrlPrefix = '/storage/products/';

    /**
     * Модифицируем SQL запросы по данной модели.
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new IsActiveScope());
        static::addGlobalScope(new OrderByOrderScope());
        static::addGlobalScope('id', function (Builder $builder) {
            $builder->orderBy('id', 'desc');
        });
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
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
                $lang = new LangRepository();
                // TODO: грязный хак пока мы не научились требовать заполнения всех локалей
                return $this->attrs[$slug][$lang->getLocale()] ?? '';
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
    public function getHref(): string
    {
        return "/$this->category_slug/$this->url_slug";
    }

    /**
     * Генерирует slug один раз при создании
     * @return string
     * @throws \Exception
     */
    public function generateSlug(): string
    {
        // проверяем на пустоту
        if (!$this->name || trim($this->name) === "") {
            throw new \Exception('Неудалось сгенерировать slug из пустого названия');
        }

        // создаём наш Google Translate клиент
        // первым аргументом вводится язык источника
        // вторым — язык, на который нужно перевести
        // соответственно, если первый аргумент null, то производится автоматическое определение языка
        $tr = new TranslateClient(null, 'en');

        $slug = str_slug($tr->translate($this->name));

        // Если такой slug уже существует
        $analogs = [];
        foreach (\DB::select("select distinct url_slug from products where url_slug like '$slug%'") as $row) {
            $analogs[] = $row->url_slug;
        }

        while (in_array($slug, $analogs)) {
            if (!isset($i)) {
                $i = 2;
            } else {
                $i++;
                $slug = substr($slug, 0 , -1);
            }

            $slug .= $i;
        }

        return $slug;
    }
}

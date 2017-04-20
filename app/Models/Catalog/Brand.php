<?php

namespace App\Models\Catalog;

use App\Models\SaveImageTrait;
use Backpack\CRUD\CrudTrait;
use Illuminate\Database\Eloquent\Model;

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
}

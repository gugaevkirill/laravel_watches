<?php

namespace App\Models\Content;

use Backpack\CRUD\CrudTrait;
use Backpack\CRUD\ModelTraits\SpatieTranslatable\HasTranslations;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Content\Chunk
 *
 * @property string $slug
 * @property string $title
 * @property string $content_ru
 * @property string $content_en
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Content\Chunk whereContentEn($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Content\Chunk whereContentRu($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Content\Chunk whereSlug($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Content\Chunk whereTitle($value)
 * @mixin \Eloquent
 * @property array $content
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Content\Chunk whereContent($value)
 */
class Chunk extends Model
{
    use CrudTrait;
    use HasTranslations;

    public $timestamps = false;
    public $incrementing = false;
    protected $primaryKey = 'slug';

    protected $fillable = ['slug', 'title', 'content'];
    protected $translatable = ['content'];
}

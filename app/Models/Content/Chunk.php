<?php

namespace App\Models\Content;

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
 */
class Chunk extends Model
{
    public $timestamps = false;
    public $incrementing = false;
    protected $primaryKey = 'slug';
}

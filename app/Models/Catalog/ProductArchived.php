<?php

namespace App\Models\Catalog;

use App\Scopes\IsActiveScope;
use Illuminate\Database\Eloquent\Builder;

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

<?php

namespace App\Providers;

use App\Http\ViewComposers\FeaturedProductsComposer;
use App\Http\ViewComposers\LayoutComposer;
use App\Models\Catalog\Product;
use App\Models\Content\Chunk;
use App\Observers\ChunkObserver;
use App\Observers\ProductObserver;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Add observers:
        Chunk::observe(ChunkObserver::class);
        Product::observe(ProductObserver::class);

        // Add view composers:
        View::composer('layouts/front', LayoutComposer::class);
        View::composer('parts/featured-products', FeaturedProductsComposer::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

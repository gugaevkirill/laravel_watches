<?php

namespace App\Providers;

use App\Http\ViewComposers\LayoutComposer;
use App\Models\Content\Chunk;
use App\Observers\ChunkObserver;
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

        // Add view composers:
        View::composer('layouts/front', LayoutComposer::class);
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

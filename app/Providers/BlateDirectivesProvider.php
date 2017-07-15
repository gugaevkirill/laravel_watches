<?php

namespace App\Providers;

use App\Models\Content\Chunk;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class BlateDirectivesProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('chunk', function($slug) {
            $text = Chunk::where('slug', trim($slug, '\'\" '))->firstOrFail()->content;
            return "<?php echo '" . $text . "'; ?>";
        });

        // TODO: заюзать слайдеры
        Blade::directive('slider', function($slug) {
            $slug = trim($slug, '\'\"');

            $slider_php = 'App\Models\Contents\Slider::where("slug", "' . $slug . '")->firstOrFail()';

            return "<?php echo \$__env->make('parts.sliders." . $slug . "', ['slider' => " . $slider_php . "])->render(); ?>";
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

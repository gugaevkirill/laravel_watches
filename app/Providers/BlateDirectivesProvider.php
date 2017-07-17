<?php

namespace App\Providers;

use App\Models\Content\Chunk;
use App\Repositories\LangRepository;
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
            $chunk = Chunk::where('slug', trim($slug, '\'\" '))->firstOrFail();

            $templateCode = "<?php switch (\App::getLocale()) {\n";

            foreach (array_keys(config('backpack.crud.locales')) as $code) {
                $templateCode .= <<<PHP
case '$code':
    echo '{$chunk->getTranslation('content', $code)}';
    break;\n
PHP;
            }

            $defaultLocale = LangRepository::DEFAULT_LOCALE;
            $templateCode .= <<<PHP
default:
    echo '{$chunk->getTranslation('content', $defaultLocale)}';
    break;
} ?>
PHP;

            return $templateCode;
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

let mix = require('laravel-mix');
var path = require('path');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.copy('resources/assets/css/bootstrap.min.css', 'public/css')
    .copy('resources/assets/css/font-awesome.min.css', 'public/css')
    .copy('resources/assets/css/idangerous.swiper.css', 'public/css')
    .copy('resources/assets/css/style.css', 'public/css')
    .copy('resources/assets/js/global.js', 'public/js')
    .copy('resources/assets/js/idangerous.swiper.min.js', 'public/js')
    .copy('resources/assets/js/isotope.pkgd.min.js', 'public/js')
    .copy('resources/assets/js/jquery.jscrollpane.min.js', 'public/js')
    .copy('resources/assets/js/jquery.mousewheel.js', 'public/js')
    .copy('resources/assets/js/jquery-2.1.3.min.js', 'public/js')
    .copy('resources/assets/js/jquery-ui.min.js', 'public/js')
    .copy('resources/assets/js/map.js', 'public/js')
    .js('resources/assets/js/app.js', 'public/js')
    .webpackConfig({
        resolve: {
            modules: [
                path.resolve(__dirname, 'vendor/laravel/spark/resources/assets/js'),
                'node_modules'
            ],
            alias: {
                'vue$': 'vue/dist/vue.js'
            }
        }
    });
let mix = require('laravel-mix');

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

mix.js([
    'resources/assets/js/core/jquery-1.9.1.min.js',
    'resources/assets/js/vendor/jquery-ui-1.10.4.custom.min.js',
    'resources/assets/js/vendor/jquery-ui-timepicker-addon.min.js',
    'resources/assets/js/vendor/jquery.imagesloaded.js',
    'resources/assets/js/vendor/bootstrap.min.js',
    'resources/assets/js/vendor/bootstrap-collapse.js',
    'resources/assets/js/vendor/jquery-easing-1.3.js',
    'resources/assets/js/vendor/jquery.lazyload.min.js',
    'resources/assets/js/app.js',
    'resources/assets/js/app/main.js'
], 'public/js/app.js')
    .styles([
        'resources/assets/css/vendor/*.css',
        'resources/assets/css/bootstrap.css',
        'resources/assets/css/bootstrap-responsive.css',
        'resources/assets/css/posts.css',
        'resources/assets/css/style.css',
        'resources/assets/css/main.css',
        'resources/assets/css/tags.css',
        'resources/assets/css/app.css'
    ], 'public/css/app.css');


const mix = require('laravel-mix');

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


// Backend
mix.js('resources/backend/js/app.js', 'public/backend/js')
    .sass('resources/backend/sass/app.scss', 'public/backend/css')
    .copyDirectory('resources/backend/images', 'public/backend/images')
    .copyDirectory('node_modules/admin-lte/dist', 'public/backend/admin-lte-v3')
    .copyDirectory('node_modules/admin-lte/plugins', 'public/backend/plugins')
    .copyDirectory('resources/backend/plugins', 'public/backend/plugins');

mix.copyDirectory('resources/front', 'public');

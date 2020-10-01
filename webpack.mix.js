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

mix.js('resources/js/app.js', 'public/js/app.js');
mix.js('resources/js/sb-admin-2.min.js', 'public/js/app.js');
mix.js('resources/js/app-vue.js', 'public/js/app-vue.js');

mix.js('resources/views/admin/users/vue.js', 'public/js/admin/users/vue.js');
mix.js('resources/views/admin/categories/vue.js', 'public/js/admin/categories/vue.js');

mix.sass('resources/sass/app.scss', 'public/css/app.css');

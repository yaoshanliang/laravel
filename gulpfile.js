const elixir = require('laravel-elixir');

// require('laravel-elixir-vue-2');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(mix => {

    // web
    mix.scripts([
    './resources/assets/vendor/jquery/jquery.min.js',
    './resources/assets/vendor/bootstrap/bootstrap.min.js',
], 'public/web-assets/js/lib.js');

mix.styles([
    './resources/assets/vendor/bootstrap/bootstrap.min.css',
], 'public/web-assets/css/lib.css');

mix.copy('./resources/assets/vendor/fonts/', 'public/web-assets/fonts');
mix.copy('./resources/assets/vendor/fonts/', 'public/web-assets/fonts');

mix.scripts([
    './resources/assets/web/web.js'
], 'public/web-assets/js/web.js');
mix.styles([
    './resources/assets/web/web.css'
], 'public/web-assets/css/web.css');

mix.version(['web-assets/js/web.js', 'web-assets/css/web.css']);


//admin
mix.scripts([
    './resources/assets/vendor/jquery/jquery.min.js',
    './resources/assets/vendor/bootstrap/bootstrap.min.js',
    './resources/assets/vendor/datatables/datatables.min.js',
    './resources/assets/vendor/gentelella/nprogress.js',
], 'public/admin-assets/js/lib.js');

mix.styles([
    './resources/assets/vendor/bootstrap/bootstrap.min.css',
    './resources/assets/vendor/fonts/font-awesome.min.css',
    './resources/assets/vendor/datatables/datatables.min.css',
    './resources/assets/vendor/gentelella/custom.min.css',
], 'public/admin-assets/css/lib.css');

mix.copy('./resources/assets/vendor/fonts/', 'public/admin-assets/fonts');
mix.copy('./resources/assets/vendor/fonts/', 'public/admin-assets/fonts');

// simditor
// mix.copy('./resources/assets/vendor/simditor', 'public/admin-assets/vendor/simditor');

mix.scripts([
    './resources/assets/vendor/gentelella/custom.min.js',
    './resources/assets/admin/admin.js'
], 'public/admin-assets/js/admin.js');
mix.styles([
    './resources/assets/admin/admin.css'
], 'public/admin-assets/css/admin.css');

mix.version(['admin-assets/js/admin.js', 'admin-assets/css/admin.css']);
});

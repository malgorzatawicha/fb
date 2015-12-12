var elixir = require('laravel-elixir');
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

elixir(function(mix) {
    mix
        .copy('vendor/twbs/bootstrap/dist/fonts', 'public/build/fonts/')
        .copy('resources/assets/js/admin.products.js', 'public/js/admin.products.js')
        .scripts([
            "../../../vendor/components/jquery/jquery.min.js",
            '../../../vendor/kartik-v/bootstrap-fileinput/js/plugins/canvas-to-blob.min.js',
            '../../../vendor/kartik-v/bootstrap-fileinput/js/fileinput.min.js',
            "../../../vendor/twbs/bootstrap/dist/js/bootstrap.min.js",
            "../../../vendor/kartik-v/bootstrap-fileinput/js/fileinput_locale_pl.js"
        ], 'public/js')

        .styles([
            '../../../vendor/twbs/bootstrap/dist/css/bootstrap.min.css',
            '../../../vendor/kartik-v/bootstrap-fileinput/css/fileinput.min.css',
            'app.css'
        ], 'public/css')

        .version(["css/all.css", "js/all.js"]);
});

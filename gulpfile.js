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
        .copy('/vendor/twbs/bootstrap/dist/fonts/', '/public/fonts')

        .scripts([
            "../../../vendor/components/jquery/jquery.min.js",
            "../../../vendor/twbs/bootstrap/dist/js/bootstrap.min.js"
        ], 'public/js')

        .styles([
            '../../../vendor/twbs/bootstrap/dist/css/bootstrap.min.css',
            'app.css'
        ], 'public/css')

        .version(["css/all.css", "js/all.js"]);
});

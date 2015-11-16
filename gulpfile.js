var elixir = require('laravel-elixir');
var bowerDir = 'bower_components/';
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
    mix.copy(bowerDir + 'ckeditor', 'public/ckeditor');
    mix.copy(bowerDir + 'bootstrap/fonts', 'public/fonts');
    mix.copy(bowerDir + 'bootstrap/dist/js/bootstrap.min.js', 'resources/assets/js/vendor/bootstrap.min.js');
    mix.copy(bowerDir + 'jquery/dist/jquery.min.js', 'resources/assets/js/vendor/jquery.js');
    mix.copy(bowerDir + 'ckeditor/ckeditor.js', 'resources/assets/js/vendor/ckeditor.js');

    mix.copy(bowerDir + 'bootstrap/dist/css/bootstrap.min.css', 'resources/assets/css/vendor/bootstrap.min.css');

    mix.styles([
        "vendor/*.css",
        'app.css'
    ], 'public/css');

    mix.scripts([
            "vendor/jquery.js",
            "vendor/ckeditor.js",
            "vendor/bootstrap.min.js"
        ], 'public/js', 'resources/assets/js');

    mix.version(["css/all.css", "js/all.js"]);
});

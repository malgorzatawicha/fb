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
        .sass('app.scss')
        .sass('admin.scss')
        .copy('bower_components/bootstrap/dist/fonts', 'public/build/fonts/')
        .copy('bower_components/font-awesome/fonts', 'public/build/fonts/')
        .copy('resources/assets/js/admin/', 'public/js/admin/')

        .copy('bower_components/jquery/dist/jquery.min.js', 'resources/assets/js/vendor/jquery.min.js')
        .copy('bower_components/bootstrap-fileinput/js/plugins/canvas-to-blob.min.js', 'resources/assets/js/vendor/canvas-to-blob.min.js')
        .copy('bower_components/bootstrap-fileinput/js/fileinput.min.js', 'resources/assets/js/vendor/fileinput.min.js')
        .copy('bower_components/bootstrap/dist/js/bootstrap.min.js', 'resources/assets/js/vendor/bootstrap.min.js')
        .copy('bower_components/bootstrap-fileinput/js/fileinput_locale_pl.js', 'resources/assets/js/vendor/fileinput_locale_pl.js')
        .copy('bower_components/bootstrap-treeview/dist/bootstrap-treeview.min.js', 'resources/assets/js/vendor/bootstrap-treeview.min.js')
        .copy('vendor/unisharp/laravel-ckeditor/ckeditor.js', 'resources/assets/js/vendor/ckeditor.js')
        .copy('bower_components/lightbox2/dist/js/lightbox.min.js','resources/assets/js/vendor/lightbox.min.js')

        .copy('bower_components/bootstrap/dist/css/bootstrap.min.css', 'resources/assets/css/vendor/bootstrap.min.css')
        .copy('bower_components/bootstrap-fileinput/css/fileinput.min.css', 'resources/assets/css/vendor/fileinput.min.css')
        .copy('bower_components/bootstrap-treeview/dist/bootstrap-treeview.min.css', 'resources/assets/css/vendor/bootstrap-treeview.min.css')
        .copy('bower_components/lightbox2/dist/css/lightbox.min.css','resources/assets/css/vendor/lightbox.min.css')

        .copy('bower_components/font-awesome/css/font-awesome.min.css', 'resources/assets/css/vendor/font-awesome.min.css')

        .copy('resources/assets/fonts', 'public/fonts')

        .copy('bower_components/lightbox2/dist/images', 'public/build/images')
        .copy('bower_components/bootstrap-fileinput/img', 'public/build/img')
        .scripts([
            "vendor/jquery.min.js",
            'vendor/canvas-to-blob.min.js',
            'vendor/fileinput.min.js',
            "vendor/bootstrap.min.js",
            'vendor/fileinput.min.js',
            'vendor/bootstrap-treeview.min.js',
            'vendor/lightbox.min.js'
        ], 'public/js')

        .styles([
            'vendor/bootstrap.min.css',
            'vendor/fileinput.min.css',
            'vendor/bootstrap-treeview.min.css',
            'vendor/font-awesome.min.css',
            '../../../public/css/app.css'
        ], 'public/css')
        .styles([
            'vendor/bootstrap.min.css',
            'vendor/fileinput.min.css',
            'vendor/bootstrap-treeview.min.css',
            'vendor/font-awesome.min.css',
            'vendor/lightbox.min.css',
            '../../../public/css/admin.css'
        ], 'public/css/admin.css')
        .scripts([
            'vendor/ckeditor.js',
            'admin/tools.js',
            'admin/galleryProjects.js'
        ], 'public/js/admin.js')
        .version(["css/admin.css", "css/all.css", "js/all.js", 'js/admin.js']);
});

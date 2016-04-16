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
    /** compile sass to files */
    mix.sass('app.scss', 'resources/assets/css/app.css')
        .sass('admin.scss', 'resources/assets/css/admin.css')
        /** copy all needed resources to place available for browsers */
        /**            BOOTSTRAP */
        .copy('bower_components/bootstrap/dist/fonts', 'public/build/fonts/')
        /**            CKEDITOR */
        .copy('vendor/unisharp/laravel-ckeditor', 'public/js/ckeditor/')
        /**          FILEINPUT */
        .copy('bower_components/bootstrap-fileinput/img', 'public/build/img')
        /**          LIGHTBOX2 */
        .copy('bower_components/lightbox2/dist/images', 'public/build/images')
        /**       FONT AWESOME */
        .copy('bower_components/font-awesome/fonts', 'public/build/fonts/')
        /**   CUSTOM RESOURCES */
        .copy('resources/assets/fonts', 'public/fonts')
        /** compile all needed js and css to single files */
        .styles([
            '../../../bower_components/bootstrap/dist/css/bootstrap.min.css',
            '../../../bower_components/lightbox2/dist/css/lightbox.min.css',
            '../../../bower_components/font-awesome/css/font-awesome.min.css',
            'app.css'
        ], 'public/css/all.css')
        .styles([
            '../../../bower_components/bootstrap/dist/css/bootstrap.min.css',
            '../../../bower_components/bootstrap-fileinput/css/fileinput.min.css',
            '../../../bower_components/bootstrap-treeview/dist/bootstrap-treeview.min.css',
            '../../../bower_components/font-awesome/css/font-awesome.min.css',
            'admin.css'
        ], 'public/css/admin.css')
        .scripts([
            '../../../bower_components/jquery/dist/jquery.min.js',
            '../../../bower_components/bootstrap/dist/js/bootstrap.min.js',
            '../../../bower_components/lightbox2/dist/js/lightbox.min.js'
        ], 'public/js/all.js')
        .scripts([
            /** FILEINPUT */
            '../../../bower_components/bootstrap-fileinput/js/plugins/canvas-to-blob.min.js',
            '../../../bower_components/bootstrap-fileinput/js/fileinput.min.js',
            '../../../bower_components/bootstrap-fileinput/js/fileinput_locale_pl.js',

            /** application */
            'admin/tools.js'
        ], 'public/js/admin/admin.js')
        .scripts([
            /** BOOTSTRAP TREEVIEW */
            '../../../bower_components/bootstrap-treeview/dist/bootstrap-treeview.min.js',
            'admin/galleryCategories.js'
        ], 'public/js/admin/gallery.js')
        .scripts([
            'admin/site.js'
        ], 'public/js/admin/site.js')
        .scripts([
            'admin/pages.js'
        ], 'public/js/admin/page.js')
        .scripts([
            'admin/galleryProjects.js'
        ], 'public/js/admin/project.js')
        /** make elixir know about files */
        .version(['css/all.css', 'css/admin.css', 'js/all.js', 'js/admin/admin.js',
            'js/admin/gallery.js', 'js/admin/project.js', 'js/admin/site.js', 'js/admin/page.js'])
    ;
});

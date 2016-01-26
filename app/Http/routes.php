<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
$router->bind('pages', function($slug){
    return Fb\Models\Cms\Page::where('slug', $slug)->first();
});

Route::group(['namespace' => 'Front'], function() use($router){
   $router->get('/', [
       'uses' => 'MainController@index',
       'as' => 'home'
   ]);
    $router->get('/p/{pages}/{isPreview?}', [
        'uses' => 'MainController@page',
        'as' => 'page'
    ]);
});

Route::group(
    ['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['auth']],
    function () use ($router) {
        $router->get('/', [
            'uses' => 'DashboardController@index',
            'as'   => 'admin.home'
        ]);

        $router->get('/site', [
            'uses' => 'SiteController@edit',
            'as' => 'admin.site.edit'
        ]);
        $router->put('/site', [
            'uses' => 'SiteController@update',
            'as' => 'admin.site.update'
        ]);

        $router->group(['prefix'=>'cms','namespace' => 'Cms'], function() use($router) {

            $router->resource('pages', 'PagesController', ['except'=>'show']);
            $router->patch('pages/{pages}/activate', [
                'uses' => 'PagesController@activate',
                'as'   => 'admin.cms.pages.activate'
            ]);
            $router->patch('pages/{pages}/deactivate', [
                'uses' => 'PagesController@deactivate',
                'as'   => 'admin.cms.pages.deactivate'
            ]);

            $router->resource('pages.banners', 'BannersController', ['only' => ['store', 'show', 'update', 'destroy']]);
        });

        $router->group(['prefix'=>'shop', 'namespace' => 'Shop'], function() use($router){
            $router->bind('products', function($slug){
                return Fb\Models\Shop\Product::where('slug', $slug)->first();
            });
            $router->resource('products', 'ProductsController');
            $router->patch('products/{products}/activate', [
                'uses' => 'ProductsController@activate',
                'as'   => 'admin.shop.products.activate'
            ]);
            $router->patch('products/{products}/deactivate', [
                'uses' => 'ProductsController@deactivate',
                'as'   => 'admin.shop.products.deactivate'
            ]);

            $router->resource('products.images', 'ProductImagesController', ['only' => ['store', 'show', 'update', 'destroy']]);

        });

        $router->group(['prefix'=>'gallery', 'namespace' => 'Gallery'], function() use($router) {
            $router->bind('galleries', function($slug){
                return Fb\Models\Gallery\Gallery::where('slug', $slug)->first();
            });
            $router->resource('galleries', 'GalleriesController');
            $router->patch('galleries/{galleries}/activate', [
                'uses' => 'GalleriesController@activate',
                'as'   => 'admin.gallery.galleries.activate'
            ]);
            $router->patch('galleries/{galleries}/deactivate', [
                'uses' => 'GalleriesController@deactivate',
                'as'   => 'admin.gallery.galleries.deactivate'
            ]);
            $router->resource('galleries.images', 'GalleryImagesController', ['only' => ['store', 'show', 'update', 'destroy']]);
            $router->resource('categories', 'CategoriesController');
        });
    }
);

$router->group(['prefix' => 'admin/auth', 'namespace' => 'Admin\Auth'], function()use($router) {
    // Authentication Routes...
    $router->get('login', [
        'uses' => 'AuthController@getLogin',
        'as'   => 'admin.auth.login.form'
    ]);
    $router->post('login', [
        'uses' => 'AuthController@postLogin',
        'as'   => 'admin.auth.login'
    ]);
    $router->get('logout', [
        'uses' => 'AuthController@getLogout',
        'as'   => 'admin.auth.logout'
    ]);
});

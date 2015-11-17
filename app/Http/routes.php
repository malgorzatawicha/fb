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
Route::bind('pages', function($slug){
   return Fb\Models\Cms\Page::where('slug', $slug)->first();
});
Route::bind('products', function($slug){
   return Fb\Models\Shop\Product::where('slug', $slug)->first();
});

Route::group(
    ['prefix' => 'admin', 'middleware' => ['auth']],
    function () use ($router) {
        $router->get('/', [
            'uses' => 'Admin\DashboardController@index',
            'as'   => 'admin.home'
        ]);
        $router->resource('pages', 'Cms\PagesController');
        $router->patch('pages/{pages}/activate', [
            'uses' => 'Cms\PagesController@activate',
            'as'   => 'admin.pages.activate'
        ]);
        $router->patch('pages/{pages}/deactivate', [
            'uses' => 'Cms\PagesController@deactivate',
            'as'   => 'admin.pages.deactivate'
        ]);
        $router->resource('products', 'Shop\ProductsController');
        $router->patch('products/{products}/activate', [
            'uses' => 'Shop\ProductsController@activate',
            'as'   => 'admin.products.activate'
        ]);
        $router->patch('products/{products}/deactivate', [
            'uses' => 'Shop\ProductsController@deactivate',
            'as'   => 'admin.products.deactivate'
        ]);
    }
);

// Authentication Routes...
Route::get('auth/login', [
    'uses' => 'Auth\AuthController@getLogin',
    'as'   => 'auth.login.form'
]);
Route::post('auth/login', [
    'uses' => 'Auth\AuthController@postLogin',
    'as'   => 'auth.login'
]);
Route::get('auth/logout', [
    'uses' => 'Auth\AuthController@getLogout',
    'as'   => 'auth.logout'
]);
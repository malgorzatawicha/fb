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
Route::bind('products', function($slug){
   return Fb\Models\Cms\Page::where('slug', $slug)->first();
});
Route::bind('products', function($slug){
   return Fb\Models\Shop\Product::where('slug', $slug)->first();
});

Route::group(
    ['prefix' => 'admin', 'middleware' => ['auth']],
    function () use ($router) {

       $router->resource('pages', 'Cms\PagesController');
       $router->resource('products', 'Shop\ProductsController');
    }
);


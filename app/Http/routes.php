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
Route::resource('products', 'Cms\PagesController');
Route::resource('products', 'Shop\ProductsController');
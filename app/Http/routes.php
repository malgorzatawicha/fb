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

Route::resource('pages', 'Cms\PagesController');
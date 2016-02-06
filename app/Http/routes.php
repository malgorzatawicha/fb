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

$router->bind('categories', function($id){
    return Fb\Models\Gallery\GalleryCategory::find($id);
});

$router->bind('galleryCategory', function($slug){
    return Fb\Models\Gallery\GalleryCategory::where('slug', $slug)->first();
});

$router->bind('galleryProject', function($slug){
    return Fb\Models\Gallery\GalleryProject::where('slug', $slug)->first();
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
    $router->get('g/{pages}/{galleryCategory}', [
        'uses' => 'GalleryController@category',
        'as' => 'gallery'
    ]);
    $router->get('gp/{pages}/{galleryCategory}/{galleryProject}', [
        'uses' => 'GalleryController@project',
        'as' => 'project'
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

            $router->resource('pages.contacts', 'ContactsController', ['only' => ['store', 'update', 'destroy']]);

            $router->patch('pages/{pages}/contacts/{contacts}/activate', [
                'uses' => 'ContactsController@activate',
                'as'   => 'admin.cms.pages.contacts.activate'
            ]);
            $router->patch('pages/{pages}/contacts/{contacts}/deactivate', [
                'uses' => 'ContactsController@deactivate',
                'as'   => 'admin.cms.pages.contacts.deactivate'
            ]);

            $router->resource('pages.friends', 'FriendsController', ['only' => ['store', 'show', 'update', 'destroy']]);

        });

        $router->group(['prefix'=>'gallery', 'namespace' => 'Gallery'], function() use($router) {

            $router->put('page/attach/{pages}', [
                'uses' => 'PagesController@attach',
                'as' => 'admin.gallery.pages.attach'
            ]);
            $router->resource('categories', 'CategoriesController');

            $router->resource('categories.projects', 'ProjectsController');
            $router->patch('categories/{categories}/projects/{projects}/activate', [
                'uses' => 'ProjectsController@activate',
                'as'   => 'admin.gallery.categories.projects.activate'
            ]);
            $router->patch('categories/{categories}/projects/{projects}/deactivate', [
                'uses' => 'ProjectsController@deactivate',
                'as'   => 'admin.gallery.categories.projects.deactivate'
            ]);
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

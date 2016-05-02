<?php

namespace Fb\Providers;

use Fb\Models\Gallery\GalleryProject;
use Fb\Models\Gallery\GalleryProjectImage;
use Illuminate\Support\ServiceProvider;
use Fb\Models\Site;
use App;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->share('site', Site::firstOrNew([]));
        App::setLocale('pl');

        GalleryProject::deleting(function ($model) {
            $model->next()->decrement('position');
        });
        GalleryProjectImage::deleting(function ($model) {
            $model->next()->decrement('position');
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

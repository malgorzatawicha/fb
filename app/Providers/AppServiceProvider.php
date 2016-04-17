<?php

namespace Fb\Providers;

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

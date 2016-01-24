<?php

namespace Fb\Providers;

use Illuminate\Support\ServiceProvider;
use Fb\Models\Site;

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

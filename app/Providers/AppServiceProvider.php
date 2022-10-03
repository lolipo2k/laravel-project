<?php

namespace App\Providers;

use App\Models\Service;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
        $this->menuLoad();
    }

    public function menuLoad()
    {
        View::composer('layouts.app', function ($view) {
            $view->with('menuServices', Service::orderBy('position')->get());
            $view->with('defaultService', Service::where('top_index', 1)->first());
        });
    }
}

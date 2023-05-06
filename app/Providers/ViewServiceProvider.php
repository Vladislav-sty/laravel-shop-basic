<?php

namespace App\Providers;

use App\ViewComposers\BasketCountComposer;
use App\ViewComposers\BestSkusComposer;
use App\ViewComposers\CategoriesComposer;
use App\ViewComposers\CurrenciesComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(['layouts.master', 'categories'], CategoriesComposer::class);
        View::composer(['layouts.master', 'admin.coupons.form'], CurrenciesComposer::class);
        View::composer('layouts.master', BasketCountComposer::class);
        View::composer('index', BestSkusComposer::class);
    }
}

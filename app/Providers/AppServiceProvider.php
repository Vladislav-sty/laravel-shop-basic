<?php

namespace App\Providers;

use App\Models\Product;
use App\Models\Sku;
use App\Observers\ProductObserver;
use App\Observers\SkuObserver;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

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
        Blade::directive('routeactive', function ($route){
            return "<?php echo Route::currentRouteNamed($route) ? 'link-dark' : 'text-white' ?>";
        });

        Product::observe(ProductObserver::class);
        Sku::observe(SkuObserver::class);
    }
}

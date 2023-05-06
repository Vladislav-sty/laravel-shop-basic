<?php

namespace App\ViewComposers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Sku;
use Illuminate\View\View;

class BestSkusComposer
{
    public function compose(View $view){
        $bestSkuIds = Order::get()->map->skus->flatten()->map->pivot->mapToGroups(function ($pivot){
            return [$pivot->sku_id => $pivot->count];
        })->map->sum()->sortByDesc(null)->take(3)->keys()->toArray();

        $bestSkus = Sku::get()->whereIn('id', $bestSkuIds);

        $view->with('bestSkus', $bestSkus);
    }
}

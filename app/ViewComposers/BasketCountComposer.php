<?php

namespace App\ViewComposers;

use App\Classes\Basket;
use Illuminate\View\View;

class BasketCountComposer
{
    public function compose(View $view){
        $basketCount = (new Basket())->getOrder();
        if ($basketCount){
            $basketCount = count($basketCount->skus);
        } else {
            $basketCount = 0;
        }
        $view->with('basketCount', $basketCount);
    }
}

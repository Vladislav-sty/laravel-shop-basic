<?php

namespace App\ViewComposers;

use App\Classes\CurrencyConversion;
use Illuminate\View\View;

class CurrenciesComposer
{
    public function compose(View $view){
        $currencies = CurrencyConversion::getCurrencies();
        $view->with('currencies', $currencies);
    }
}

<?php

namespace App\Classes;

use App\Models\Currency;
use Carbon\Carbon;

class CurrencyConversion
{
    protected static $container;

    public static function loadContainer(){
        if (is_null(self::$container)){
            $currencies = Currency::get();
            foreach ($currencies as $currency){
                self::$container[$currency->code] = $currency;
            }
        }
    }

    public static function getCurrencies(){
        self::loadContainer();

        return self::$container;
    }

    public static function getCurrencyFromSession(){
        return session('currency', 'UAH');
    }

    public static function getCurrentCurrencyFromSession(){
        self::loadContainer();
        $currencyCode = self::getCurrencyFromSession();

        foreach (self::$container as $currency){
            if($currency->code === $currencyCode){
                return $currency;
            }
        }
    }

    public static function convert($sum, $originCurrencyCode = 'UAH', $targetCurrencyCode = null){
        self::loadContainer();

        $originCurrency = self::$container[$originCurrencyCode];

        //update the exchange rate if today's date is not equal to the last update date
        if($originCurrency->updated_at != Carbon::now()->startOfDay()){
            CurrencyRates::getRates();
            self::loadContainer();
            $originCurrency = self::$container[$originCurrencyCode];
        }

        if(is_null($targetCurrencyCode)){
            $targetCurrencyCode = self::getCurrencyFromSession();
        }

        $targetCurrency = self::$container[$targetCurrencyCode];

        return $sum * $originCurrency['rate'] / $targetCurrency['rate'];
    }

    public static function getCurrencySymbol(){
        self::loadContainer();

        $currencyFromSession = self::getCurrencyFromSession();

        $currencySymbol = self::$container[$currencyFromSession];
        return $currencySymbol->symbol;
    }

    public static function getBaseCurrency(){
        self::loadContainer();

        foreach (self::$container as $code => $currency){
            if($currency->isMain()){
                return $code;
            }
        }
    }
}

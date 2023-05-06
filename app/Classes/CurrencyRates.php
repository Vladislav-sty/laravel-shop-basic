<?php

namespace App\Classes;

use Carbon\Carbon;
use GuzzleHttp\Client;

class CurrencyRates
{
    public static function getRates(){
        $baseCurrencyCode = CurrencyConversion::getBaseCurrency();

        $url = config('currency_rates.api_url');

        $client = new Client();
        $responce = $client->request('get', $url);

        if ($responce->getStatusCode() !== 200){
            throw new \Exception('Problem with api currency');
        }

        $rates = json_decode($responce->getBody()->getContents(), true);
        $ratesPrice = [];

        foreach ($rates as $rate){
            $ratesPrice[$rate['ccy']] = round($rate['buy'],1);
        }

        foreach (CurrencyConversion::getCurrencies() as $currency){
            if($currency->isMain()){
                $currency->updated_at = Carbon::now()->startOfDay();
                $currency->save();
            }
            if(!$currency->isMain()){
                $currency->update(['rate' => $ratesPrice[$currency['code']]]);
                $currency->touch();
            }
        }
    }
}

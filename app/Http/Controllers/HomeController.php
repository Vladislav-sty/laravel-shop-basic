<?php

namespace App\Http\Controllers;

use App\Classes\CurrencyRates;
use App\Http\Requests\ProductFilterRequest;
use App\Models\Currency;
use App\Models\Product;
use App\Models\Sku;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /*public function __construct()
    {
        $this->middleware('auth'); e
    }*/

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(ProductFilterRequest $request)
    {
        $skusQuery = Sku::with(['product', 'product.category']);

        if($request['price_from']){
            $skusQuery -> where('price','>=', $request['price_from']);
        }
        if($request['price_to']){
            $skusQuery -> where('price','<=', $request['price_to']);
        }

        foreach (['new','low','recommend'] as $field){
            if($request->has($field)){
                $skusQuery->whereHas('product', function ($query) use ($field){
                    $query->where($field, '1');
                });
            }
        }

        $skus = $skusQuery->simplePaginate(3)->withPath("?" . $request->getQueryString());
        return view('index', compact('skus'));
    }

    public function subscribe(Request $request, Sku $sku){
        $validated = $request->validate(
            [
                'email' => 'email|required'
            ],

            [
                'required' => 'Це поле обовʼязково заповнювати',
                'email' => 'Пошта не так має виглядати'
            ]
        );

        Subscription::create([
            'email' => $validated['email'],
            'sku_id' => $sku['id']
        ]);

        return redirect()->back()->with('success', 'Ми обовʼязково вам повідомимо коли цей товар знову буде у наявності');
    }

    public function changeLocale($locale){
        $availableLocales = ['en', 'uk'];
        if (!in_array($locale, $availableLocales)){
            $locale = config('app.locale');
        }
        session(['locale' => $locale]);
        App::setLocale($locale);
        return redirect()->back();
    }

    public function changeCurrency($currencyCode){
        $currency = Currency::get()->where('code', $currencyCode)->firstOrFail();
        session(['currency' => $currency['code']]);

        return redirect()->back();
    }
}

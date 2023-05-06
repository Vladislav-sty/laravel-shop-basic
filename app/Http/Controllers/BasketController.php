<?php

namespace App\Http\Controllers;

use App\Classes\Basket;
use App\Http\Requests\AddCouponRequest;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\Product;
use App\Models\Sku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BasketController extends Controller
{
    public function basket(){
        $order = (new Basket(true))->getOrder();
        return view('basket', compact('order'));
    }

    public function add(Sku $sku){
        $result = (new Basket(true))->addSku($sku);

        if ($result){
            session()->flash('success','Товар додано до корзини');
        } else {
            session()->flash('warning','Товар не доступний для замовлення');
        }

        return  redirect()->route('basket');
    }

    public function remove(Sku $sku){
        (new Basket())->removeSku($sku);

        session()->flash('warning','Товар видалено');
        return  redirect()->route('basket');
    }

    public function setCoupon(AddCouponRequest $request){
        $coupon = Coupon::where('code', $request['coupon_id'])->first();

        if ($coupon->availableForUse()){
            (new Basket())->setCoupon($coupon);
            session()->flash('success', 'Промо-код активовано');
        } else {
            session()->flash('warning','Промо-код не доступний');
        }

        return redirect()->route('basket');
    }

    public function place(){
        $basket = new Basket();
        $order = $basket->getOrder();

        if(!$basket->countAvailable()){
            session()->flash('warning','Товар не доступний для замовлення');
            return redirect()->route('basket');
        }

        if(is_null($order)){
            return  redirect()->route('basket');
        }

        return view('basket-place', compact('order'));
    }

    public function basketConfirm(Request $request){
        $request->validate([
            'placeName' => 'required',
            'placePhone' => 'required',
        ],
        [
            'required' => 'Це поле обовʼязково потрібно заповнити'
        ]
        );

        $basket = (new Basket())->getOrder();

        if ($basket->coupon && !$basket->coupon->availableForUse()) {
            session()->flash('warning', 'Купон неможливо використати');
            return redirect()->route('basket');
        }

        $email = Auth::check() ? Auth::user()->email : $request->placeEmail;

        if($basket->saveOrder($request->placeName, $request->placePhone, $email)){
            session()->flash('success', 'Ваше замовлення прийнято в обробку :)');
        } else {
            session()->flash('warning', 'Товар не доступний для замовлення');
        }
        return  redirect()->route('index');
    }
}

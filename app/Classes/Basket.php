<?php

namespace App\Classes;

use App\Mail\OrderCreated;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\Product;
use App\Models\Sku;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class Basket
{
    protected $order;

    public function __construct($createOrder = false)
    {
        $order = session('order');

        if (is_null($order) && $createOrder){
            $data = [];
            if (Auth::check()){
                $data['user_id'] = Auth::user()->id;
            }
            $data['currency_id'] = CurrencyConversion::getCurrentCurrencyFromSession()->id;

            $this->order = new Order($data);
            session(['order' => $this->order]);
        } else {
            $this->order = $order;
        }
    }

    /**
     * @return mixed
     */
    public function getOrder()
    {
        return $this->order;
    }

    public function countAvailable($updateCount = false){
        $skus = collect([]);
        foreach($this->order->skus as $orderSku){
            $sku = Sku::find($orderSku->id);
            if($orderSku->countInOrder > $sku->count){
                return false;
            }

            if($updateCount){
                $sku->count -= $orderSku->countInOrder;
                $skus->push($sku);
            }
        }
        if($updateCount){
            $skus->map->save();
        }
        return true;
    }

    public function saveOrder($placeName, $placePhone, $email){
        if(!$this->countAvailable(true)){
            return false;
        }

        $orderSum = $this->order->getFullPrice();

        $this->order->saveOrder($placeName, $placePhone);
        Mail::to($email)->send(new OrderCreated($placeName, $orderSum, $this->order));
        return true;
    }

    public function removeSku(Sku $sku){
        for ($i=0; $i<count($this->order->skus); $i++){
            if ($this->order->skus[$i]->id == $sku->id){
                if ($this->order->skus[$i]->countInOrder < 2){
                    $this->order->skus->unset($i);
                } else {
                    $this->order->skus[$i]->countInOrder--;
                }
            }
        }
    }

    public function addSku(Sku $sku){
        if($this->order->skus->contains($sku->id)){
            $skuInOrder = $this->order->skus->where('id', $sku->id)->first();
            if($skuInOrder->countInOrder >= $sku->count){
                return false;
            }
            $skuInOrder->countInOrder++;
        } else {
            if($sku->count == 0){
                return false;
            }
            $sku->countInOrder = 1;
            $this->order->skus->push($sku);
        }

        return true;
    }

    public function setCoupon(Coupon $coupon){

        $this->order->coupon()->associate($coupon);
    }
}

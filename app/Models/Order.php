<?php

namespace App\Models;

use App\Classes\CurrencyConversion;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'currency_id', 'sum', 'coupon_id'];

    public function coupon(){
        return $this->belongsTo(Coupon::class);
    }

    public function skus(){
        return $this->belongsToMany(Sku::class)->withPivot(['count', 'price']);
    }

    public function currency(){
        return $this->belongsTo(Currency::class);
    }

    public function getFullPrice($withCoupon = true){
        $sum = 0;
        foreach ($this->skus as $sku){
            $sum += $sku->price * $sku->countInOrder;
        }

        if ($withCoupon && $this->coupon){
            $sum = $this->coupon->applyCost($sum, $this->currency);
        }

        return $sum;
    }

    public function calculateFullSum(){
        $sum = 0;
        foreach ($this->skus()->get() as $sku){
            $sum += $sku->getPriceForCount();
        }

        return $sum;
    }

    public function saveOrder($placeName, $placePhone){
        $this->name = $placeName;
        $this->phone = $placePhone;
        $this->status = 1;
        $this->sum = $this->getFullPrice();
        $this->save();

        $skus = $this->skus;

        foreach ($skus as $skusInOrder) {
            $this->skus()->attach($skusInOrder, [
                'count' => $skusInOrder->countInOrder,
                'price' => $skusInOrder->price
            ]);
        }

        $this->coupon()->dissociate();
        session() -> forget('order');
        return true;
    }

    public function getSumAttribute($value){
        return round(CurrencyConversion::convert($value), 0);
    }
}

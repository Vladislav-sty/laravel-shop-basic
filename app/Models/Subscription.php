<?php

namespace App\Models;

use App\Mail\SendSubscriptionMessage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = ['email', 'sku_id'];

    public function sku(){
        $this->belongsTo(Sku::class);
    }

    public function scopeActiveBySkuId($query, $skuId){
        return $query->where('status', '0')->where('sku_id', $skuId);
    }

    public static function sendEmailBySubscriptions(Sku $sku){
        $subscriptions = self::activeBySkuId($sku->id)->get();

        foreach ($subscriptions as $subscription) {
            Mail::to($subscription->email)->send(new SendSubscriptionMessage($sku));
            $subscription->status = 1;
            $subscription->save();
        }
    }
}

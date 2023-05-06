<?php

namespace App\Observers;

use App\Models\Sku;
use App\Models\Subscription;

class SkuObserver
{
    public function updating(Sku $sku){
        $oldCount = $sku->getOriginal('count');

        if ($oldCount == 0 & $sku->count > 0){
            Subscription::sendEmailBySubscriptions($sku);
        }
    }
}

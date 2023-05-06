<?php

namespace App\Models;

use App\Classes\CurrencyConversion;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sku extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'count', 'price'];
    protected $visible = ['id', 'count', 'price', 'product_name'];

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function scopeAvailable($query){
        return $query->where('count', '>', 0);
    }

    public function propertyOptions(){
        return $this->belongsToMany(PropertyOption::class, 'sku_property_option')->withTimestamps();
    }

    public function skuPropertyOptions(){
        return $this->hasMany(SkuPropertyOption::class);
    }

    public function isAvailable(){
        return $this->count === 0 || $this->product->trashed();
    }

    public function getPriceAttribute($value){
        return round(CurrencyConversion::convert($value), 0);
    }

    public function getPriceForCount(){
        if (!is_null($this->pivot)){
            return $this->pivot->count * $this->price;
        }
        return $this->price;
    }

    public function getProductNameAttribute(){
        return $this->product->name;
    }
}

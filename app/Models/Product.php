<?php

namespace App\Models;

use App\Classes\CurrencyConversion;
use App\Models\Traits\Translatble;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes, Translatble, HasFactory;

    protected $fillable = ['name', 'code', 'img', 'description', 'price', 'category_id', 'new', 'low', 'recommend', 'count', 'name_en', 'description_en'];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function skus(){
        return $this->hasMany(Sku::class);
    }

    public function properties(){
        return $this->belongsToMany(Property::class, 'property_product')->withTimestamps();
    }

    public function isNew(){
        return $this->new === 1;
    }

    public function isLow(){
        return $this->low === 1;
    }

    public function isRecommend(){
        return $this->recommend === 1;
    }

    public function isAvailable(){
        return $this->count === 0 || $this->trashed();
    }
}

<?php

namespace App\Models;

use App\Models\Traits\Translatble;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PropertyOption extends Model
{
    use HasFactory, SoftDeletes, Translatble;

    protected $fillable = ['property_id', 'name', 'name_en', 'hex'];

    public function property(){
        return $this->belongsTo(Property::class);
    }

    public function skus(){
        return $this->belongsToMany(Sku::class);
    }
}

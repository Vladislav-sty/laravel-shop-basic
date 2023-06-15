<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sku;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function sku($product_code, Sku $skus){
        if($skus->product->code !== $product_code){
            abort(404);
        }
/*        $product = Product::where('code',$product_code)->withTrashed()->first();*/

        return view('product', compact('skus'));
    }
}

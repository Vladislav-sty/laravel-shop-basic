<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sku;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function allProducts() {
//        $products = Product::with('category')->withTrashed()->get();
        $skus = Sku::with('product.category')->get();
        return view('products', compact('skus'));
    }
}

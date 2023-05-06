<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class CategoriesController extends Controller
{
    public function categories(){
        return view('categories');
    }

    public function category($category_name){
        $category = Category::where('code', $category_name)->first();
        if (!$category){
            abort(404);
        }
        return view('category', compact('category'));
    }
}

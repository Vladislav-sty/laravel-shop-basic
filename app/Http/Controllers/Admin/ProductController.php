<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Session\Store;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::withTrashed()->get();
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::get();
        $properties = Property::get();
        return view('admin.products.form', compact('categories', 'properties'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $newProduct = $request->all();

        foreach (['new', 'low', 'recommend'] as $field){
            if(isset($newProduct[$field])){
                $newProduct[$field] = 1;
            }
        }

        foreach ($properties = Property::get() as $property){
            if ($request['property_'.$property->id]){
                $propertiesId[] = $request['property_'.$property->id];
            }
        }


        $product = Product::create($newProduct);
        $product->properties()->sync($propertiesId);

        session()->flash('success', 'Новий товар додано');
        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::get();
        $product = Product::find($id);
        $properties = Property::get();
        return view('admin.products.form', compact('categories', 'product', 'properties'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        $newProduct = $request->all();

        foreach (['new', 'low', 'recommend'] as $field){
            if(isset($newProduct[$field])){
                $newProduct[$field] = 1;
            } else {
                $newProduct[$field] = 0;
            }
        }

        foreach ($properties = Property::get() as $property){
            if ($request['property_'.$property->id]){
                $propertiesId[] = $request['property_'.$property->id];
            }
        }

        $product->properties()->sync($propertiesId);
        $product->update($newProduct);

        session()->flash('success', 'Інформацію про товар змінено');
        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        Product::destroy($id);
        session()->flash('success', 'Товар видалено');
        return redirect()->route('products.index');
    }
}

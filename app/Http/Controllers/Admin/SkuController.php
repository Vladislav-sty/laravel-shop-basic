<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SkuRequest;
use App\Models\Product;
use App\Models\Sku;
use Illuminate\Http\Request;
use Illuminate\Session\Store;
use Illuminate\Support\Facades\Storage;

class SkuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Product $product)
    {
        $skus = $product->skus;
        return view('admin.skus.index', compact('skus', 'product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Product $product)
    {
        return view('admin.skus.form', compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Product $product
     * @return \Illuminate\Http\Response
     */
    public function store(SkuRequest $request, Product $product)
    {
        $params = $request->all();

        if($request->file('img')){
            $path = $request->file('img')->store('skus');
            $params['img'] = $path;
        } else {
            $params['img'] = 'null';
        }

        $params['product_id'] = $request->product->id;
        $sku = Sku::create($params);
        $sku->propertyOptions()->sync($request->property_id);
        return redirect()->route('skus.index', $product);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sku  $sku
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product, Sku $sku)
    {
        return view('admin.skus.show', compact('product', 'sku'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Product $product
     * @param \App\Models\Sku $sku
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product, Sku $sku)
    {
        return view('admin.skus.form', compact('product', 'sku'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Product $product
     * @param \App\Models\Sku $sku
     * @return \Illuminate\Http\Response
     */
    public function update(SkuRequest $request,Product $product, Sku $sku)
    {
        $params = $request->all();

        if($request['img']){
            Storage::delete($sku->img);
            $path = $request->file('img')->store('skus');
            $params['img'] = $path;
        }

        $params['product_id'] = $request->product->id;
        $sku->update($params);
        $sku->propertyOptions()->sync($request->property_id);

        session()->flash('success', 'Sku оновлено');

        return redirect()->route('skus.index', $product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     * @param \App\Models\Sku $sku
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product, Sku $sku)
    {
        $sku->skuPropertyOptions->map->delete();
        Storage::delete($sku->img);
        $sku->delete();
        session()->flash('success', 'Sku видалено');
        return redirect()->route('skus.index', $product);
    }
}

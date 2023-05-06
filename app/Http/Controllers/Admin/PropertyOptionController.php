<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PropertyOptionRequest;
use App\Models\Property;
use App\Models\PropertyOption;
use Illuminate\Http\Request;

class PropertyOptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $propertyOptions = PropertyOption::get();
        return view('admin.property_options.index', compact('propertyOptions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $properties = Property::get();
        return view('admin.property_options.form', compact('properties'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PropertyOptionRequest $request)
    {
        PropertyOption::create($request->all());
        session()->flash('success', 'Опцію створено');
        return redirect()->route('property_options.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PropertyOption  $propertyOption
     * @return \Illuminate\Http\Response
     */
    public function show(PropertyOption $propertyOption)
    {
        return view('admin.property_options.show', compact('propertyOption'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PropertyOption  $propertyOption
     * @return \Illuminate\Http\Response
     */
    public function edit(PropertyOption $propertyOption)
    {
        $properties = Property::get();
        return view('admin.property_options.form', compact('propertyOption', 'properties'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PropertyOption  $propertyOption
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PropertyOption $propertyOption)
    {
        $propertyOption->update($request->all());
        session()->flash('success', 'Опцію змінено');
        return redirect()->route('property_options.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PropertyOption  $propertyOption
     * @return \Illuminate\Http\Response
     */
    public function destroy(PropertyOption $propertyOption)
    {
        $propertyOption->delete();
        session()->flash('success', 'Опцію видалено');
        return redirect()->route('property_options.index');
    }
}

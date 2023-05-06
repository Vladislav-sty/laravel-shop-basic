<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CouponsRequest;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coupons = Coupon::get();
        return view('admin.coupons.index', compact('coupons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.coupons.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CouponsRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CouponsRequest $request)
    {
        $params = $request->all();
        foreach (['type', 'only_once'] as $field){
            if (isset($params[$field])){
                $params[$field] = '1';
            }
        }
        Coupon::create($params);
        session()->flash('success', 'Купон створено');
        return redirect()->route('coupons.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function show(Coupon $coupon)
    {
        return view('admin.coupons.show', compact('coupon'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function edit(Coupon $coupon)
    {
        return view('admin.coupons.form', compact('coupon'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function update(CouponsRequest $request, Coupon $coupon)
    {
        $params = $request->all();

        foreach (['type', 'only_once'] as $field){
            if (isset($params[$field])){
                $params[$field] = 1;
            }
        }

        if (!isset($params['type'])){
            $params['currency_id'] = null;
        }

        $coupon->update($params);
        session()->flash('success', 'Купон оновлено');
        return redirect()->route('coupons.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coupon $coupon)
    {
        $coupon->delete();
        session()->flash('warning', 'Купон видалено');
        return redirect()->route('coupons.index');
    }
}

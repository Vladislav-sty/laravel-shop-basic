<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function admin(){
        return view('admin.admin');
    }

    public function orders(){
        $orders = Order::where('status',1)->get();

        return view('admin.orders', compact('orders'));
    }

    public function order($order_id){
        $order = Order::find($order_id);
        if(is_null($order)){
            abort(404);
        }

        return view('admin.order', compact('order'));
    }
}

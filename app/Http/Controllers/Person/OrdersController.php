<?php

namespace App\Http\Controllers\Person;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrdersController extends Controller
{
    public function orders(){
        $orders = Auth::user()->orders()->where('status', 1)->get();

        return view('admin.orders', compact('orders'));
    }

    public function order($order_id){
        $order = Order::find($order_id);

        if (Auth::user()->orders->contains($order)){
            return view('admin.order', compact('order'));
        } else {
            return redirect()->route('person-orders');
        }
    }
}

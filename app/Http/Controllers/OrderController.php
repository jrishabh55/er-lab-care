<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use function response;

class OrderController extends Controller
{
    public function create(Request $request)
    {
//        $user = $request->user('client_web');

    }

    public function createHandle(Request $request)
    {
        $user = $request->user('client_web');

        $order = new Order;
        $order->product_id = $request->input('product_id');
        $order->amount = $request->input('amount');
        $order->discount = $request->input('discount');
        $order->payment_type = 1;
        $user->orders()->save($order);

        return response('order_made');
    }

}

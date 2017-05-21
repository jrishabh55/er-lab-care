<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Order;

class OrderController extends Controller
{
    function __construct()
    {
    }

    public function show()
    {
        return view('admin.orders', ['orders' => Order::with('client', 'product')->get()]);
    }
}

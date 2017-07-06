<?php

namespace App\Http\Controllers;

use App\Invoice;
use App\Order;
use App\Product;
use Illuminate\Http\Request;
use function redirect;

class OrderController extends Controller
{
    public function create()
    {
//        $user = $request->user('client_web');
        $products = Product::active()->get();
        return view('order.products', ['products' => $products]);

    }

    public function createHandle(Request $request)
    {
        $user = $request->user('client_web');

        $product = Product::findOrFail($request->input('product_id', 0));

        $order = new Order;
        $order->product_id = $product->id;
        $order->amount = $product->price;
//        $order->discount = $request->input('discount');
//        $order->payment_type = 1;
        /** @var Order $order */
        $order = $user->orders()->save($order);
        $invoice = new Invoice;
        $invoice->amount = $order->amount;
        if ($order->discount > 0)
            $invoice->discount = $order->discount;

        $order->invoices()->save($invoice);

        return redirect()->action('InvoiceController@view', $order->invoices()->firstOrFail()->id);
    }

}

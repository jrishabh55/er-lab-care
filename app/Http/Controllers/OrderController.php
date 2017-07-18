<?php

namespace App\Http\Controllers;

use App\Invoice;
use App\Order;
use App\Product;
use App\Promotion;
use Carbon\Carbon;
use Illuminate\Http\Request;
use function abort;
use function redirect;

class OrderController extends Controller
{
    public function create(Request $request, Product $id = null)
    {
        if ($id instanceof Product) {
            if (!$id->active) {
                abort(404);
            }
            $data = ['product' => $id];
            $error = [];
            if ($request->has('promotion')) {
                $promotion = Promotion::where('promotion', $request->input('promotion'))->first();

                if ($promotion instanceof Promotion) {
                    $data['promotion'] = $promotion;
                } else {
                    $error['promotion'] = 'Promotion doesn\'t exists';
                }
            }
            return view('order.new', $data)->withErrors($error);
        } else {
            $products = Product::active()->get();
            return view('order.products', ['products' => $products]);
        }

    }

    public function createHandle(Request $request)
    {
        $user = $request->user('client_web');

        $product = Product::findOrFail($request->input('product_id', 0));

        $order = new Order;
        $order->product_id = $product->id;
        $order->amount = $product->price;
        $order = $user->orders()->save($order);

        $invoice = new Invoice;
        $invoice->amount = $order->amount;
        $invoice->due_date = Carbon::now();
        if ($order->discount > 0)
            $invoice->discount = $order->discount;

        $order->invoices()->save($invoice);

        return redirect()->action('InvoiceController@view', $order->invoices()->firstOrFail()->id);
    }

}

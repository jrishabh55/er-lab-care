<?php

namespace App\Http\Controllers;

use App\Invoice;
use App\Licence;
use Illuminate\Http\Request;
use function redirect;
use function str_random;

class InvoiceController extends Controller
{
    public function view(Request $request)
    {
        return redirect()->to('payment');
    }

    /**
     * @param Request $request
     * @param Invoice $id
     */
    public function paymentHandle(Request $request, Invoice $id)
    {
        $id->pay($id->amount);
        $order = $id->order()->with('product');

        $licence = new Licence;
        $licence->product_id = $order->product->id;
        $licence->order_id = $order->id;
        $licence->active = false;
        $licence->key = str_random(30);

        $request->user('client_web')->licences()->save($licence);

    }
}

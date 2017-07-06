<?php

namespace App\Http\Controllers;

use App\Invoice;
use App\Licence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function generateLicence;
use function redirect;
use function str_random;

class PaymentController extends Controller
{
    public function payment(Request $request, Invoice $id)
    {
        return redirect()->action('PaymentController@response', [$id->id, 'transaction_id' => str_random(32)]);
    }

    public function response(Request $request, Invoice $id)
    {
        $this->validate($request, [
            'transaction_id' => 'required|min:30',
        ]);
        if ($id->isPayable()) {
            if ($id->pay($request->input('transaction_id'))) {
                $order = $id->order()->with('product')->firstOrFail();
                $licence = new Licence;
                $licence->client_id = Auth::guard('client_web')->id();
                $licence->product_id = $order->product->id;
                $licence->order_id = $id->order_id;
                $licence->key = generateLicence();
                $licence->saveOrFail();

                return redirect()->action('ServiceController@view')->withInput(['Invoice Paid']);
            } else {
                return response("Couldn't be paid");
            }
        } else return "Invoice is not payable";
    }
}

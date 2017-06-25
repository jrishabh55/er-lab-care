<?php

namespace App\Observable;


use App\Invoice;
use App\Order;

class OrderObservable
{
    /**
     * @param $order Order
     */
    public function created($order)
    {
        $invoice = new Invoice;
        $invoice->amount = $order->amount;
        $invoice->discount = $order->discount;
        $order->invoices()->save($invoice);
    }
}
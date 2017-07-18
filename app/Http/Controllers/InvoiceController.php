<?php

namespace App\Http\Controllers;

use App\Invoice;
use Illuminate\Http\Request;
use function view;

class InvoiceController extends Controller
{
    public function view(Request $request, Invoice $id)
    {
        return view('invoices.view', ['invoice' => $id->load('order.client', 'order.product')]);
    }

    public function list(Request $request)
    {
        return view('invoices.list', ['invoices' => $request->user('client_web')->invoices()->orderBy('paid')->get()]);
    }
}

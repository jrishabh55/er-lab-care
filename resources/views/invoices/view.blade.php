@extends('layouts.app')
@section('content')

    <div class="col-md-7">
        @component('components.panel',['title' => 'Invoice Details'])
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th class="col-md-5"></th>
                    <th class="col-md-5"></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th>To:</th>
                    <td>{{ $invoice->owner->username.' ('.$invoice->owner->name.')' }}</td>
                    <td></td>
                </tr>
                <tr>
                    <th>Email:</th>
                    <td>{{ $invoice->owner->email }}</td>
                    <td></td>
                </tr>
                </tbody>
            </table>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th class="text-center">Product Name</th>
                    <th class="text-center">Quantity</th>
                    <th class="text-center">Price</th>
                </tr>
                </thead>
                <tbody class="text-left">
                <tr>
                    <td>{{ $invoice->order->product->name }}</td>
                    <td>1</td>
                    <td>{{ $invoice->order->product->price }}</td>
                </tr>
                </tbody>
            </table>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Calculations</th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                <tbody class="text-center">
                <tr>
                    <td></td>
                    <td>Tax 1:</td>
                    <td>0</td>
                </tr>
                <tr>
                    <td></td>
                    <td>Tax 2:</td>
                    <td>0</td>
                </tr>
                <tr>
                    <td></td>
                    <td>Total:</td>
                    <td><strong>{{ $invoice->order->product->full_price }}</strong></td>
                </tr>
                </tbody>
            </table>
        @endcomponent
    </div>
    <div class="col-md-5">
        @component('components.panel',['title' => 'Invoice '.$invoice->id. ' (Due: '.Carbon\Carbon::today()->toDateString().')'])
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th class="col-md-5"></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th>Date:</th>
                    <td>{{ Carbon\Carbon::today()->toDateString() }}</td>
                </tr>
                <tr>
                    <th>Due Date:</th>
                    <td>{{ $invoice->due_date }}</td>
                </tr>
                <tr>
                    <th>Paid Date:</th>
                    <td class="bg-{{ $invoice->isPayable() ? 'danger' : 'success' }}">{{ $invoice->paid_date ?? 'Not Paid' }}</td>
                </tr>
                <tr>
                    <th>Amount:</th>
                    <td>{{ $invoice->amount }}</td>
                </tr>
                <tr>
                    <th>Paid Amount:</th>
                    <td class="bg-{{ $invoice->isPayable() ? 'danger' : 'success' }}">{{ $invoice->paid_amount }}</td>
                </tr>
                <tr>
                    <th>Due:</th>
                    <td>{{ $invoice->due }}</td>
                </tr>
                <tr>
                    <th>Payment Type:</th>
                    <td><strong>{{ $invoice->order->payment_type }}</strong></td>
                </tr>
                </tbody>
            </table>
            <div class="col-md-12">
                @if($invoice->isPayable())
                    <form class="form-horizontal" action="{{ action("PaymentController@payment",$invoice->id) }}"
                          method="post">
                        <div class="form-group">
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-primary col-md-6 col-md-offset-6">Pay</button>
                        </div>
                    </form>
                @else
                    <button class="btn btn-primary">Invoice is paid</button>
                @endif
            </div>
        @endcomponent
    </div>
@endsection
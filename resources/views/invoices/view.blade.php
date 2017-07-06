@extends('layouts.app')
@section('content')
    @if($invoice->isPayable())
        <form class="form-horizontal" action="{{ action("PaymentController@payment",$invoice->id) }}" method="post">
            <div class="form-group">
                <label class="col-md-2">Invoice {{ $invoice->id }}</label>
                <button type="submit" class="btn btn-primary col-md-2">Pay</button>
            </div>
            {{ csrf_field() }}
        </form>
    @else
        <h1>Invoice is paid</h1>
    @endif
@endsection
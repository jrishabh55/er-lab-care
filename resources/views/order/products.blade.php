@extends('layouts.app')
@section('content')
    <form class="form-horizontal" method="post" action="{{ action("OrderController@createHandle") }}">
        <div class="form-group col-md-2">
            <label for="products">Select Product</label>
            <select class="form-control" id="products" name="product_id"
                    onchange="window.location = '/order/create/'+document.getElementById('products').options[document.getElementById('products').selectedIndex].value">
                @foreach($products as $product)
                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                @endforeach
            </select>
        </div>
    </form>
@endsection
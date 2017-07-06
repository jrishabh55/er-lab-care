@extends('layouts.app')
@section('content')
    <form class="form-horizontal" method="post" action="{{ action("OrderController@createHandle") }}">
        <div class="form-group col-md-2">
            <select class="form-control" name="product_id">
                @foreach($products as $product)
                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-2">
            {{ csrf_field() }}
            <button class="btn btn-primary form-control" type="submit">Submit</button>
        </div>
    </form>
@endsection
@extends('layouts.app')
@section('content')
    <div class="col-md-7">
        <div class="panel panel-primary">
            <div class="panel-heading text-center"><h3>New Order</h3></div>
            <div class="panel-body">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th class="col-md-4"></th>
                        <th class="col-md-8"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th>Product:</th>
                        <td>{{ $product->name }}</td>
                    </tr>
                    <tr>
                        <th>Description:</th>
                        <td>{{ $product->desc }}</td>
                    </tr>
                    <tr>
                        <th>Price</th>
                        <td>{{ $product->full_price }}</td>
                    </tr>
                    <tr>
                        <th></th>
                        <td>
                            <form class="col-md-6" method="post"
                                  action="{{ action("OrderController@createHandle") }}">
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                {{ csrf_field() }}
                                <button class="btn btn-primary form-control" type="submit">Order</button>
                            </form>

                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-5">
        <div class="panel panel-primary">
            <div class="panel-heading text-center"><h3>Pricing</h3></div>
            <div class="panel-body">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th class="col-md-4"></th>
                        <th class="col-md-8"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th>Product Price</th>
                        <td>{{ $product->full_price }}</td>
                    </tr>
                    <tr>
                        <th>Discount</th>
                        <td>
                            @isset($promotion)
                                {{ $promotion->promotion }}
                            @endisset
                            @empty($promotion)
                                0
                            @endempty
                        </td>
                    </tr>
                    <tr>
                        <th>Promotion</th>
                        <td>
                            <form class="form-horizontal col-md-11" method="get"
                                  action="">
                                <div class="form-group{{ $errors->has('promotion') ? ' has-error' : '' }}">
                                    <input type="text" value="{{ Request::input('promotion','') }}" class="form-control"
                                           name="promotion" placeholder="Promotion Coupon"/>
                                    @if ($errors->has('promotion'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('promotion') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary form-control" type="submit">Apply</button>
                                </div>
                            </form>

                        </td>
                    </tr>
                    <tr>
                        <th>Price</th>
                        <td>
                            @isset($promotion)
                                {{ $product->price - $promotion->promotion }} {{ $product->currency }}
                            @endisset
                            @empty($promotion)
                                {{ $product->full_price }}
                            @endempty
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
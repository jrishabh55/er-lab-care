@extends('admin.layouts.app')
@section('content')
    <div class="container">
        <table class="table">
            <caption>orders</caption>
            <thead class="bg-primary">
            <tr>
                <th>ID</th>
                <th>Amount</th>
                <th>Payment Type</th>
                <th>Product</th>
                <th>Client</th>
            </tr>
            </thead>
            <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->amount }}</td>
                    <td>{{ $order->payment_type }}</td>
                    <td>{{ $order->product->name }}</td>
                    <td>{{ $order->client->name }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
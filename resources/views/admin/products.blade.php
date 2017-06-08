@extends('admin.layouts.app')
@section('content')
    <div class="container">
        <h2 class="text-primary text-center">Products</h2>
        <table class="table">
            <thead class="bg-primary">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Currency</th>
                <th>Promotions</th>
                <th>Download</th>
                <th>Trial Download</th>
            </tr>
            </thead>
            <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->value }}</td>
                    <td>{{ $product->currency }}</td>
                    <td>
                        @if($product->promotions->count())
                            <ul>
                                @foreach($product->promotions as $promotion)
                                    <li><a href="#">{{ $promotion->name }}</a></li>
                                @endforeach
                            </ul>
                        @else
                            No Promotion applicable.
                        @endif
                    </td>
                    <td><a href="{{ $product->full_file }}" class="btn btn-primary">Download <i
                                    class="glyphicon glyphicon-download"></i></a></td>
                    <td><a href="{{ $product->trial_file }}" class="btn btn-warning">Download <i
                                    class="glyphicon glyphicon-download"></i></a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
@extends('admin.layouts.app')
@section('content')
    <div class="container">
        <h2 class="text-primary text-center">Clients</h2>
        <table class="table">
            <thead class="bg-primary">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Number</th>
                <th>Licences</th>
            </tr>
            </thead>
            <tbody>
            @foreach($clients as $client)
                <tr>
                    <td>{{ $client->id }}</td>
                    <td>{{ $client->name }}</td>
                    <td>{{ $client->email }}</td>
                    <td>{{ $client->number }}</td>
                    <td>
                        @if($client->licences->count())
                            <ul>
                                @foreach($client->licences as $licence)
                                    <li>{{ $licence->product->name }}</li>
                                @endforeach
                            </ul>
                        @else
                            No Licence Active
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="text-center">{{ $clients->links() }}</div>
    </div>
@endsection
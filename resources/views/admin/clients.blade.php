@extends('admin.layouts.app')
@section('content')
    <div class="container">
        <table class="table">
            <caption>Users</caption>
            <thead class="bg-primary">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Number</th>
                <th>Active</th>
            </tr>
            </thead>
            <tbody>
            @foreach($clients as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->number }}</td>
                    <td>{{ $user->name }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
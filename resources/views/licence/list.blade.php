@extends('layouts.app')
@section('content')
    @component('components.panel',['title' => 'Licences'])
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>S.no</th>
                <th>Product</th>
                <th>Licence</th>
                <th>Active</th>
            </tr>
            </thead>
            <tbody>
            @foreach($licences as $licence)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $licence->product->name }}</td>
                    <td>{{ $licence->key }}</td>
                    <td>
                        <button class="btn btn-{{ !$licence->active ? 'success' : 'primary' }}">{{ $licence->isActive() ? 'Active' : 'Inactive'}}</button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endcomponent
@endsection
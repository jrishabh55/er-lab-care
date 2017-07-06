@extends('layouts.app')
@section('content')
    <div class="panel panel-primary col-md-4">
        <div class="panel-heading">
            Licences
        </div>
        <div class="panel-body">
            <ol class="list-group">
                @foreach($licences as $licence)
                    <li>{{ $licence->key }}</li>
                @endforeach
            </ol>
        </div>
    </div>
@endsection
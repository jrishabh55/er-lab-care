@extends('layouts.app')
@section('content')
    <div class="col-md-3">
        @php
            $unpaid =  $invoices->where('paid',false)->count();
        @endphp
        @component('components.panel',['title' => $unpaid.' Unpaid Invoice'])
            You have {{ $unpaid == 0 ? 'no' : $unpaid }} unpaid invoice at this time.
        @endcomponent

        @component('components.panel',['title' => 'Invoice Status'])
            <ul class="col-md-12">
                <li><strong>Paid :</strong> <span
                            class="pull-right">{{ $invoices->where('paid', true)->count() }}</span></li>
                <li><strong>Unpaid :</strong> <span class="pull-right">{{ $unpaid }}</span></li>
            </ul>
        @endcomponent
    </div>
    <div class="col-md-8">
        @component('components.panel',['title' => 'Invoices'])
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>#id</th>
                    <th>Invoice Date</th>
                    <th>Due Date</th>
                    <th>Total</th>
                    <th>Status</th>
                </tr>
                </thead>
                <tbody>
                @forelse($invoices as $invoice)
                    <tr onclick="window.location = '{{ action('InvoiceController@view',$invoice->id) }}'"
                        style="cursor: pointer;">
                        <td>#{{ $invoice->id }}</td>
                        <td>{{ $invoice->created_at->toDateString() }}</td>
                        <td>{{ $invoice->due_date }}</td>
                        <td>{{ $invoice->amount }}</td>
                        <td>
                            <button class="btn btn-{{ $invoice->isPaid() ? 'success' : 'danger' }} col-md-12">{{ $invoice->isPaid() ? 'Paid' : 'Pending' }}</button>
                        </td>
                    </tr>
                @empty
                    <p>No Invoices Found.</p>
                @endforelse
                </tbody>
            </table>
        @endcomponent
    </div>
@endsection
@extends('layouts.print')

@section('title')
Sales Report
@endsection

@section('report_heading')
Sales Report
@endsection

@section('content')

    @if(request('from') && request('to'))

        <p class="mb-0">

            <strong>Period:</strong>

            {{ \Carbon\Carbon::parse(request('from'))->format('F d, Y') }}

            -

            {{ \Carbon\Carbon::parse(request('to'))->format('F d, Y') }}

        </p>

    @endif

<h5 class="mb-3">
    SUMMARY
</h5>

<table class="table table-bordered w-50 mb-4">

    <tr>

        <th>Total Sales</th>

        <td>
            ₱{{ number_format($totalSales, 2) }}
        </td>

    </tr>

    <tr>

        <th>Quantity Sold</th>

        <td>{{ $totalQuantity }}</td>

    </tr>

    <tr>

        <th>Total Transactions</th>

        <td>{{ $totalTransactions }}</td>

    </tr>

</table>

 

<hr class="mb-4">

<h5 class="mb-3">
    SALES DETAILS
</h5>


<table class="table table-bordered table-sm">

    <thead class="table-dark">

        <tr>

            <th>#</th>
            <th>Product</th>
            <th class="text-end">Quantity</th>
            <th class="text-end">Selling Price</th>
            <th class="text-end">Line Total</th>
            <th>Date</th>

        </tr>

    </thead>

    <tbody>

    @forelse($sales as $sale)

        <tr>

            <td>{{ $loop->iteration }}</td>

<td>{{ $sale->product->name }}</td>

<td class="text-end">{{ $sale->quantity }}</td>

<td class="text-end">
    ₱{{ number_format($sale->selling_price, 2) }}
</td>

<td class="text-end">
    ₱{{ number_format($sale->line_total, 2) }}
</td>

<td>{{ $sale->created_at->format('M d, Y') }}</td>

        </tr>

    @empty

        <tr>

            <td colspan="6" class="text-center">
                No sales found.
            </td>

        </tr>

    @endforelse

    </tbody>

</table>

<div class="text-center mt-3">

    <small class="text-muted">

        End of Sales Report

    </small>

</div>

@endsection

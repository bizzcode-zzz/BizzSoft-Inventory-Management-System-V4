@extends('layouts.app')

@section('content')
<div class="container mt-4" style="color: black;">
    <div class="mb-3">
        <a href="{{ route('reports.index') }}" class="text-decoration-none">← Back to Reports</a>
    </div>
    <h2 class="mb-4">📦 Purchase Report Ledger</h2>
    
    <table class="table table-striped table-hover shadow-sm border">
        <thead class="table-dark">
            <tr>
                <th>Product</th>
                <th>Supplier</th>
                <th>Quantity</th>
                <th>Cost Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach($purchases as $purchase)
                <tr>
                    <td class="font-weight-bold">{{ $purchase->product->name ?? 'Deleted Product' }}</td>
                    <td class="text-muted">{{ $purchase->supplier->supplier_name ?? 'Deleted Supplier' }}</td>
                    <td>{{ $purchase->quantity }} pcs</td>
                    <td class="font-monospace">₱{{ number_format($purchase->cost_price, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container mt-4" style="color: black;">
    <div class="mb-3">
        <a href="{{ route('reports.index') }}" class="text-decoration-none">← Back to Reports</a>
    </div>
    <h2 class="mb-4 text-danger">⚠️ Low Stock Warning Ledger</h2>
    
    <table class="table table-striped table-hover shadow-sm border">
        <thead class="table-danger border-dark">
            <tr class="table-dark">
                <th>Critical Item</th>
                <th>Category</th>
                <th>Remaining Stock</th>
                <th>Safety Threshold</th>
            </tr>
        </thead>
        <tbody>
            @foreach($lowStockProducts as $product)
                <tr class="table-warning text-danger">
                    <td class="font-weight-bold">{{ $product->name }}</td>
                    <td>{{ $product->category->category_name ?? 'Uncategorized' }}</td>
                    <td class="font-weight-bold">{{ $product->stock }} pcs</td>
                    <td class="text-dark">{{ $product->reorder_level }} pcs limit</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

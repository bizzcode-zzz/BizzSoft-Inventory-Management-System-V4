@extends('layouts.print')

@section('title')
Low Stock Report
@endsection

@section('report_heading')
Low Stock Warning Report
@endsection

@section('content')

    @if(request('search'))
        <p class="mb-0">
            <strong>Filters Applied:</strong>
            "Search: {{ request('search') }}"
        </p>
    @endif

<h5 class="mb-3">
    SUMMARY
</h5>

<table class="table table-bordered summary-table w-50 mb-4">

    <tr>
        <th>Low Stock Products</th>
        <td>{{ $totalLowStockProducts }}</td>
    </tr>

    <tr>
        <th>Total Low Stock Quantity</th>
        <td>{{ $totalLowStockQuantity }} pcs</td>
    </tr>

</table>

<hr class="mb-3">

<p class="text-muted small">
Products listed below have reached or fallen below their configured safety stock level and may require replenishment.
</p>

<hr class="mb-4">

<h5 class="mb-3">
    CRITICAL INVENTORY DETAILS
</h5>


<table class="table table-bordered table-sm">

    <thead>
    <tr>
        <th>Critical Item</th>
        <th>Category</th>
        <th class="text-end">Remaining Stock</th>
        <th class="text-end">Safety Threshold</th>
    </tr>
</thead>

    <tbody>

    @forelse($lowStockProducts as $product)

        <tr>
            <td class="fw-bold">{{ $product->name }}</td>

            <td>{{ $product->category->category_name ?? 'Uncategorized' }}</td>

            <td class="text-end">
                {{ $product->stock }} pcs
            </td>

            <td class="text-end text-muted">
                {{ $product->reorder_level }} pcs limit
            </td>
        </tr>

    @empty

        <tr>
            <td colspan="4" class="text-center">
             No low stock products found.
            </td>
        </tr>

    @endforelse

    </tbody>

</table>

<div class="text-center mt-3">

    <small class="text-muted">

        End of Low Stock Warning Report

    </small>

</div>

@endsection

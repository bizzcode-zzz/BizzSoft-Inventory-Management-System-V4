@extends('layouts.app')

@section('content')
<div class="container mt-4" style="color: black;">
    <div class="mb-3">
        <a href="{{ route('reports.index') }}" class="text-decoration-none">← Back to Reports</a>
    </div>
    
    <!-- 🖨️ Ininsert ang Print Button katabi ang iyong H2 header gamit ang d-flex -->
 
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0 text-danger">⚠️ Low Stock Warning Ledger</h2>
        
        <a href="{{ route('reports.low-stock.print', request()->query()) }}" 
           target="_blank" 
           class="btn btn-primary">
            🖨️ Print Report
        </a>
    </div>





    <div class="row mb-4">

    <div class="col-md-6">
        <div class="card shadow-sm border-warning">
            <div class="card-body">
                <h6 class="text-warning">⚠️ Low Stock Products</h6>
                <h4>{{ $totalLowStockProducts }}</h4>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card shadow-sm border-danger">
            <div class="card-body">
                <h6 class="text-danger">📦 Total Low Stock Quantity</h6>
                <h4>{{ $totalLowStockQuantity }}</h4>
            </div>
        </div>
    </div>

</div>



<form method="GET" action="{{ route('reports.low_stock') }}" class="row g-3 mb-4">

    <div class="col-md-10">
        <input
            type="text"
            name="search"
            class="form-control"
            placeholder="Search low stock product..."
            value="{{ request('search') }}">
    </div>

    <div class="col-md-2">
        <button class="btn btn-primary w-100">
            Search
        </button>
    </div>

</form>


    
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
    <div class="mt-3">
    {{ $lowStockProducts->appends(request()->query())->links() }}
</div>
</div>
@endsection

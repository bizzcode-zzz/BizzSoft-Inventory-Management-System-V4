@extends('layouts.app')

@section('content')
<div class="container mt-4" style="color: black;">
    
    <!-- Spacing back button shortcut link pointer -->
    <div class="mb-3">
        <a href="{{ route('reports.index') }}" class="text-decoration-none" style="font-weight: bold;">← Back to Reports</a>
    </div>
    
    <h2 class="mb-4">🗂️ Current Inventory Status Report</h2>
    <div class="d-flex justify-content-between align-items-center mb-4">
  <a href="{{ route('reports.inventory.print', request()->query()) }}" 
           target="_blank" 
           class="btn btn-primary">
            🖨️ Print Report
        </a>
    </div>
    


    <div class="row mb-4">

    <div class="col-md-3">
        <div class="card shadow-sm border-primary">
            <div class="card-body">
                <h6 class="text-primary">📦 Total Products</h6>
                <h4>{{ $totalProducts }}</h4>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm border-success">
            <div class="card-body">
                <h6 class="text-success">📚 Total Stock</h6>
                <h4>{{ $totalStock }}</h4>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm border-warning">
            <div class="card-body">
                <h6 class="text-warning">⚠️ Low Stock</h6>
                <h4>{{ $lowStockProducts }}</h4>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm border-danger">
            <div class="card-body">
                <h6 class="text-danger">❌ Out of Stock</h6>
                <h4>{{ $outOfStockProducts }}</h4>
            </div>
        </div>
    </div>

</div>



<form method="GET" action="{{ route('reports.inventory') }}" class="row g-3 mb-4">

    <div class="col-md-5">
        <input
            type="text"
            name="search"
            class="form-control"
            placeholder="Search product..."
            value="{{ request('search') }}">
    </div>

    <div class="col-md-5">
        <select name="category" class="form-select">

            <option value="">All Categories</option>

            @foreach($categories as $category)

                <option
                    value="{{ $category->id }}"
                    {{ request('category') == $category->id ? 'selected' : '' }}>

                    {{ $category->category_name }}

                </option>

            @endforeach

        </select>
    </div>

    <div class="col-md-2">
        <button class="btn btn-primary w-100">
            Filter
        </button>
    </div>

</form>

    
    <!-- 🏛️ LUXURY BOOTSTRAP STRIPED HOVER TABLE WITH THE NEW DYNAMIC STATUS MATRIX -->
    <table class="table table-striped table-hover shadow-sm border">
        <thead class="table-dark">
            <tr>
                <th>Product</th>
                <th>Category</th>
                <th>Stock</th>
                <th>Reorder Level</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
                <tr>
                    <!-- 1. PRODUCT NAME -->
                    <td class="font-weight-bold">
                        {{ $product->name }}
                    </td>
                    
                    <!-- 2. CATEGORY DETAILS NAME -->
                    <td class="text-muted">
                        {{ $product->category->category_name ?? 'Uncategorized' }}
                    </td>
                    
                    <!-- 3. CURRENT STOCK BALANCE -->
                    <td class="font-monospace">
                        {{ $product->stock }} pcs
                    </td>
                    
                    <!-- 4. SAFETY THRESHOLD REORDER LEVEL -->
                    <td class="font-family-monospace text-muted">
                        {{ $product->reorder_level }} pcs limit
                    </td>
                    
                    <!-- 5. ✨ THE AUTOMATED DYNAMIC STATUS CONDITION GENERATOR -->
                    <td>
                        @if($product->stock == 0)
                            <!-- CONDITION A: Saktong ubos ang laman ng bodega -->
                            <span class="badge bg-danger px-3 py-2" style="font-size: 0.85rem;">
                                ❌ Out of Stock
                            </span>
                        @elseif($product->stock <= $product->reorder_level)
                            <!-- CONDITION B: Lumusot o umabot na sa critical threshold point -->
                            <span class="badge bg-warning text-dark px-3 py-2" style="font-size: 0.85rem;">
                                ⚠️ Low Stock
                            </span>
                        @else
                            <!-- CONDITION C: Ligtas at sagana ang bilang ng mga paninda -->
                            <span class="badge bg-success px-3 py-2" style="font-size: 0.85rem;">
                                ✅ In Stock
                            </span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    </table>

<div class="mt-3">
    {{ $products->appends(request()->query())->links() }}
</div>

<!-- Spacing bumper blocker to dodge footer overlays window niyo bro -->
<div class="my-5 py-3"></div>

</div>
@endsection

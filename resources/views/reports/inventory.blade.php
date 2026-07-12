@extends('layouts.app')

@section('content')
<div class="container mt-4" style="color: black;">
    
    <!-- Spacing back button shortcut link pointer -->
    <div class="mb-3">
        <a href="{{ route('reports.index') }}" class="text-decoration-none" style="font-weight: bold;">← Back to Reports</a>
    </div>
    
    <h2 class="mb-4">🗂️ Current Inventory Status Report</h2>
    
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

    <!-- Spacing bumper blocker to dodge footer overlays window niyo bro -->
    <div class="my-5 py-3"></div>

</div>
@endsection

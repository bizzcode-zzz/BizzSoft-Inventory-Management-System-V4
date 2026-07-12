@extends('layouts.app')

@section('content')

<!-- 🎯 5. UNIFORM PAGE SPACING CONTAINER -->
<div class="container mt-4" style="color: black;">

    <!-- 🛑 REUSABLE ERROR MESSAGES COMPONENT -->
    <x-errors />

    <!-- 🟢 SUCCESS ALERT COMPONENT -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm mb-4" role="alert">
            <strong>Success!</strong> {{ session('success') }}
        </div>
    @endif

    <!-- =========================================================================
         🎯 1. BUSINESS-CENTRIC HEADING SECTION
         ========================================================================= -->
    <div class="mb-4">
        <h1 class="font-weight-bold">📦 Product Management</h1>
        <p class="text-muted" style="font-size: 1.1rem;">Manage all products available in your inventory.</p>
    </div>


    <!-- =========================================================================
         🎯 3. FORM CARD: ADD PRODUCT FORM SECTION
         ========================================================================= -->
    <div class="card shadow-sm mb-4 border">
        <div class="card-header bg-dark text-white py-3">
            <h5 class="m-0 font-weight-bold">📦 Add Product</h5>
        </div>
        <div class="card-body bg-light">
            <form action="{{ route('products.store') }}" method="POST" style="max-width: 500px;">
                @csrf

                <!-- PRODUCT NAME INPUT -->
                <div class="mb-3">
                    <label class="form-label font-weight-bold">Product Name:</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="form-control border-dark" placeholder="e.g. Coffee" required>
                </div>

                <!-- CATEGORY DROPDOWN -->
                <div class="mb-3">
                    <label class="form-label font-weight-bold">Category:</label>
                    <select name="category_id" class="form-select border-dark" required>
                        <option value="">-- Select Category --</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->category_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- PRICE INPUT -->
                <div class="mb-3">
                    <label class="form-label font-weight-bold">Price:</label>
                    <input type="number" step="0.01" name="price" value="{{ old('price') }}" class="form-control border-dark" placeholder="0.00" required>
                </div>

                <!-- INITIAL STOCK INPUT -->
                <div class="mb-3">
                    <label class="form-label font-weight-bold">Stock:</label>
                    <input type="number" name="stock" value="{{ old('stock') }}" class="form-control border-dark" placeholder="0" required>
                </div>

                <!-- DYNAMIC THRESHOLD LIMIT INPUT (Reorder Level) -->
                <div class="mb-3">
                    <label class="form-label font-weight-bold">Reorder Level / Threshold:</label>
                    <input type="number" name="reorder_level" value="{{ old('reorder_level', 5) }}" class="form-control border-dark" placeholder="e.g. 5" required>
                    <small class="text-muted">An alert will trigger if stocks fall below this number.</small>
                </div>

                <!-- 🎯 6. UNIFORM SAVE BUTTON -->
                <button type="submit" class="btn btn-primary px-4 font-weight-bold shadow-sm">
                    💾 Save Product
                </button>
            </form>
        </div>
    </div>


    <!-- =========================================================================
         🎯 4 & 5. PRODUCT LIST & SEARCH OPERATIONS TABLE CARD SECTION
         ========================================================================= -->
    <div class="card shadow-sm border mb-5">
        <div class="card-header bg-dark text-white py-3">
            <h5 class="m-0 font-weight-bold">📋 Product List</h5>
        </div>
        <div class="card-body">

            <!-- 🎯 4. SEARCH INPUT WRAPPED CLEAN INSIDE THE CARD -->
            <div class="mb-4" style="max-width: 400px;">
                <form action="{{ route('products.index') }}" method="GET" class="input-group">
                    <input type="text" name="search" value="{{ $search ?? '' }}" class="form-control border-dark" placeholder="Search product name...">
                    <!-- 🎯 6. UNIFORM SEARCH BUTTON -->
                    <button class="btn btn-secondary font-weight-bold" type="submit">
                        🔍 Search
                    </button>
                    @if($search ?? false)
                        <a href="{{ route('products.index') }}" class="btn btn-danger font-weight-bold">Clear</a>
                    @endif
                </form>
            </div>

<div class="table-responsive">
            <!-- 🎯 5. THE RETIREMENT OF BORDER="1" - MODERN BOOTSTRAP STRIPED HOVER TABLE -->
            <table class="table table-striped table-hover shadow-sm border align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Product</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Reorder Level</th>
                        <th style="width: 180px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                        <tr>
                            <!-- 1. PRODUCT NAME TEXT -->
                            <td class="font-weight-bold text-primary" style="font-size: 1.05rem;">
                                {{ $product->name }}
                            </td>
                            
                            <!-- 2. RELATIONAL CATEGORY INDICATOR -->
                            <td class="text-muted">
                                {{ $product->category->category_name ?? 'Uncategorized' }}
                            </td>
                            
                            <!-- 3. UNIT PRICE -->
                            <td class="font-family-monospace">
                                ₱{{ number_format($product->price, 2) }}
                            </td>
                            
                            <!-- 4. ACTIVE STOCK WITH DYNAMIC COLOR COMPONENT BADGES -->
                            <td class="font-family-monospace">
                                @if($product->stock == 0)
                                    <span class="badge bg-danger px-2 py-1">0 pcs (Out of Stock)</span>
                                @elseif($product->stock <= $product->reorder_level)
                                    <span class="badge bg-warning text-dark px-2 py-1">{{ $product->stock }} pcs (Low Stock)</span>
                                @else
                                    <span class="badge bg-secondary px-2 py-1">{{ $product->stock }} pcs</span>
                                @endif
                            </td>

                            <!-- 5. REORDER POINT LIMIT -->
                            <td class="text-muted font-family-monospace">
                                {{ $product->reorder_level }} pcs
                            </td>
                            
                            <!-- 🎯 6. UNIFORM BOOTSTRAP BUTTONS WITH ICONS -->
                            <td>
                                <!-- ✏️ EDIT LINK BUTTON -->
                                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-outline-primary font-weight-bold me-1">
                                    ✏️ Edit
                                </a>

                                <!-- 🗑️ DELETE FORM TRIGER BUTTON -->
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to permanently delete this item?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger font-weight-bold">
                                        🗑️ Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">
                                No registered products discovered matching your parameter filters.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
</div>
        </div>
    </div>

    <!-- Spacer bumper block for fixed footer padding visibility -->
    <div class="py-4"></div>

</div>

@endsection

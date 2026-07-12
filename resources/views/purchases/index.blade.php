@extends('layouts.app')

@section('content')

<!-- 🎯 SEAMLESS INTEGRATION: Ginamitan ng page-content class mula sa app.css -->
<div class="container mt-4 page-content">

    <!-- 🛑 REUSABLE ERROR MESSAGES COMPONENT -->
    <x-errors />

    <!-- 🟢 SUCCESS ALERT COMPONENT -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm mb-4" role="alert">
            <strong>Success!</strong> {{ session('success') }}
        </div>
    @endif

    <!-- =========================================================================
         🎯 BUSINESS-CENTRIC HEADING SECTION
         ========================================================================= -->
    <div class="mb-4">
        <h1 class="font-weight-bold">Purchase Management</h1>
        <p class="text-muted page-description-text">Record and monitor all stock restocks and procurement purchases from suppliers.</p>
    </div>

    <!-- =========================================================================
         🎯 FORM CARD: ADD NEW PURCHASE TRANSACTION SECTION
         ========================================================================= -->
    <div class="card shadow-sm mb-4 border">
        <div class="card-header bg-dark text-white py-3">
            <h5 class="m-0 font-weight-bold">📦 Add New Purchase</h5>
        </div>
        <div class="card-body bg-light">
            <form action="{{ route('purchases.store') }}" method="POST" class="form-container">
                @csrf 

                <!-- 1. PRODUCT DROPDOWN -->
                <div class="mb-3">
                    <label class="form-label font-weight-bold">Select Product:</label>
                    <select name="product_id" class="form-select border-dark" required>
                        <option value="">-- Choose Product --</option>
                        @foreach($products as $product)
                            <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>
                                {{ $product->name }} (Current Stock: {{ $product->stock }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- 2. SUPPLIER DROPDOWN -->
                <div class="mb-3">
                    <label class="form-label font-weight-bold">Select Supplier:</label>
                    <select name="supplier_id" class="form-select border-dark" required>
                        <option value="">-- Choose Supplier --</option>
                        @foreach($suppliers as $supplier)
                            <option value="{{ $supplier->id }}" {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>
                                {{ $supplier->supplier_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- 3. QUANTITY FIELD -->
                <div class="mb-3">
                    <label class="form-label font-weight-bold">Quantity:</label>
                    <input type="number" name="quantity" value="{{ old('quantity') }}" class="form-control border-dark" placeholder="e.g. 10" required>
                </div>

                <!-- 4. COST PRICE FIELD -->
                <div class="mb-3">
                    <label class="form-label font-weight-bold">Cost Price per unit:</label>
                    <div class="input-group">
                        <span class="input-group-text border-dark bg-secondary text-white">₱</span>
                        <input type="number" step="0.01" name="cost_price" value="{{ old('cost_price') }}" class="form-control border-dark" placeholder="0.00" required>
                    </div>
                </div>

                <!-- 5. PURCHASE DATE FIELD -->
                <div class="mb-4">
                    <label class="form-label font-weight-bold">Purchase Date:</label>
                    <input type="date" name="purchase_date" value="{{ old('purchase_date', date('Y-m-d')) }}" class="form-control border-dark" required>
                </div>

                <!-- UNIFORM SAVE BUTTON -->
                <button type="submit" class="btn btn-primary px-4 font-weight-bold shadow-sm">
                    💾 Save Purchase
                </button>
            </form>
        </div>
    </div>

    <!-- =========================================================================
         🎯 PURCHASE RECORDS LIST TABLE & SEARCH UTILITY CARD SECTION
         ========================================================================= -->
    <div class="card shadow-sm border mb-5">
        <div class="card-header bg-dark text-white py-3">
            <h5 class="m-0 font-weight-bold">📋 Purchase Records</h5>
        </div>
        <div class="card-body">

            <!-- 🔍 SEARCH INPUT WRAPPED CLEAN INSIDE THE CARD -->
            <div class="mb-4 search-container">
                <form action="{{ route('purchases.index') }}" method="GET" class="input-group">
                    <input type="text" name="search" value="{{ $search }}" class="form-control border-dark" placeholder="Search quantity or cost...">
                    <button class="btn btn-secondary font-weight-bold" type="submit">
                        🔍 Search
                    </button>
                    @if($search)
                        <a href="{{ route('purchases.index') }}" class="btn btn-danger font-weight-bold">Clear</a>
                    @endif
                </form>
            </div>


            <div class="table-responsive">
            <!-- MODERN BOOTSTRAP STRIPED HOVER TABLE -->
            <table class="table table-striped table-hover shadow-sm border align-middle">
                <thead class="table-dark">
                    <tr>
                        <th style="width: 80px;">ID</th>
                        <th>Product Name</th>
                        <th>Supplier</th>
                        <th>Quantity</th>
                        <th>Cost Price</th>
                        <th>Purchase Date</th>
                        <th class="action-column">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($purchases as $purchase)
                        <tr>
                            <td class="text-muted font-family-monospace">#{{ $purchase->id }}</td>
                            <td class="font-weight-bold text-primary text-brand-primary">
                                {{ $purchase->product->name ?? 'Deleted Product' }}
                            </td>
                            <td class="text-muted">
                                {{ $purchase->supplier->supplier_name ?? 'Deleted Supplier' }}
                            </td>
                            <td>{{ $purchase->quantity }} pcs</td>
                            <td class="font-family-monospace">₱{{ number_format($purchase->cost_price, 2) }}</td>
                            <td class="text-secondary small">
                                {{ date('F d, Y', strtotime($purchase->purchase_date)) }}
                            </td>
                            <td>
                                <!-- ⚠️ UPDATE: Tinanggal na si Edit button dito bro, purong Delete action na lang! -->
                                <form action="{{ route('purchases.destroy', $purchase->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this transaction record?');">
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
                            <td colspan="7" class="text-center text-muted py-4">
                                No registered stock procurement transactions matching your parameter filters.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            </div>

        </div>
    </div>

    <!-- Spacer block para iwas dikit sa footer -->
    <div class="footer-bumper-spacer"></div>

</div> <!-- /container -->

@endsection

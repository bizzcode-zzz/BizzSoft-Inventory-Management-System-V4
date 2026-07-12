@extends('layouts.app')

@section('content')

<!-- 🎯 SEAMLESS INTEGRATION: Ginamitan ng page-content selector class mula sa app.css asset niyo -->
<div class="container mt-4 page-content">

    <!-- 🛑 REUSABLE ERROR MESSAGES COMPONENT -->
    <x-errors />

    <!-- 🟢 SUCCESS ALERT COMPONENT (Naka-Bootstrap template na bro) -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm mb-4" role="alert">
            <strong>Success!</strong> {{ session('success') }}
        </div>
    @endif

    <!-- =========================================================================
         🎯 BUSINESS-CENTRIC HEADING SECTION (100% Clean)
         ========================================================================= -->
    <div class="mb-4">
        <h1 class="font-weight-bold">Sales Management (POS)</h1>
        <p class="text-muted page-description-text">Issue new customer invoices, process live retail sales transactions, and monitor revenue ledgers.</p>
    </div>


    <!-- =========================================================================
         🎯 FORM CARD: ADD NEW SALE / INVOICE SECTION (100% Clean)
         ========================================================================= -->
    <div class="card shadow-sm mb-4 border">
        <div class="card-header bg-dark text-white py-3">
            <h5 class="m-0 font-weight-bold">🧾 Add New Sale / Invoice</h5>
        </div>
        <div class="card-body bg-light">
            <!-- 🎯 SEAMLESS INTEGRATION: Ginamitan ng form-container class mula sa app.css -->
            <form action="{{ route('sales.store') }}" method="POST" class="form-container">
                @csrf 

                <!-- 1. PRODUCT DROPDOWN SELECTION FIELD -->
                <div class="mb-3">
                    <label class="form-label font-weight-bold">Select Product to Sell:</label>
                    <select name="product_id" class="form-select border-dark" required>
                        <option value="">-- Choose Product --</option>
                        @foreach($products as $product)
                            <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>
                                {{ $product->name }} (Available Stock: {{ $product->stock }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- 2. QUANTITY FIELD -->
                <div class="mb-3">
                    <label class="form-label font-weight-bold">Quantity Sold:</label>
                    <input type="number" name="quantity" value="{{ old('quantity') }}" class="form-control border-dark" placeholder="e.g. 5" required>
                </div>

                <!-- 3. SELLING PRICE FIELD -->
                <div class="mb-3">
                    <label class="form-label font-weight-bold">Selling Price per unit:</label>
                    <div class="input-group">
                        <span class="input-group-text border-dark bg-secondary text-white">₱</span>
                        <input type="number" step="0.01" name="selling_price" value="{{ old('selling_price') }}" class="form-control border-dark" placeholder="0.00" required>
                    </div>
                </div>

                <!-- 4. SALES DATE FIELD -->
                <div class="mb-4">
                    <label class="form-label font-weight-bold">Sales Date:</label>
                    <input type="date" name="sales_date" value="{{ old('sales_date', date('Y-m-d')) }}" class="form-control border-dark" required>
                </div>

                <!-- UNIFORM SAVE BUTTON -->
                <button type="submit" class="btn btn-primary px-4 font-weight-bold shadow-sm">
                    💾 Save Invoice / Transaction
                </button>
            </form>
        </div>
    </div>


    <!-- =========================================================================
         🎯 SALES RECORDS LIST TABLE & SEARCH UTILITY CARD SECTION (100% Clean)
         ========================================================================= -->
    <div class="card shadow-sm border mb-5">
        <div class="card-header bg-dark text-white py-3">
            <h5 class="m-0 font-weight-bold">📋 Sales Records</h5>
        </div>
        <div class="card-body">

            <!-- 🔍 SEARCH INPUT WRAPPED CLEAN INSIDE THE CARD LAYER -->
            <!-- 🎯 SEAMLESS INTEGRATION: Ginamitan ng search-container class mula sa app.css -->
            <div class="mb-4 search-container">
                <form action="{{ route('sales.index') }}" method="GET" class="input-group">
                    <input type="text" name="search" value="{{ $search }}" class="form-control border-dark" placeholder="Search quantity or price...">
                    <!-- UNIFORM SEARCH BUTTON -->
                    <button class="btn btn-secondary font-weight-bold" type="submit">
                        🔍 Search
                    </button>
                    @if($search)
                        <a href="{{ route('sales.index') }}" class="btn btn-danger font-weight-bold">Clear</a>
                    @endif
                </form>
            </div>

            <div class="table-responsive">
            <!-- MODERN BOOTSTRAP STRIPED HOVER TABLE MATRIX WITH NO INLINE CSS PROPERTIES -->
            <table class="table table-striped table-hover shadow-sm border align-middle">
                <thead class="table-dark">
                    <tr>
                        <th style="width: 80px;">ID</th>
                        <th>Product Name</th>
                        <th>Quantity Sold</th>
                        <th>Selling Price</th>
                        <th>Total Revenue</th>
                        <th>Sales Date</th>
                        <!-- 🎯 SEAMLESS INTEGRATION: Ginamitan ng action-column custom width selector niyo -->
                        <th class="action-column">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($salesRecords as $sales)
                        <tr>
                            <!-- ID CELL -->
                            <td class="text-muted font-family-monospace">
                                #{{ $sales->id }}
                            </td>
                            
                            <!-- PRODUCT RELATIONSHIP LINK ACCENTED TEXT WITH RED BRAND COLOR FOR POS IDENTIFIER -->
                            <td class="font-weight-bold text-danger text-brand-primary">
                                {{ $sales->product->name ?? 'Deleted Product' }}
                            </td>
                            
                            <!-- QUANTITY SOLD -->
                            <td>
                                {{ $sales->quantity }} pcs
                            </td>
                            
                            <!-- UNIT SELLING PRICE -->
                            <td class="font-family-monospace">
                                ₱{{ number_format($sales->selling_price, 2) }}
                            </td>
                            
                            <!-- TOTAL COMPUTED REVENUE FIELD IN REAL-TIME FROM PRE-COMPUTED PROPERTY -->
                            <td class="font-weight-bold text-success font-family-monospace">
                                ₱{{ number_format($sales->total_price ?? ($sales->quantity * $sales->selling_price), 2) }}
                            </td>
                            
                            <!-- TRANSACTION SALES DATE -->
                            <td class="text-secondary small">
                                {{ date('F d, Y', strtotime($sales->sales_date)) }}
                            </td>
                            
                            <!-- UNIFORM ROW ACTION OPERATION TRIGGER PANEL -->
                            <td>
                                <!-- ❌ VOID INVOICE FORM TRANSACTION TRIGGER BUTTON -->
                                <form action="{{ route('sales.destroy', $sales->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to void this invoice record?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger font-weight-bold">
                                        ❌ Void Invoice
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">
                                No registered retail sales invoices discovered matching your parameter filters.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            </div>

        </div>
    </div>

    <!-- 🎯 SEAMLESS INTEGRATION: Ginamitan ng footer-bumper-spacer sheet blocking engine helper wrapper -->
    <div class="footer-bumper-spacer"></div>

</div> <!-- /container -->

@endsection

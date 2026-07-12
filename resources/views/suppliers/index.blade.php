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
        <h1 class="font-weight-bold">Supplier Management</h1>
        <p class="text-muted page-description-text">Manage partner suppliers, contact representatives, and corporate procurement channels.</p>
    </div>


    <!-- =========================================================================
         🎯 FORM CARD: ADD NEW SUPPLIER SECTION (100% Clean)
         ========================================================================= -->
    <div class="card shadow-sm mb-4 border">
        <div class="card-header bg-dark text-white py-3">
            <h5 class="m-0 font-weight-bold">🏢 Add New Supplier</h5>
        </div>
        <div class="card-body bg-light">
            <!-- 🎯 SEAMLESS INTEGRATION: Ginamitan ng form-container class mula sa app.css -->
            <form action="{{ route('suppliers.store') }}" method="POST" class="form-container">
                @csrf 

                <!-- 1. SUPPLIER NAME INPUT -->
                <div class="mb-3">
                    <label class="form-label font-weight-bold">Supplier Name:</label>
                    <input type="text" name="supplier_name" value="{{ old('supplier_name') }}" class="form-control border-dark" placeholder="e.g. Acer Philippines" required>
                </div>

                <!-- 2. CONTACT PERSON INPUT -->
                <div class="mb-3">
                    <label class="form-label font-weight-bold">Contact Person:</label>
                    <input type="text" name="contact_person" value="{{ old('contact_person') }}" class="form-control border-dark" placeholder="e.g. John Doe" required>
                </div>

                <!-- 3. PHONE NUMBER INPUT -->
                <div class="mb-3">
                    <label class="form-label font-weight-bold">Phone:</label>
                    <input type="text" name="phone_number" value="{{ old('phone_number') }}" class="form-control border-dark" placeholder="e.g. 09123456789" required>
                </div>

                <!-- 4. EMAIL INPUT -->
                <div class="mb-3">
                    <label class="form-label font-weight-bold">Email:</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="form-control border-dark" placeholder="e.g. supplier@email.com" required>
                </div>

                <!-- 5. ADDRESS TEXTAREA INPUT -->
                <div class="mb-4">
                    <label class="form-label font-weight-bold">Address:</label>
                    <textarea name="address" rows="3" class="form-control border-dark" placeholder="e.g. Davao City, Philippines" required>{{ old('address') }}</textarea>
                </div>

                <!-- UNIFORM SAVE BUTTON -->
                <button type="submit" class="btn btn-primary px-4 font-weight-bold shadow-sm">
                    💾 Save Supplier
                </button>
            </form>
        </div>
    </div>


    <!-- =========================================================================
         🎯 SUPPLIER LIST TABLE & SEARCH UTILITY CARD SECTION (100% Clean)
         ========================================================================= -->
    <div class="card shadow-sm border mb-5">
        <div class="card-header bg-dark text-white py-3">
            <h5 class="m-0 font-weight-bold">📋 Supplier List</h5>
        </div>
        <div class="card-body">

            <!-- 🔍 SEARCH INPUT WRAPPED CLEAN INSIDE THE CARD LAYER -->
            <!-- 🎯 SEAMLESS INTEGRATION: Ginamitan ng search-container class mula sa app.css -->
            <div class="mb-4 search-container">
                <form action="{{ route('suppliers.index') }}" method="GET" class="input-group">
                    <input type="text" name="search" value="{{ $search }}" class="form-control border-dark" placeholder="Search supplier or contact...">
                    <!-- UNIFORM SEARCH BUTTON -->
                    <button class="btn btn-secondary font-weight-bold" type="submit">
                        🔍 Search
                    </button>
                    @if($search)
                        <a href="{{ route('suppliers.index') }}" class="btn btn-danger font-weight-bold">Clear</a>
                    @endif
                </form>
            </div>

            <div class="table-responsive">
            <!-- MODERN BOOTSTRAP STRIPED HOVER TABLE MATRIX WITH NO INLINE CSS PROPERTIES -->
            <table class="table table-striped table-hover shadow-sm border align-middle">
                <thead class="table-dark">
                    <tr>
                        <th style="width: 80px;">ID</th>
                        <th>Supplier</th>
                        <th>Contact</th>
                        <th>Phone</th>
                        <!-- 🎯 SEAMLESS INTEGRATION: Ginamitan ng action-column custom width selector niyo -->
                        <th class="action-column">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($suppliers as $supplier)
                        <tr>
                            <!-- ID CELL -->
                            <td class="text-muted font-family-monospace">
                                #{{ $supplier->id }}
                            </td>
                            
                            <!-- SUPPLIER NAME TEXT WITH ACCENT TEXT BRAND COLOR -->
                            <td class="font-weight-bold text-primary text-brand-primary">
                                {{ $supplier->supplier_name }}
                            </td>
                            
                            <!-- CONTACT PERSON -->
                            <td>
                                {{ $supplier->contact_person }}
                            </td>
                            
                            <!-- PHONE NUMBER -->
                            <td class="font-family-monospace">
                                {{ $supplier->phone_number }}
                            </td>
                            
                            <!-- UNIFORM ROW ACTION BUTTON MATRIX -->
                            <td>
                                <!-- ✏️ EDIT LINK BUTTON -->
                                <a href="{{ route('suppliers.edit', $supplier->id) }}" class="btn btn-sm btn-outline-primary font-weight-bold me-1">
                                    ✏️ Edit
                                </a>

                                <!-- 🗑️ DELETE METHOD TRIGGER FORM BUTTON -->
                                <form action="{{ route('suppliers.destroy', $supplier->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this supplier?');">
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
                            <td colspan="5" class="text-center text-muted py-4">
                                No registered partner suppliers discovered matching your parameter filters.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            </div>

        </div>
    </div>

    <!-- 🎯 SEAMLESS INTEGRATION: Ginamitan ng footer-bumper-spacer sheet blocking layout class -->
    <div class="footer-bumper-spacer"></div>

</div> <!-- /container -->

@endsection

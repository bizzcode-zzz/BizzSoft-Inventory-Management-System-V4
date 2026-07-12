@extends('layouts.app')

@section('content')

<!-- 🎯 SEAMLESS INTEGRATION: Ginamitan ng page-content selector class mula sa app.css file niyo -->
<div class="container mt-4 page-content">

    <!-- Navigation Link Back to Supplier List Shortcut -->
    <div class="mb-3">
        <a href="{{ route('suppliers.index') }}" class="text-decoration-none font-weight-bold">← Back to Supplier List</a>
    </div>

    <!-- 🛑 REUSABLE ERROR MESSAGES COMPONENT -->
    <x-errors />

    <!-- =========================================================================
         🎯 BUSINESS-CENTRIC HEADING SECTION (100% Clean)
         ========================================================================= -->
    <div class="mb-4">
        <h1 class="font-weight-bold">✏️ Edit Supplier</h1>
        <p class="text-muted page-description-text">Update database profile settings for supplier: <strong class="text-primary">{{ $supplier->supplier_name }}</strong></p>
    </div>

    <!-- =========================================================================
         🎯 FORM CARD: UPDATE SUPPLIER DETAILS SECTION (100% Clean)
         ========================================================================= -->
    <div class="card shadow-sm border mb-5">
        <div class="card-header bg-dark text-white py-3">
            <h5 class="m-0 font-weight-bold">📝 Update Supplier Details</h5>
        </div>
        <div class="card-body bg-light">
            <!-- 🎯 SEAMLESS INTEGRATION: Ginamitan ng form-container max-width selector class mula sa app.css -->
            <form action="{{ route('suppliers.update', $supplier->id) }}" method="POST" class="form-container">
                @csrf 
                @method('PUT')

                <!-- 1. SUPPLIER NAME INPUT -->
                <div class="mb-3">
                    <label class="form-label font-weight-bold">Supplier Name:</label>
                    <input type="text" name="supplier_name" value="{{ old('supplier_name', $supplier->supplier_name) }}" class="form-control border-dark">
                </div>

                <!-- 2. CONTACT PERSON INPUT -->
                <div class="mb-3">
                    <label class="form-label font-weight-bold">Contact Person:</label>
                    <input type="text" name="contact_person" value="{{ old('contact_person', $supplier->contact_person) }}" class="form-control border-dark">
                </div>

                <!-- 3. PHONE NUMBER INPUT -->
                <div class="mb-3">
                    <label class="form-label font-weight-bold">Phone:</label>
                    <input type="text" name="phone_number" value="{{ old('phone_number', $supplier->phone_number) }}" class="form-control border-dark">
                </div>

                <!-- 4. EMAIL INPUT -->
                <div class="mb-3">
                    <label class="form-label font-weight-bold">Email:</label>
                    <input type="email" name="email" value="{{ old('email', $supplier->email) }}" class="form-control border-dark">
                </div>

                <!-- 5. ADDRESS TEXTAREA INPUT -->
                <div class="mb-4">
                    <label class="form-label font-weight-bold">Address:</label>
                    <textarea name="address" rows="3" class="form-control border-dark">{{ old('address', $supplier->address) }}</textarea>
                </div>

                <!-- 🎯 UNIFORM REUSABLE UPDATE BUTTON LINK -->
                <button type="submit" class="btn btn-primary px-4 font-weight-bold shadow-sm">
                    💾 Update Supplier Information
                </button>
            </form>
        </div>
    </div>

    <!-- 🎯 SEAMLESS INTEGRATION: Ginamitan ng footer-bumper-spacer sheet blocking layout class -->
    <div class="footer-bumper-spacer"></div>

</div>

@endsection

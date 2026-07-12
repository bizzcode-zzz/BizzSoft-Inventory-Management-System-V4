@extends('layouts.app')

@section('content')

<!-- 🎯 SEAMLESS INTEGRATION: Ginamitan ng page-content selector class mula sa app.css file niyo -->
<div class="container mt-4 page-content">

    <!-- Navigation Link Back to List Shortcut -->
    <div class="mb-3">
        <a href="{{ route('categories.index') }}" class="text-decoration-none font-weight-bold">← Back to List</a>
    </div>

    <!-- 🛑 REUSABLE ERROR MESSAGES COMPONENT (Retired your old raw errors conditional loops block) -->
    <x-errors />

    <!-- =========================================================================
         🎯 BUSINESS-CENTRIC HEADING SECTION (100% Clean)
         ========================================================================= -->
    <div class="mb-4">
        <h1 class="font-weight-bold">✏️ Edit Category</h1>
        <p class="text-muted page-description-text">Update database matrix parameters for category: <strong class="text-primary">{{ $category->category_name }}</strong></p>
    </div>

    <!-- =========================================================================
         🎯 FORM CARD: UPDATE CATEGORY DETAILS SECTION (100% Clean)
         ========================================================================= -->
    <div class="card shadow-sm border mb-5">
        <div class="card-header bg-dark text-white py-3">
            <h5 class="m-0 font-weight-bold">📝 Update Category Details</h5>
        </div>
        <div class="card-body bg-light">
            <!-- 🎯 SEAMLESS INTEGRATION: Ginamitan ng form-container max-width selector class -->
            <form action="{{ route('categories.update', $category->id) }}" method="POST" class="form-container">
                @csrf 
                @method('PUT')

                <!-- CATEGORY NAME INPUT FIELD CELL -->
                <div class="mb-4">
                    <label class="form-label font-weight-bold">Category Name:</label>
                    <input type="text" name="category_name" value="{{ old('category_name', $category->category_name) }}" class="form-control border-dark" placeholder="e.g. Electronics" required>
                </div>

                <!-- 🎯 UNIFORM RESUABLE UPDATE REFACTOR BUTTON LINKS -->
                <button type="submit" class="btn btn-primary px-4 font-weight-bold shadow-sm">
                    💾 Update Category Information
                </button>
            </form>
        </div>
    </div>

    <!-- 🎯 SEAMLESS INTEGRATION: Ginamitan ng footer-bumper-spacer sheet blocking layout class -->
    <div class="footer-bumper-spacer"></div>

</div>

@endsection

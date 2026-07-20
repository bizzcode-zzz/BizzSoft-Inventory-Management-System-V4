@extends('layouts.app')

@section('content')

<!-- 🎯 SEAMLESS EXTERNAL: Ginamitan ng page-content selector mula sa app.css asset sheet niyo -->
<div class="container mt-4 page-content">

    <!-- Back to Product List Shortcut Link -->
    <div class="mb-3">
        <a href="{{ route('products.index') }}" class="text-decoration-none font-weight-bold">← Back to Product List</a>
    </div>

    <!-- 🛑 REUSABLE ERROR MESSAGES COMPONENT -->
    <x-errors />

    <!-- =========================================================================
         🎯 BUSINESS-CENTRIC HEADING SECTION (100% Clean)
         ========================================================================= -->
    <div class="mb-4">
        <h1 class="font-weight-bold">✏️ Edit Product</h1>
        <p class="text-muted page-description-text">Update information for product: <strong class="text-primary">{{ $product->name }}</strong></p>
    </div>

    <!-- =========================================================================
         🎯 FORM CARD: UPDATE PRODUCT DETAILS SECTION (100% Clean)
         ========================================================================= -->
    <div class="card shadow-sm border mb-5">
        <div class="card-header bg-dark text-white py-3">
            <h5 class="m-0 font-weight-bold">📝 Update Product Details</h5>
        </div>
        <div class="card-body bg-light">
            <!-- 🎯 SEAMLESS EXTERNAL: Ginamitan ng form-container modifier class mula sa app.css -->
            <form action="{{ route('products.update', $product->id) }}" method="POST" class="form-container">
                @csrf
                @method('PUT')

                <!-- PRODUCT NAME INPUT -->
                <div class="mb-3">
                    <label class="form-label font-weight-bold">Product Name:</label>
                    <input type="text" name="name" value="{{ old('name', $product->name) }}" class="form-control border-dark" required>
                </div>

                <!-- DYNAMIC CATEGORY SELECTION DROPDOWN -->
                <div class="mb-3">
                    <label class="form-label font-weight-bold">Category:</label>
                    <select name="category_id" class="form-select border-dark" required>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @selected(old('category_id', $product->category_id) == $category->id)>
                                {{ $category->category_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- UNIT RETAIL PRICE INPUT -->
                <div class="mb-3">
                    <label class="form-label font-weight-bold">Price:</label>
                    <div class="input-group">
                        <span class="input-group-text border-dark bg-secondary text-white">₱</span>
                        <input type="number" step="0.01" name="price" value="{{ old('price', $product->price) }}" class="form-control border-dark" required>
                    </div>
                </div>

                <!-- ACTIVE STOCK INVENTORY COUNTER INPUT -->
                <div class="mb-3">
                    <label class="form-label font-weight-bold">Stock Count:</label>
                    <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" class="form-control border-dark" required>
                </div>

                <!-- REORDER POINT THRESHOLD LIMIT INPUT -->
                <div class="mb-4">
                    <label class="form-label font-weight-bold">Reorder Level / Threshold:</label>
                    <input type="number" name="reorder_level" value="{{ old('reorder_level', $product->reorder_level) }}" class="form-control border-dark" required>
                    <small class="text-muted">Dynamic threshold value used for automated low stock dashboard alerts.</small>
                </div>

                <!-- UNIFORM REUSABLE UPDATE UPDATE BUTTON -->
                <button type="submit" class="btn btn-primary px-4 font-weight-bold shadow-sm">
                    💾 Update Product Information
                </button>
            </form>
        </div>
    </div>

    <!-- 🎯 SEAMLESS EXTERNAL: Ginamitan ng footer-bumper-spacer sheet rules blocking engine wrapper -->
    <div class="footer-bumper-spacer"></div>

</div>

@endsection

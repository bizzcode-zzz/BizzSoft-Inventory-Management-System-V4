@extends('layouts.app')

@section('content')

<!-- 🎯 SEAMLESS INTEGRATION: Ginamitan ng page-content selector mula sa app.css asset niyo -->
<div class="container mt-4 page-content">

    <!-- Go to Product Management Shortcut Link -->
    <div class="mb-3">
        <a href="{{ route('products.index') }}" class="text-decoration-none font-weight-bold">← Go to Product Management</a>
    </div>

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
        <h1 class="font-weight-bold">📂 Category Management</h1>
        <p class="text-muted page-description-text">Manage all business classification categories available in your inventory.</p>
    </div>


    <!-- =========================================================================
         🎯 FORM CARD: ADD NEW CATEGORY SECTION (100% Clean)
         ========================================================================= -->
    <div class="card shadow-sm mb-4 border">
        <div class="card-header bg-dark text-white py-3">
            <h5 class="m-0 font-weight-bold">📂 Add New Category</h5>
        </div>
        <div class="card-body bg-light">
            <!-- 🎯 SEAMLESS INTEGRATION: Ginamitan ng form-container class mula sa app.css -->
            <form action="{{ route('categories.store') }}" method="POST" class="form-container">
                @csrf 

                <!-- CATEGORY NAME INPUT -->
                <div class="mb-3">
                    <label class="form-label font-weight-bold">Category Name:</label>
                    <input type="text" name="category_name" value="{{ old('category_name') }}" class="form-control border-dark" placeholder="e.g. Electronics" required>
                </div>

                <!-- UNIFORM SAVE BUTTON -->
                <button type="submit" class="btn btn-primary px-4 font-weight-bold shadow-sm">
                    💾 Save Category
                </button>
            </form>
        </div>
    </div>


    <!-- =========================================================================
         🎯 CATEGORY LIST TABLE CARD SECTION (100% Clean)
         ========================================================================= -->
    <div class="card shadow-sm border mb-5">
        <div class="card-header bg-dark text-white py-3">
            <h5 class="m-0 font-weight-bold">📋 Category List</h5>
        </div>
        <div class="card-body">


        <div class="table-responsive">
            <!-- 🎯 THE RETIREMENT OF BORDER="1" - ULTRA-LUXURY STRIPED HOVER TABLE MATRIX -->
            <table class="table table-striped table-hover shadow-sm border align-middle">
                <thead class="table-dark">
                    <tr>
                        <th style="width: 80px;">ID</th>
                        <th>Category Name</th>
                        <!-- 🎯 SEAMLESS INTEGRATION: Ginamitan ng action-column custom width selector niyo -->
                        <th class="action-column">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($categories as $category)
                        <tr>
                            <!-- ID CELL -->
                            <td class="text-muted font-family-monospace">
                                #{{ $category->id }}
                            </td>
                            
                            <!-- CATEGORY NAME TEXT WITH ACCENT TEXT BRAND COLOR -->
                            <td class="font-weight-bold text-primary text-brand-primary">
                                {{ $category->category_name }}
                            </td>
                            
                            <!-- UNIFORM ROW ACTION OPERATION TRIGGERS -->
                            <td>
                                <!-- ✏️ EDIT LINK BUTTON -->
                                <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-outline-primary font-weight-bold me-1">
                                    ✏️ Edit
                                </a>

                                <!-- 🗑️ DELETE METHOD OPERATION FORM TRIGGER -->
                                <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="d-inline" onsubmit="return confirm('⚠️ Warning: Deleting this category will also automatically delete all products under it. Do you want to proceed?');">
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
                            <td colspan="3" class="text-center text-muted py-4">
                                No registered categories discovered inside the database storage tracker.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

</div>

        </div>
    </div>

    <!-- 🎯 SEAMLESS INTEGRATION: Ginamitan ng footer-bumper-spacer sheet blocking element wrapper -->
    <div class="footer-bumper-spacer"></div>

</div>

@endsection

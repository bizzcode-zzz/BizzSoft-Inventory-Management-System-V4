@extends('layouts.app')

@section('content')

<div class="container mt-4" style="color: black;">
    <h2 class="mb-4">Management Reports</h2>
    <p class="text-muted">Select a report type below to view the real-time system ledgers:</p>

    <!-- 📊 BUTTON MENUS GRID CONTAINER -->
    <div class="d-flex flex-wrap gap-2 mb-5">
        
        <!-- 1. SALES REPORT BUTTON -->
        <a href="{{ route('reports.sales') }}" class="btn btn-primary px-4 py-2 font-weight-bold">
            💰 Sales Report
        </a>

        <!-- 2. PURCHASE REPORT BUTTON -->
        <a href="{{ route('reports.purchases') }}" class="btn btn-secondary px-4 py-2 font-weight-bold">
            📦 Purchase Report
        </a>

        <!-- 3. INVENTORY REPORT BUTTON -->
        <a href="{{ route('reports.inventory') }}" class="btn btn-success px-4 py-2 font-weight-bold">
            🗂️ Inventory Report
        </a>

        <!-- 4. LOW STOCK REPORT BUTTON -->
        <a href="{{ route('reports.low_stock') }}" class="btn btn-danger px-4 py-2 font-weight-bold">
            ⚠️ Low Stock Report
        </a>

    </div>
</div>

@endsection

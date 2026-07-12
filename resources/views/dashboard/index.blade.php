@extends('layouts.app')

@section('content')

<!-- 🎯 SEAMLESS INTEGRATION: Ginamitan ng page-content class selector mula sa app.css asset niyo -->
<div class="container mt-4 page-content">

    <!-- BUSINESS-CENTRIC LIGHT MODE DASHBOARD HEADING -->
    <div class="mb-4">
        <h2 class="font-weight-bold text-dark">📊 System Dashboard</h2>
        <p class="text-muted page-description-text">Real-time business insights, inventory metrics, and transaction monitoring summary.</p>
    </div>

    <!-- 📊 THE LUXURY 6-COUNTER CARDS ROW GRID (LIGHT MODE MATRIX) -->
    <div class="row g-3 mb-4">

        <!-- CARD 1: PRODUCTS -->
        <div class="col-6 col-md-4 col-lg-2">
            <div class="card dashboard-stat-card border shadow-sm bg-primary text-white text-center">
                <div class="card-body py-4">
                    <div class="stat-card-icon mb-2">📦</div>
                    <div class="stat-card-title text-white-50 text-nowrap">Products</div>
                    <h3 class="stat-card-number fw-bold m-0 mt-2">{{ $totalProducts }}</h3>
                </div>
            </div>
        </div>

        <!-- CARD 2: CATEGORIES -->
        <div class="col-6 col-md-4 col-lg-2">
            <div class="card dashboard-stat-card border shadow-sm text-center bg-white">
                <div class="card-body py-4">
                    <div class="stat-card-icon mb-2">📂</div>
                    <div class="stat-card-title text-nowrap">Categories</div>
                    <h3 class="stat-card-number fw-bold m-0 mt-2 text-info">{{ $totalCategories }}</h3>
                </div>
            </div>
        </div>

        <!-- CARD 3: SUPPLIERS -->
        <div class="col-6 col-md-4 col-lg-2">
            <div class="card dashboard-stat-card border shadow-sm text-center bg-white">
                <div class="card-body py-4">
                    <div class="stat-card-icon mb-2">🏢</div>
                    <div class="stat-card-title text-nowrap">Suppliers</div>
                    <h3 class="stat-card-number fw-bold m-0 mt-2 text-warning">{{ $totalSuppliers }}</h3>
                </div>
            </div>
        </div>

        <!-- CARD 4: PURCHASES -->
        <div class="col-6 col-md-4 col-lg-2">
            <div class="card dashboard-stat-card border shadow-sm text-center bg-white">
                <div class="card-body py-4">
                    <div class="stat-card-icon mb-2">🛒</div>
                    <div class="stat-card-title text-nowrap">Purchases</div>
                    <h3 class="stat-card-number fw-bold m-0 mt-2 text-success">{{ $totalPurchases }}</h3>
                </div>
            </div>
        </div>

        <!-- CARD 5: SALES -->
        <div class="col-6 col-md-4 col-lg-2">
            <div class="card dashboard-stat-card border shadow-sm text-center bg-white">
                <div class="card-body py-4">
                    <!-- ✨ KEY FIX: Idinagdag ang saktong 💰 emoji at inayos ang spacing elements layout -->
                    <div class="stat-card-icon mb-2">💰</div>
                    <div class="stat-card-title text-nowrap">Sales</div>
                    <h3 class="stat-card-number fw-bold m-0 mt-2 text-primary">{{ $totalSales }}</h3>
                </div>
            </div>
        </div>

        <!-- CARD 6: LOW STOCK PRODUCTS -->
        <div class="col-6 col-md-4 col-lg-2">
            <div class="card dashboard-stat-card border shadow-sm text-center bg-white warning-border-glow">
                <div class="card-body py-4">
                    <div class="stat-card-icon mb-2">⚠️</div>
                    <div class="stat-card-title text-nowrap">Low Stocks</div>
                    <h3 class="stat-card-number fw-bold m-0 mt-2 text-danger">{{ $totalLowStockProducts }}</h3>
                </div>
            </div>
        </div>
        
    </div> <!-- /row -->

    <!-- =========================================================================
         🏛️ MODERN TWIN FEED LOGS SECTION (LIGHT MODE THEME)
         ========================================================================= -->
    <div class="row g-4">
        <!-- LEFT COLUMN: RECENT SALES ACTIVITY -->
        <div class="col-md-6">
            <div class="card shadow-sm border mb-4 h-100 bg-white">
                <div class="card-header bg-dark text-white py-3 border-0 d-flex justify-content-between align-items-center">
                    <h5 class="m-0 font-weight-bold">🆕 Recent Sales Activity</h5>
                    <span class="badge bg-primary rounded-pill small">POS Feed</span>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        @forelse($recentSales as $sale)
                            <div class="list-group-item bg-white text-dark py-3 d-flex justify-content-between align-items-center hover-feed-item">
                                <div>
                                    <strong class="text-brand-primary text-primary">{{ $sale->product->name ?? 'Deleted Product' }}</strong>
                                    <div class="small text-muted mt-1">Transaction Completed</div>
                                </div>
                                <span class="badge bg-light text-dark border px-3 py-2 font-family-monospace">Qty: {{ $sale->quantity }}</span>
                            </div>
                        @empty
                            <div class="p-4 text-center text-muted">No sales items logged today.</div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <!-- RIGHT COLUMN: RECENT PURCHASES ACTIVITY -->
        <div class="col-md-6">
            <div class="card shadow-sm border mb-4 h-100 bg-white">
                <div class="card-header bg-dark text-white py-3 border-0 d-flex justify-content-between align-items-center">
                    <h5 class="m-0 font-weight-bold">📦 Recent Stock Purchases</h5>
                    <span class="badge bg-success rounded-pill small">Procurement</span>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        @forelse($recentPurchases as $purchase)
                            <div class="list-group-item bg-white text-dark py-3 d-flex justify-content-between align-items-center hover-feed-item">
                                <div>
                                    <strong class="text-brand-primary text-success">{{ $purchase->product->name ?? 'Deleted Product' }}</strong>
                                    <div class="small text-muted mt-1">Inventory Restocked</div>
                                </div>
                                <span class="badge bg-light text-dark border px-3 py-2 font-family-monospace">Qty: {{ $purchase->quantity }}</span>
                            </div>
                        @empty
                            <div class="p-4 text-center text-muted">No procurement items logged today.</div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 🎯 SEAMLESS INTEGRATION: Spacer block laban sa sticky footer overlay -->
    <div class="footer-bumper-spacer"></div>

</div> <!-- /container -->

@endsection

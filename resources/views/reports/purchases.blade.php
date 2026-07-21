@extends('layouts.app')

@section('content')


    <h2 class="mb-0">📋 Purchase Report Ledger</h2>

    <div>

        <div class="container mt-4" style="color: black;">
    <div class="mb-3">
        <a href="{{ route('reports.index') }}" class="text-decoration-none">← Back to Reports</a>
    </div>
    <div class="d-flex justify-content-between align-items-center mb-4">

        <a
    href="{{ route('reports.purchases.print', request()->query()) }}"
    target="_blank"
    class="btn btn-primary">

    🖨️ Print

</a>

    </div>

</div>




    <form method="GET" action="{{ route('reports.purchases') }}" class="row g-3 mb-4">

    <div class="col-md-4">
        <label class="form-label">From</label>
        <input
            type="date"
            name="from"
            class="form-control"
            value="{{ request('from') }}">
    </div>

    <div class="col-md-4">
        <label class="form-label">To</label>
        <input
            type="date"
            name="to"
            class="form-control"
            value="{{ request('to') }}">
    </div>

    <div class="col-md-4 d-flex align-items-end">
        <button class="btn btn-primary w-100">
            Filter Report
        </button>
    </div>

</form>




    <div class="row mb-4">

    <div class="col-md-4">
        <div class="card shadow-sm border-success">
            <div class="card-body">
                <h6 class="text-success">💰 Total Purchase Cost</h6>
                <h4>₱{{ number_format($totalPurchaseCost, 2) }}</h4>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow-sm border-primary">
            <div class="card-body">
                <h6 class="text-primary">📦 Total Quantity Purchased</h6>
                <h4>{{ $totalQuantityPurchased }} pcs</h4>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow-sm border-dark">
            <div class="card-body">
                <h6 class="text-dark">🧾 Transactions</h6>
                <h4>{{ $totalTransactions }}</h4>
            </div>
        </div>
    </div>

</div>
    
    <table class="table table-striped table-hover shadow-sm border">
        <thead class="table-dark">
            <tr>
                <th>Date Purchased</th>
                <th>Product</th>
                <th>Supplier</th>
                <th>Quantity</th>
                <th>Unit Cost</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach($purchases as $purchase)
            <tr>
                    <td>{{ $purchase->created_at->format('M d, Y h:i A') }}</td>

                <td class="font-weight-bold">
                        {{ $purchase->product->name ?? 'Deleted Product' }}
                </td>

                <td class="text-muted">
                         {{ $purchase->supplier->supplier_name ?? 'Deleted Supplier' }}
                </td>

                     <td>{{ $purchase->quantity }} pcs</td>

                <td class="font-monospace">
                        ₱{{ number_format($purchase->cost_price, 2) }}
                </td>
                <td class="font-monospace fw-bold">
                        ₱{{ number_format($purchase->quantity * $purchase->cost_price, 2) }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-3">
    {{ $purchases->links() }}
</div>
</div>
@endsection

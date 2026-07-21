@extends('layouts.app')


@section('content')

<div class="container mt-4" style="color: black;">


 
    
   

 
    <div class="d-flex justify-content-between align-items-center mb-4">

    <h2 class="mb-0">📋 Sales Report Ledger</h2>

    <div>

        <a href="{{ route('dashboard.index') }}" class="btn btn-secondary">
            ← Back
        </a>

        <a
    href="{{ route('reports.sales.print', request()->query()) }}"
    target="_blank"
    class="btn btn-primary">

    🖨️ Print

</a>

    </div>

</div>


 


    <div class="card shadow-sm mb-4">

    <div class="card-header">
        <strong>Filter Sales Report</strong>
    </div>

    <div class="card-body">

        <form action="{{ route('reports.sales') }}" method="GET">

            <div class="row">

                <div class="col-md-4">

                    <label class="form-label">From</label>

                    <input
                        type="date"
                        name="from"
                        class="form-control"
                        value="{{ request('from') }}"
                    >

                </div>

                <div class="col-md-4">

                    <label class="form-label">To</label>

                    <input
                        type="date"
                        name="to"
                        class="form-control"
                        value="{{ request('to') }}"
                    >

                </div>

                <div class="col-md-4 d-flex align-items-end">

                    <button
                        type="submit"
                        class="btn btn-primary me-2">

                        Filter

                    </button>

                    <a
                        href="{{ route('reports.sales') }}"
                        class="btn btn-secondary">

                        Reset

                    </a>

                </div>

            </div>

        </form>

    </div>

</div>




<div class="row mb-4">

    <div class="col-md-4">

        <div class="card text-white bg-success shadow-sm">

            <div class="card-body">

                <h6 class="card-title">💰 Total Sales</h6>

                <h3>₱{{ number_format($totalSales, 2) }}</h3>

            </div>

        </div>

    </div>

    <div class="col-md-4">

        <div class="card text-white bg-primary shadow-sm">

            <div class="card-body">

                <h6 class="card-title">📦 Total Quantity</h6>

                <h3>{{ $totalQuantity }} pcs</h3>

            </div>

        </div>

    </div>

    <div class="col-md-4">

        <div class="card text-white bg-dark shadow-sm">

            <div class="card-body">

                <h6 class="card-title">🧾 Transactions</h6>

                <h3>{{ $totalTransactions }}</h3>

            </div>

        </div>

    </div>

</div>





    <!-- 🏛️ ✨ THE FINAL V4 LUXURY BOOTSTRAP TABLE CONFIGURATION -->
    <table class="table table-striped table-hover shadow-sm border">
        
        <!-- 🖤 SOLID BLACK HEADER ROW -->
        <thead class="table-dark">
            <tr>
                <th>Date Sold</th>
                <th>Product</th>
                <th>Quantity</th>
                <th>Selling Price</th>
                <th>Amount</th>
            </tr>
        </thead>
        
        <tbody>
            @foreach($sales as $sale)
                <tr>
                    <td>
                    {{ $sale->created_at->format('M d, Y h:i A') }}
                    </td>
                    <td class="font-weight-bold">
                        {{ $sale->product->name ?? 'Deleted Product' }}
                    </td>
                    <td>
                        {{ $sale->quantity }} pcs
                    </td>
                    <td class="font-monospace">
                        ₱{{ number_format($sale->selling_price, 2) }}
                    </td>
                    <td>₱{{ number_format($sale->line_total, 2) }}
                    </td>
                </tr>
            @endforeach
        </tbody>

    </table>
    <div class="pagination-wrapper mt-3">
    {{ $sales->links() }}
</div>

</div>

@endsection
 
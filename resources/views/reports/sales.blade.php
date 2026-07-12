@extends('layouts.app')

@section('content')

<div class="container mt-4" style="color: black;">
    
    <h2 class="mb-4">📋 Sales Report Ledger</h2>

    <!-- 🏛️ ✨ THE FINAL V4 LUXURY BOOTSTRAP TABLE CONFIGURATION -->
    <table class="table table-striped table-hover shadow-sm border">
        
        <!-- 🖤 SOLID BLACK HEADER ROW -->
        <thead class="table-dark">
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Selling Price</th>
            </tr>
        </thead>
        
        <tbody>
            @foreach($sales as $sale)
                <tr>
                    <td class="font-weight-bold">
                        {{ $sale->product->name ?? 'Deleted Product' }}
                    </td>
                    <td>
                        {{ $sale->quantity }} pcs
                    </td>
                    <td class="font-monospace">
                        ₱{{ number_format($sale->selling_price, 2) }}
                    </td>
                </tr>
            @endforeach
        </tbody>

    </table>

</div>

@endsection

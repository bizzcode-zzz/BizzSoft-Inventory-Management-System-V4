<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;   // ⚠️ I-import ang lahat ng Models mo para kilalanin ng computer
use App\Models\Category;
use App\Models\Supplier;
use App\Models\Sales;
use App\Models\Purchase;
use Illuminate\Support\Facades\DB; // ⚠️ I-import ang DB facade para sa advanced sum computation

class DashboardController extends Controller
{
    public function index()
    {

       if (! auth()->user()->hasPermission('dashboard.view')) {
        abort(403);
    }
    
        // 📊 1. KUKUHA NG REAL-TIME COUNT SA BAWAT TABLE:
        $totalProducts   = Product::count();
        $totalCategories = Category::count();
        $totalSuppliers  = Supplier::count();
        $totalSales = Sales::count();
        $totalPurchases = Purchase::count();

        // 💰 2. ADVANCED REVENUE COMPUTATION:
        // Gagamit tayo ng native SQL aggregate sum para i-multiply ang quantity at selling_price ng lahat ng benta niyo!
        $totalRevenue = Sales::sum(DB::raw('quantity * selling_price'));
        // 🏛️ DYNAMIC LOW STOCK CHECKER: Binibilang kung ilang items ang umabot na sa kanilang threshold
        $totalLowStockProducts = Product::whereColumn('stock', '<=', 'reorder_level')->count();
        // 🏛️ Kukunin ang 5 pinakabagong benta galing sa code mo bro!
        $recentSales = Sales::with('product')
            ->latest()
            ->take(5)
            ->get();
        // 🏛️  Kukunin naman natin ang 5 PINAKABAGONG BILI SA SUPPLIER (Newest to Oldest)
        // Gumagamit ng with(['product', 'supplier']) para sabay hugutin ang pangalan ng item at supplier mo!
        $recentPurchases = Purchase::with(['product', 'supplier'])
            ->latest()
            ->take(5)
            ->get();

        // 🏛️ 3. IPAPASA NATIN ANG LAHAT NG ANALYTICS VARIABLES SA BLADE VIEW:
        return view('dashboard.index', compact(
            'totalProducts', 
            'totalCategories', 
            'totalSuppliers', 
            'totalSales',
            'totalPurchases',
            'totalRevenue',
            'totalLowStockProducts',
            'recentSales',
            'recentPurchases'
        ));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sales;
use App\Models\Purchase;
use App\Models\Product; // ⚠️ I-import ito para sa Inventory at Low Stock checks

class ReportsController extends Controller
{
    /**
     * 📊 Reports Main Landing Menu (index.blade.php)
     */
    public function index()
    {
        return view('reports.index');
    }

    /**
     * 1. (sales.blade.php)
     */
    public function sales()
    {
        $sales = Sales::with('product')->latest()->get();
        return view('reports.sales', compact('sales'));
    }

    /**
     * 2.Purchase Report (purchases.blade.php)
     */
    public function purchases()
    {
        $purchases = Purchase::with(['product', 'supplier'])->latest()->get();
        return view('reports.purchases', compact('purchases'));
    }

    /**
     *  3. Inventory Report (inventory.blade.php)
     */
    public function inventory()
    {
        // Kukunin ang lahat ng produkto kasama ang kategorya nito
        $products = Product::with('category')->get();
        return view('reports.inventory', compact('products'));
    }

    /**
     * 4.  Low Stock Report (lowstock.blade.php)
     */
    public function lowstock()
    {
        // Gagamit ng whereColumn para masala lang ang mga umabot sa threshold limit nila
        $lowStockProducts = Product::with('category')
            ->whereColumn('stock', '<=', 'reorder_level')
            ->get();
            
        return view('reports.lowstock', compact('lowStockProducts'));
    }
}

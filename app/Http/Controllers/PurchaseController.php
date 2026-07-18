<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Purchase;
use App\Models\Product;
use App\Models\Supplier;
use App\Http\Requests\PurchaseRequest; // ⚠️ Import ang ginawa nating request validation file
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request) 
    {
        
if (! auth()->user()->hasPermission('purchases.view')) {
    abort(403);
}


      // Kukuha ng tinype ng user sa search input field
        $search = $request->input('search');

         // Sasalain ang database gamit ang SQL LIKE query kung may hinahanap ang user
        $purchases = Purchase::with(['product', 'supplier'])
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('quantity', 'LIKE', "%{$search}%")
                      ->orWhere('cost_price', 'LIKE', "%{$search}%");
                });
            })->get();

        // Kukunin natin ang lahat ng Products at Suppliers para maging DROPDOWN OPTIONS sa porma
        $products = Product::all();
        $suppliers = Supplier::all();

        // Ipapasa natin ang mga kailangang variables sa views folder
        return view('purchases.index', compact('purchases', 'products', 'suppliers', 'search'));
    }

     

    /**
     * Store a newly created resource in storage.
     */
     public function store(PurchaseRequest $request)
{

if (! auth()->user()->hasPermission('purchases.create')) {
    abort(403);
}
 
DB::transaction(function () use ($request) {

    Purchase::create($request->validated());

    $product = Product::find($request->product_id);

    if ($product) {
        $product->stock += $request->quantity;
        $product->save();
    }

});


return redirect()->route('purchases.index')
    ->with('success', 'Purchase transaction saved successfully!');
}
    


        /**
     * Remove the specified resource from storage.
     */
    public function destroy(Purchase $purchase)
    {

    if (! auth()->user()->hasPermission('purchases.delete')) {
    abort(403);

    
}
        DB::transaction(function () use ($purchase) {
        // 1. Hanapin muna kung anong produkto ang kasali sa transaksyong ito
        $product = Product::find($purchase->product_id);

        if ($product) {
            // 2. ✨ AUTOMATIC STOCK REVERSION:
            // Ibabawas natin sa stock ng produkto ang dami ng binili sa transaksyong ito.
            // (Kalkulasyon sa background: 120 - 20 = 100)
            $product->stock -= $purchase->quantity;
            
            // 3. I-save ang pagbabago sa products table
            $product->save();
        }

        // 4. Saka natin tuluyang buburahin ang linya ng transaksyon sa purchases table
        $purchase->delete();
    });
        return redirect()->route('purchases.index')->with('success', 'Purchase record deleted and product stock automatically adjusted!');
    }

}


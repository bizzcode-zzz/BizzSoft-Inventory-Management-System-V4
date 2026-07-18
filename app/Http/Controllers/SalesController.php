<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sales;
use App\Models\Product;
use App\Http\Requests\SalesRequest; // ⚠️ I-import ang request file
use Illuminate\Support\Facades\DB; // ✨ para sa DB::transaction(function ()


class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

    if (! auth()->user()->hasPermission('sales.view')) {
    abort(403);
}

        $search = $request->input('search');

        // Advanced logical grouping ($q) para sa Search bar ng sales transaction
        $salesRecords = Sales::with('product')
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('quantity', 'LIKE', "%{$search}%")
                      ->orWhere('selling_price', 'LIKE', "%{$search}%");
                });
            })->get();

        // Kukunin natin ang lahat ng Products para maging options sa HTML dropdown box
        $products = Product::all();

        return view('sales.index', compact('salesRecords', 'products', 'search'));
    }

    /**
     * Store a newly created resource in storage.
     */
        public function store(SalesRequest $request)
    {

    if (! auth()->user()->hasPermission('sales.create')) {
    abort(403);
}


        // 🏛️ 1. Hanapin muna si product sa database para makilala siya ng computer
        $product = Product::find($request->product_id);

        // 🏛️ 2. Ngayong kilala na si $product, pwede na natin siyang i-tsek kung kulang ang stock
        if ($product && $product->stock < $request->quantity) {
            // Kung kulang, ibabalik ang user sa form at maglalabas ng pulang error box gamit ang <x-error /> niyo
            return redirect()->back()
                ->withErrors(['quantity' => 'Insufficient stock! Only ' . $product->stock . ' units left in the inventory.'])
                ->withInput();
        }

        // Binabalot natin sa closure function para kapag may nag-error sa loob, sabay silang mabubura o hindi itutuloy (Rollback)
        DB::transaction(function () use ($request, $product) {
            
        // 🏛️ 3. Kung sapat naman ang stock at lumusot sa harang, i-save na ang benta sa sales table
        Sales::create($request->validated());

        // 🏛️ 4. Babawasan na natin ang stock dahil ligtas at na-save na ang transaksyon
        if ($product) {
            $product->stock -= $request->quantity;
            $product->save();
        }
        });

        return redirect()->route('sales.index')->with('success', 'Sales transaction saved and product stock updated!');
    }

        /**
     * Remove the specified resource from storage.
     */
    // ⚠️ DAPAT SINGULAR: Pinalitan ang Sales $sales naging Sales $sale
    public function destroy(Sales $sale)
    {


    if (! auth()->user()->hasPermission('sales.delete')) {
    abort(403);
}
    DB::transaction(function () use ($sale) {
        // 1. Hanapin kung anong produkto ang kasali sa transaksyong ito gamit ang singular $sale
        $product = Product::find($sale->product_id);

        if ($product) {
            // 2. ✨ AUTOMATIC STOCK REVERSION:
            // Idadagdag natin pabalik ang stock sa produkto base sa benta na ni-void
            $product->stock += $sale->quantity;
            $product->save();
        }

        // 3. Saka tuluyang buburahin ang transaksyon record gamit ang singular $sale
        $sale->delete();
    });
        return redirect()->route('sales.index')->with('success', 'Sales record deleted and product stock automatically adjusted!');
    }

}

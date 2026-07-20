<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Services\ActivityLogger;
use App\Services\AuditTrailService;

class ProductController extends Controller
{
    
     public function index(Request $request)
{
    if (! auth()->user()->hasPermission('products.view')) {
        abort(403);
    }

    if ($request->filled('search')) {
        $search = $request->search;
        $products = Product::where('name', 'LIKE', '%' . $search . '%')->get();
    } else {
        $products = Product::with('category')->get();
    }

    $categories = Category::all();

    return view('products.index', compact('products', 'categories'));
}
 


public function store(ProductRequest $request)
{
    if (! auth()->user()->hasPermission('products.create')) {
        abort(403);
    }

    Product::create($request->validated());

// PARA SA ACTIVITY LOG: Tanggalin ito kung wala pa kayong Activity Log module para maiwasan ang Error 500.
    ActivityLogger::log(
    'Created',
    'Product',
    'Created product: ' . $request->name
);

    return redirect('/products');
}







   public function edit(Product $product)
{
    if (! auth()->user()->hasPermission('products.edit')) {
    abort(403);
}
    $categories = Category::all();
    return view('products.edit', compact('product', 'categories'));
}



public function update(ProductRequest $request, Product $product)
{
    if (! auth()->user()->hasPermission('products.edit')) {
        abort(403);
    }
    // Kasama to sa activity log oldproduct 
    $oldProduct = $product->replicate();
 

  $product->update($request->validated());

     
// ENTRY PARA SA ACTIVITY LOG ang ginamit dito ay auditTrailService.php
AuditTrailService::logUpdate(
    $oldProduct,
    $product,
    'Product',
    [
        'name' => 'Name',
        'price' => 'Price',
        'stock' => 'Stock',
        'reorder_level' => 'Reorder Level',
    ],
    'name'
);
// CLOSED PARA SA ACTIVITY LOG

    return redirect('/products');
}





    public function destroy(Product $product)
{
    
if (! auth()->user()->hasPermission('products.delete')) {
    abort(403);
}
    $product->delete();

    return redirect('/products');
}

}

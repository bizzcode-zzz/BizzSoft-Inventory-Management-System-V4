<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Models\Category;

class ProductController extends Controller
{
    
     public function index(Request $request)
{
    //dd($request->all()); <-- mao ni ang gamiton unsaon pag test ang CRUD
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
  

    Product::create($request->validated());

    return redirect('/products');
}

   public function edit(Product $product)
{
    $categories = Category::all();
    return view('products.edit', compact('product', 'categories'));
}

    public function update(ProductRequest $request, Product $product)
{

    $product->update($request->validated());


    return redirect('/products');
}

    public function destroy(Product $product)
{
    $product->delete();

    return redirect('/products');
}

}

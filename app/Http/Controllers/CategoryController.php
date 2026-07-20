<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category; // ⚠️ I-import ang Category Model
use App\Http\Requests\CategoryRequest; 
use App\Services\ActivityLogger;
use App\Services\AuditTrailService;
class CategoryController extends Controller
{
    // Ipakita ang listahan ng mga kategorya at ang save form
    // Kasama na dito ang search
    public function index(Request $request) // ⚠️ Siguraduhing may Request $request sa loob ng panaklong
{

if (! auth()->user()->hasPermission('categories.view')) {
    abort(403);
}

    // Kukuha ng tinype ng user sa search input field
    $search = $request->input('search');

    // Sasalain ang database gamit ang SQL LIKE query kung may hinahanap ang user
    $categories = Category::when($search, function ($query, $search) {
        return $query->where('category_name', 'LIKE', "%{$search}%");
    })->get();

    // Ipapasa natin ang $categories at ang huling hinanap na text ($search) sa view
    return view('categories.index', compact('categories', 'search'));
}


    // I-save ang bagong kategorya
    public function store(CategoryRequest $request)
    {

    if (! auth()->user()->hasPermission('categories.create')) {
    abort(403);
}


        $category = Category::create($request->validated());


// PARA SA ACTIVITY LOG: Tanggalin ito kung wala pa kayong Activity Log module para maiwasan ang Error 500.
        ActivityLogger::log(
    'Created',
    'Category',
    "Created category: {$category->category_name}"
);

        return redirect()->route('categories.index')->with('success', 'Category saved successfully!');
    }

   

    // Ipakita ang edit form
    public function edit(Category $category)
{

    if (! auth()->user()->hasPermission('categories.edit')) {
    abort(403);
}

    return view('categories.edit', compact('category'));
}




    // I-save ang in-edit na kategorya
public function update(CategoryRequest $request, Category $category)
{
    if (! auth()->user()->hasPermission('categories.edit')) {
        abort(403);
    }

        // Kasama to sa activity log oldproduct 
    $oldCategory = $category->replicate();

    $category->update($request->validated());

// ENTRY PARA SA ACTIVITY LOG gamit dito ay auditTralService.php
    AuditTrailService::logUpdate(
    $oldCategory,
    $category,
    'Category',
    [
        'category_name' => 'Category Name',
    ],
    'category_name'
);
// CLOSED PARA SA ACTIVITY LOG

    return redirect()->route('categories.index');
}





    
    // Burahin ang kategorya
    public function destroy(Category $category)
    {
         

    if (! auth()->user()->hasPermission('categories.delete')) {
    abort(403);
}       // Kasama to sa activity log categoryname 
        $categoryName = $category->category_name;

        $category->delete(); // ⚠️ Dahil may onDelete('cascade') tayo sa migration, automatic ding mabubura ang mga produkto sa ilalim nito!

        // Activity log 
         ActivityLogger::log(
        'Deleted',
        'Category',
        "Deleted category: {$categoryName}"
    );


        return redirect()->route('categories.index')->with('success', 'Category deleted successfully!');
    }
}

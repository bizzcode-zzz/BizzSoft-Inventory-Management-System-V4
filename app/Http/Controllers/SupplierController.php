<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier; 
use App\Http\Requests\SupplierRequest; 

class SupplierController extends Controller
{
    // Ipakita ang listahan ng mga supplier at ang save form
    // Kasama na dito ang search
    public function index(Request $request) 
    {
        // Kukuha ng tinype ng user sa search input field
        $search = $request->input('search');

        // Sasalain ang database gamit ang SQL LIKE query kung may hinahanap ang user
        $suppliers = Supplier::when($search, function ($query, $search) {
        $query->where(function ($q) use ($search) {
        $q->where('supplier_name', 'LIKE', "%{$search}%")
          ->orWhere('contact_person', 'LIKE', "%{$search}%");
    });
    })->get();

        // Ipapasa natin ang $suppliers at ang huling hinanap na text ($search) sa view
        return view('suppliers.index', compact('suppliers', 'search'));
    }

    // I-save ang bagong supplier
    public function store(SupplierRequest $request)
    {
        Supplier::create($request->validated());
        return redirect()->route('suppliers.index')->with('success', 'Supplier saved successfully!');
    }

    // Ipakita ang edit form
    public function edit(Supplier $supplier)
    {
        return view('suppliers.edit', compact('supplier'));
    }

    // I-save ang in-edit na supplier
    public function update(SupplierRequest $request, Supplier $supplier)
    {
        $supplier->update($request->validated());
        return redirect()->route('suppliers.index')->with('success', 'Supplier updated successfully!');
    }

    // Burahin ang supplier
    public function destroy(Supplier $supplier)
    {
        $supplier->delete();
        return redirect()->route('suppliers.index')->with('success', 'Supplier deleted successfully!');
    }
}

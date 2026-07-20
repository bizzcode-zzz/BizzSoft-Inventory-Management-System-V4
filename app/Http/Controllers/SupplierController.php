<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier; 
use App\Http\Requests\SupplierRequest; 
use App\Services\ActivityLogger;
use App\Services\AuditTrailService;
class SupplierController extends Controller
{
    // Ipakita ang listahan ng mga supplier at ang save form
    // Kasama na dito ang search
    public function index(Request $request) 
    {

    if (! auth()->user()->hasPermission('suppliers.view')) {
    abort(403);
}


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
    if (! auth()->user()->hasPermission('suppliers.create')) {
        abort(403);
    }

    $supplier = Supplier::create($request->validated());


// Activity Logs Delete ito kong D pa need
    ActivityLogger::log(
        'Created',
        'Supplier',
        "Created supplier: {$supplier->supplier_name}"
    );

    return redirect()->route('suppliers.index')
        ->with('success', 'Supplier saved successfully!');
}

    // Ipakita ang edit form
    public function edit(Supplier $supplier)
    {

    if (! auth()->user()->hasPermission('suppliers.edit')) {
    abort(403);
}

        return view('suppliers.edit', compact('supplier'));
    }




    // I-save ang in-edit na supplier
    public function update(SupplierRequest $request, Supplier $supplier)
{
    if (! auth()->user()->hasPermission('suppliers.edit')) {
        abort(403);
    }


 // Kasama to sa activity log oldproduct 
    $oldSupplier = $supplier->replicate();


    $supplier->update($request->validated());


// ENTRY PARA SA ACTIVITY LOG gamit nit ay auditTrailService.php
    AuditTrailService::logUpdate(
    $oldSupplier,
    $supplier,
    'Supplier',
    [
        'supplier_name' => 'Supplier Name',
        'contact_person' => 'Contact Person',
        'phone_number' => 'Phone Number',
        'email' => 'Email',
        'address' => 'Address',
    ],
    'supplier_name'
);
// CLOSED PARA SA ACTIVITY LOG

    return redirect()->route('suppliers.index')
        ->with('success', 'Supplier updated successfully!');
}

    // Burahin ang supplier
 public function destroy(Supplier $supplier)
{
    if (! auth()->user()->hasPermission('suppliers.delete')) {
        abort(403);
    }

    // Kasama sa activitylog suppliername
    $supplierName = $supplier->supplier_name;

    $supplier->delete();


// Activity Log
    ActivityLogger::log(
        'Deleted',
        'Supplier',
        "Deleted supplier: {$supplierName}"
    );

    return redirect()->route('suppliers.index')
        ->with('success', 'Supplier deleted successfully!');
}
}

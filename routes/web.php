<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\DashboardController; 
use App\Http\Controllers\ReportsController;

Route::resource('products', ProductController::class);
Route::resource('categories', CategoryController::class);
Route::resource('suppliers', SupplierController::class);
Route::resource('purchases', PurchaseController::class);
Route::resource('sales', SalesController::class);
Route::resource('dashboard', DashboardController::class)
    ->only('index');

    // Gamit tau ng get na para for read-only pages
Route::get('/reports', [ReportsController::class, 'index'])->name('reports.index');
Route::get('/reports/sales', [ReportsController::class, 'sales'])->name('reports.sales');
Route::get('/reports/purchases', [ReportsController::class, 'purchases'])->name('reports.purchases');
Route::get('/reports/inventory', [ReportsController::class, 'inventory'])->name('reports.inventory');
Route::get('/reports/low-stock', [ReportsController::class, 'lowstock'])->name('reports.low_stock');




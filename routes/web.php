<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ActivityLogController;


// Root
Route::get('/', function () {
    return redirect()->route('dashboard.index');
});


// Guest Routes
Route::middleware('guest')->group(function () {

    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.submit');

});


// Authenticated Routes
Route::middleware('auth')->group(function () {

    Route::resource('dashboard', DashboardController::class)
        ->only('index');

    Route::resource('products', ProductController::class);

    Route::resource('categories', CategoryController::class);

    Route::resource('suppliers', SupplierController::class);

    Route::resource('purchases', PurchaseController::class);

    Route::resource('sales', SalesController::class);


    Route::resource('users', UserController::class);
    Route::patch('/users/{user}/toggle-status', [UserController::class, 'toggleStatus'])
    ->name('users.toggle-status');
    Route::get('/users/{user}/reset-password', [UserController::class, 'showResetPassword'])
    ->name('users.reset-password');
    Route::patch('/users/{user}/reset-password', [UserController::class, 'resetPassword'])
    ->name('users.reset-password.update');


    Route::get('/activity-logs', [ActivityLogController::class, 'index'])
    ->name('activity-logs.index');


    // Reports
    Route::get('/reports', [ReportsController::class, 'index'])
        ->name('reports.index');

    Route::get('/reports/sales', [ReportsController::class, 'sales'])
        ->name('reports.sales');

    Route::get('/reports/purchases', [ReportsController::class, 'purchases'])
        ->name('reports.purchases');

    Route::get('/reports/inventory', [ReportsController::class, 'inventory'])
        ->name('reports.inventory');

    Route::get('/reports/low-stock', [ReportsController::class, 'lowstock'])
        ->name('reports.low_stock');

    Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');

});
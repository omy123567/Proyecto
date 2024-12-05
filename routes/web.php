<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::group(['middleware' => ['auth']], function () {

    Route::view('dashboard', 'dashboard')
        ->name('dashboard');

    Route::view('profile', 'profile')
        ->name('profile');
    Route::resource('sales', App\Http\Controllers\SaleController::class)->except(['update', 'destroy']);
});

Route::group(['middleware' => ['auth', 'admin']], function () {
    Route::resource('products', App\Http\Controllers\ProductController::class);
    Route::resource('product-categories', App\Http\Controllers\ProductCategoryController::class);
    Route::resource('purchases', App\Http\Controllers\PurchaseController::class);
    Route::get('/payment-methods', App\Livewire\Pages\PaymentMethods\Index::class)->name('payment-methods.index');
    Route::get('/suppliers', App\Livewire\Pages\Suppliers\Index::class)->name('suppliers.index');
});

require __DIR__ . '/auth.php';

<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::group(['middleware' => ['auth']], function () {

    Route::view('dashboard', 'dashboard')
        ->name('dashboard');

    Route::view('profile', 'profile')
        ->name('profile');
    Route::get('/sales', App\Livewire\Pages\Sales\Index::class)->name('sales.index');
    Route::get('/sales/create', App\Livewire\Pages\Sales\Create::class)->name('sales.create');

});

Route::group(['middleware' => ['auth', 'admin']], function () {
    Route::get('/purchases', App\Livewire\Pages\Purchases\Index::class)->name('purchases.index');
    Route::get('/products', App\Livewire\Pages\Products\Index::class)->name('products.index');
    Route::get('/product-categories', App\Livewire\Pages\Categories\Index::class)->name('product-categories.index');
    Route::get('/payment-methods', App\Livewire\Pages\PaymentMethods\Index::class)->name('payment-methods.index');
    Route::get('/suppliers', App\Livewire\Pages\Suppliers\Index::class)->name('suppliers.index');
});

require __DIR__ . '/auth.php';

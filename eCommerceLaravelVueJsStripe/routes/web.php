<?php

use App\Controller\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return ['Laravel' => app()->version()];
});

Route::get('products', [ProductController::class, 'index'])
    ->name('products.index');
    
Route::get('/dashboard', function () {
        $orders = auth()->user()->orders;
        return view('dashboard', compact('orders'));
    })->middleware(['auth'])->name('dashboard');
    
Route::get('/thankyou', fn() => 'Merci de votre commande!');

require __DIR__.'/auth.php';

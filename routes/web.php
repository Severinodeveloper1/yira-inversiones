<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

Route::get('/', [PageController::class, 'index'])->name('home');
Route::get('/nosotros', [PageController::class, 'nosotros'])->name('nosotros');
Route::get('/tienda', [PageController::class, 'tienda'])->name('tienda');
Route::get('/tienda/{slug}', [PageController::class, 'product'])->name('product.detail');
Route::get('/carrito', [PageController::class, 'cart'])->name('cart');
Route::get('/blog', [PageController::class, 'blog'])->name('blog');
Route::get('/blog/{slug}', [PageController::class, 'blogPost'])->name('blog.detail');
Route::get('/contacto', [PageController::class, 'contact'])->name('contact');
Route::get('/politicas', [PageController::class, 'policies'])->name('policies');

Route::post('/cotizacion', [PageController::class, 'storeQuote'])->name('quote.store');
Route::post('/libro-reclamaciones', [PageController::class, 'storeClaim'])->name('claim.store');

// Clientes / Checkout routes under customer auth middleware
Route::middleware('auth:customers')->group(function () {
    Route::get('/checkout', [PageController::class, 'checkout'])->name('checkout');
    Route::post('/checkout/process', [PageController::class, 'processCheckout'])->name('checkout.process');
});

// PDF invoice download route (secured via owner check in controller)
Route::get('/pedidos/{order_number}/pdf', [PageController::class, 'downloadOrderPdf'])->name('pedidos.pdf');

// Customer Logout Route
Route::post('/logout-customer', function() {
    auth('customers')->logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect()->route('home');
})->name('clientes.logout');


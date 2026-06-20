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


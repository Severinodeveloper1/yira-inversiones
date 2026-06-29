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

// Checkout routes (accessible by guests and logged-in customers)
Route::get('/checkout', [PageController::class, 'checkout'])->name('checkout');
Route::post('/checkout/process', [PageController::class, 'processCheckout'])->name('checkout.process');

// PDF invoice download route (secured via owner check in controller)
Route::get('/pedidos/{order_number}/pdf', [PageController::class, 'downloadOrderPdf'])->name('pedidos.pdf');

// Customer Logout Route
Route::post('/logout-customer', function() {
    auth('customers')->logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect()->route('home');
})->name('clientes.logout');

// Login redirect fallback for auth middleware
Route::get('/login', function() {
    return redirect()->route('filament.clientes.auth.login');
})->name('login');
// Ruta de prueba rápida para verificar el envío de correos y ver errores en pantalla
Route::get('/test-mail', function (\Illuminate\Http\Request $request) {
    $email = $request->get('to', 'tu-correo-aqui@gmail.com');
    
    try {
        \Illuminate\Support\Facades\Mail::raw('Este es un correo de prueba desde Laravel para verificar la configuración SMTP.', function ($message) use ($email) {
            $message->to($email)
                    ->subject('Correo de prueba Yira Inversiones');
        });
        return response()->json([
            'success' => true,
            'message' => '¡Correo enviado con éxito a ' . $email . '! La configuración SMTP funciona.'
        ]);
    } catch (\Throwable $e) {
        return response()->json([
            'success' => false,
            'message' => 'Error al enviar el correo.',
            'error_details' => $e->getMessage(),
            'error_trace' => $e->getTraceAsString()
        ], 500);
    }
});

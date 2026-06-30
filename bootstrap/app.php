<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Database\QueryException;
use Filament\Notifications\Notification;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (QueryException $e) {
            // Verificar si el error es de violación de integridad / clave foránea (código 23000)
            if ($e->getCode() === '23000' || str_contains($e->getMessage(), 'Integrity constraint violation')) {
                Notification::make()
                    ->danger()
                    ->title('Operación no permitida')
                    ->body('Este registro no puede ser eliminado de forma definitiva porque tiene datos relacionados en el sistema (por ejemplo, pedidos, cotizaciones o dependencias).')
                    ->persistent()
                    ->send();

                return back();
            }
        });
    })->create();

<?php

namespace App\Filament\Resources\Products\Pages;

use App\Filament\Resources\Products\ProductResource;
use App\Models\Product;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditProduct extends EditRecord
{
    protected static string $resource = ProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
            ForceDeleteAction::make()
                ->before(function (ForceDeleteAction $action, Product $record) {
                    if ($record->orderItems()->exists()) {
                        Notification::make()
                            ->danger()
                            ->title('No se puede eliminar permanentemente')
                            ->body('Este producto tiene órdenes asociadas y no puede ser eliminado de forma permanente.')
                            ->send();

                        $action->cancel();
                    }
                }),
            RestoreAction::make(),
        ];
    }
}

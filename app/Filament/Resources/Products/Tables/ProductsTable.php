<?php

namespace App\Filament\Resources\Products\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use App\Models\Product;

class ProductsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                SpatieMediaLibraryImageColumn::make('images')
                    ->label('Imagen')
                    ->collection('products')
                    ->circular()
                    ->limit(1),
                TextColumn::make('name')
                    ->label('Producto')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('category.name')
                    ->label('Categoría')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('price')
                    ->label('Precio')
                    ->formatStateUsing(fn ($state) => $state ? 'S/. ' . number_format((float) $state, 2) : '-')
                    ->sortable(),
                TextColumn::make('delivery_time')
                    ->label('Entrega')
                    ->searchable(),
                IconColumn::make('is_featured')
                    ->label('Destacado')
                    ->boolean()
                    ->sortable(),
                IconColumn::make('is_active')
                    ->label('Activo')
                    ->boolean()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Creado En')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label('Actualizado En')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->recordActions([
                EditAction::make(),
                RestoreAction::make(),
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
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                    ForceDeleteBulkAction::make()
                        ->before(function (ForceDeleteBulkAction $action, \Illuminate\Database\Eloquent\Collection $records) {
                            $hasOrders = $records->contains(fn (Product $record) => $record->orderItems()->exists());
                            if ($hasOrders) {
                                Notification::make()
                                    ->danger()
                                    ->title('Acción cancelada')
                                    ->body('Uno o más productos seleccionados tienen órdenes asociadas y no pueden ser eliminados permanentemente.')
                                    ->send();

                                $action->cancel();
                            }
                        }),
                ]),
            ]);
    }
}

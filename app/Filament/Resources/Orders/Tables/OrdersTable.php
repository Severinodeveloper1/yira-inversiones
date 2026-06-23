<?php

namespace App\Filament\Resources\Orders\Tables;

use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class OrdersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('order_number')
                    ->label('Nro. Pedido')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('customer.name')
                    ->label('Cliente')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('document_type')
                    ->label('Tipo Comprobante')
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'boleta' => 'Boleta',
                        'factura' => 'Factura',
                        'ticket' => 'Ticket',
                        default => ucfirst($state),
                    })
                    ->sortable(),
                TextColumn::make('document_number')
                    ->label('Nro. Comprobante')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('shipping_method')
                    ->label('Método de Envío')
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'recojo_tienda' => 'Recojo en Tienda',
                        'delivery' => 'Delivery',
                        'envio_agencia' => 'Envío por Agencia',
                        default => $state,
                    })
                    ->sortable(),
                TextColumn::make('status')
                    ->label('Estado')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pendiente' => 'warning',
                        'espera_pago' => 'info',
                        'aprobado' => 'success',
                        'embalado' => 'primary',
                        'entregado' => 'success',
                        'anulado' => 'danger',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'pendiente' => 'Pendiente',
                        'espera_pago' => 'Espera de Pago',
                        'aprobado' => 'Aprobado',
                        'embalado' => 'Embalado',
                        'entregado' => 'Entregado',
                        'anulado' => 'Anulado',
                        default => ucfirst($state),
                    })
                    ->sortable(),
                TextColumn::make('total')
                    ->label('Total')
                    ->formatStateUsing(fn ($state) => 'S/. ' . number_format((float) $state, 2))
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Fecha Pedido')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make()
                    ->label('Ver'),
                EditAction::make()
                    ->label('Editar'),
                Action::make('pdf')
                    ->label('PDF')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->color('success')
                    ->url(fn ($record) => route('pedidos.pdf', ['order_number' => $record->order_number]))
                    ->openUrlInNewTab(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}


<?php

namespace App\Filament\Resources\Orders\Schemas;

use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class OrderInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Section::make('Información del Pedido')
                    ->schema([
                        TextEntry::make('order_number')
                            ->label('Nro. Pedido'),
                        TextEntry::make('created_at')
                            ->label('Fecha del Pedido')
                            ->dateTime('d/m/Y H:i'),
                        TextEntry::make('status')
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
                            }),
                        TextEntry::make('document_type')
                            ->label('Tipo Comprobante')
                            ->formatStateUsing(fn (string $state): string => match ($state) {
                                'boleta' => 'Boleta de Venta',
                                'factura' => 'Factura',
                                'ticket' => 'Ticket',
                                default => ucfirst($state),
                            }),
                        TextEntry::make('document_number')
                            ->label('Nro. Comprobante'),
                    ])
                    ->columns(3),

                Section::make('Datos del Cliente y Envío')
                    ->schema([
                        TextEntry::make('customer.name')
                            ->label('Cliente Registrado'),
                        TextEntry::make('billing_name')
                            ->label('Razón Social / Nombre (Facturación)'),
                        TextEntry::make('phone')
                            ->label('Teléfono'),
                        TextEntry::make('email')
                            ->label('Correo Electrónico'),
                        TextEntry::make('shipping_method')
                            ->label('Método de Envío')
                            ->formatStateUsing(fn (string $state): string => match ($state) {
                                'recojo_tienda' => 'Recojo en Tienda',
                                'delivery' => 'Delivery',
                                'envio_agencia' => 'Envío por Agencia',
                                default => $state,
                            }),
                        TextEntry::make('shipping_address')
                            ->label('Dirección de Envío')
                            ->placeholder('No aplica / Recojo en tienda')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Section::make('Detalle de Productos')
                    ->schema([
                        RepeatableEntry::make('items')
                            ->label('Productos en el pedido')
                            ->schema([
                                TextEntry::make('product_name')
                                    ->label('Producto'),
                                TextEntry::make('color')
                                    ->label('Color')
                                    ->placeholder('-'),
                                TextEntry::make('price')
                                    ->label('Precio Unitario')
                                    ->formatStateUsing(fn ($state) => 'S/. ' . number_format((float) $state, 2)),
                                TextEntry::make('quantity')
                                    ->label('Cantidad'),
                                TextEntry::make('subtotal')
                                    ->label('Subtotal')
                                    ->formatStateUsing(fn ($state) => 'S/. ' . number_format((float) $state, 2)),
                            ])
                            ->columns(5)
                            ->columnSpanFull(),
                    ]),

                Section::make('Resumen de Totales')
                    ->schema([
                        TextEntry::make('subtotal')
                            ->label('Subtotal')
                            ->formatStateUsing(fn ($state) => 'S/. ' . number_format((float) $state, 2)),
                        TextEntry::make('tax')
                            ->label('IGV (18%)')
                            ->formatStateUsing(fn ($state) => 'S/. ' . number_format((float) $state, 2)),
                        TextEntry::make('total')
                            ->label('Total General')
                            ->formatStateUsing(fn ($state) => 'S/. ' . number_format((float) $state, 2))
                            ->weight('bold'),
                    ])
                    ->columns(3),
            ]);
    }
}


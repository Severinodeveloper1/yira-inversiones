<?php

namespace App\Filament\Resources\Orders\Schemas;

use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class OrderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Section::make('Información General del Pedido')
                    ->schema([
                        TextInput::make('order_number')
                            ->label('Nro. Pedido')
                            ->disabled(),
                        Select::make('status')
                            ->label('Estado del Pedido')
                            ->options([
                                'pendiente' => 'Pendiente',
                                'espera_pago' => 'Espera de Pago',
                                'aprobado' => 'Aprobado',
                                'embalado' => 'Embalado',
                                'entregado' => 'Entregado',
                                'anulado' => 'Anulado',
                            ])
                            ->required(),
                        Select::make('document_type')
                            ->label('Tipo de Comprobante')
                            ->options([
                                'boleta' => 'Boleta de Venta',
                                'factura' => 'Factura',
                                'ticket' => 'Ticket',
                            ])
                            ->disabled(),
                        TextInput::make('document_number')
                            ->label('Número de Comprobante')
                            ->disabled(),
                    ])
                    ->columns(2),

                Section::make('Datos del Cliente y Envío')
                    ->schema([
                        TextInput::make('billing_name')
                            ->label('Nombre / Razón Social')
                            ->disabled(),
                        TextInput::make('email')
                            ->label('Correo Electrónico')
                            ->disabled(),
                        TextInput::make('phone')
                            ->label('Teléfono')
                            ->disabled(),
                        Select::make('shipping_method')
                            ->label('Método de Envío')
                            ->options([
                                'recojo_tienda' => 'Recojo en Tienda',
                                'delivery' => 'Delivery',
                                'envio_agencia' => 'Envío por Agencia',
                            ])
                            ->disabled(),
                        Textarea::make('shipping_address')
                            ->label('Dirección de Envío')
                            ->placeholder('No aplica / Recojo en tienda')
                            ->disabled()
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Section::make('Detalle de Productos')
                    ->schema([
                        Repeater::make('items')
                            ->label('Productos en el pedido')
                            ->relationship('items')
                            ->schema([
                                TextInput::make('product_name')
                                    ->label('Producto')
                                    ->disabled(),
                                TextInput::make('color')
                                    ->label('Color')
                                    ->disabled(),
                                TextInput::make('price')
                                    ->label('Precio Unitario')
                                    ->disabled(),
                                TextInput::make('quantity')
                                    ->label('Cantidad')
                                    ->disabled(),
                                TextInput::make('subtotal')
                                    ->label('Subtotal')
                                    ->disabled(),
                            ])
                            ->columns(5)
                            ->disabled()
                            ->columnSpanFull(),
                    ]),

                Section::make('Resumen Económico')
                    ->schema([
                        TextInput::make('subtotal')
                            ->label('Subtotal')
                            ->prefix('S/.')
                            ->disabled(),
                        TextInput::make('tax')
                            ->label('IGV (18%)')
                            ->prefix('S/.')
                            ->disabled(),
                        TextInput::make('total')
                            ->label('Total General')
                            ->prefix('S/.')
                            ->disabled(),
                    ])
                    ->columns(3),
            ]);
    }
}


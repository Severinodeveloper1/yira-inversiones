<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Detalles de Producto')
                    ->tabs([
                        Tab::make('General y Precios')
                            ->icon('heroicon-o-information-circle')
                            ->schema([
                                Section::make('Información Básica')
                                    ->schema([
                                        TextInput::make('name')
                                            ->label('Nombre del Producto')
                                            ->required()
                                            ->live(onBlur: true)
                                            ->afterStateUpdated(fn ($set, $state) => $set('slug', Str::slug($state)))
                                            ->maxLength(255),
                                        TextInput::make('slug')
                                            ->label('Slug / URL Amigable')
                                            ->required()
                                            ->unique(ignoreRecord: true)
                                            ->maxLength(255),
                                        Select::make('category_id')
                                            ->label('Categoría')
                                            ->relationship('category', 'name')
                                            ->required()
                                            ->searchable()
                                            ->preload(),
                                        TextInput::make('delivery_time')
                                            ->label('Tiempos de Entrega')
                                            ->placeholder('Ej: 5-7 días hábiles o Stock Inmediato')
                                            ->maxLength(255),
                                    ])
                                    ->columns(2),

                                Section::make('Precios y Estado')
                                    ->schema([
                                        TextInput::make('price')
                                            ->label('Precio Regular (S/.)')
                                            ->numeric()
                                            ->prefix('S/.'),
                                        TextInput::make('promo_price')
                                            ->label('Precio Promocional (S/.)')
                                            ->numeric()
                                            ->prefix('S/.')
                                            ->helperText('Dejar vacío si no está en promoción.'),
                                        TextInput::make('promo_label')
                                            ->label('Etiqueta Promocional')
                                            ->placeholder('Ej: 20% DTO, Oferta')
                                            ->maxLength(255),
                                        Toggle::make('is_featured')
                                            ->label('¿Destacado en Inicio?')
                                            ->inline(false)
                                            ->default(false),
                                        Toggle::make('is_active')
                                            ->label('¿Producto Activo?')
                                            ->inline(false)
                                            ->default(true),
                                    ])
                                    ->columns(3),

                                Section::make('Detalles Técnicos')
                                    ->schema([
                                        RichEditor::make('description')
                                            ->label('Descripción del Producto')
                                            ->columnSpanFull(),
                                    ])
                            ]),

                        Tab::make('Paleta de Colores')
                            ->icon('heroicon-o-swatch')
                            ->schema([
                                Repeater::make('colors')
                                    ->label('Colores Disponibles')
                                    ->schema([
                                        ColorPicker::make('hex')
                                            ->label('Color Visual')
                                            ->required(),
                                        TextInput::make('name')
                                            ->label('Nombre del Color (Ej: Cedro, Caoba, Negro)')
                                            ->required()
                                            ->maxLength(255),
                                    ])
                                    ->grid(2)
                                    ->columnSpanFull()
                                    ->default([]),
                            ]),

                        Tab::make('Galería de Imágenes')
                            ->icon('heroicon-o-photo')
                            ->schema([
                                SpatieMediaLibraryFileUpload::make('images')
                                    ->label('Imágenes del Producto')
                                    ->multiple()
                                    ->image()
                                    ->maxFiles(10)
                                    ->collection('products')
                                    ->columnSpanFull(),
                            ]),
                    ])
                    ->columnSpanFull()
            ]);
    }
}

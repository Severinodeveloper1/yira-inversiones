<?php

namespace App\Filament\Resources\Categories\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Section::make('Detalles de la Categoría')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nombre de la Categoría')
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn ($set, $state) => $set('slug', Str::slug($state)))
                            ->maxLength(255),
                        TextInput::make('slug')
                            ->label('Slug / URL Amigable')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),
                        Select::make('type')
                            ->label('Línea de Negocio')
                            ->required()
                            ->options([
                                'hogar' => 'Hogar',
                                'oficina' => 'Oficina',
                            ])
                            ->default('hogar'),
                        FileUpload::make('image_path')
                            ->label('Imagen Representativa')
                            ->image()
                            ->directory('categories')
                            ->helperText('Opcional. Imagen usada en la grilla de inicio.'),
                        Textarea::make('description')
                            ->label('Descripción')
                            ->columnSpanFull()
                            ->rows(3),
                    ])
                    ->columns(2)
            ]);
    }
}

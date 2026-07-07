<?php

namespace App\Filament\Resources\Banners\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class BannerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Section::make('Información del Banner')
                    ->schema([
                        TextInput::make('title')
                            ->label('Título del Banner')
                            ->maxLength(255),
                        Toggle::make('is_active')
                            ->label('¿Banner Activo?')
                            ->inline(false)
                            ->default(true),
                        FileUpload::make('image_path')
                            ->label('Imagen del Banner (Escritorio)')
                            ->image()
                            ->directory('banners')
                            ->required()
                            ->maxSize(2048)
                            ->columnSpanFull()
                            ->helperText('Tamaño recomendado: 1200x500px, máx 2MB.'),
                        FileUpload::make('mobile_image_path')
                            ->label('Imagen del Banner (Móviles)')
                            ->image()
                            ->directory('banners/mobile')
                            ->maxSize(2048)
                            ->columnSpanFull()
                            ->helperText('Opcional. Relación sugerida: vertical (800x1000px) o cuadrada (800x800px) para que se visualice correctamente en celulares, máx 2MB.'),
                        TextInput::make('button_text')
                            ->label('Texto del Botón (CTA)')
                            ->maxLength(255),
                        TextInput::make('button_url')
                            ->label('Enlace del Botón (URL)')
                            ->url()
                            ->maxLength(255),
                    ])
                    ->columns(2)
            ]);
    }
}

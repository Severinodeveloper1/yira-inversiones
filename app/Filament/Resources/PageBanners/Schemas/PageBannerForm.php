<?php

namespace App\Filament\Resources\PageBanners\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PageBannerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Section::make('Configuración del Banner')
                    ->description('Selecciona la página y sube la imagen que aparecerá como cabecera.')
                    ->schema([
                        Select::make('page')
                            ->label('Página')
                            ->required()
                            ->options([
                                'tienda'   => 'Tienda y Catálogos',
                                'nosotros' => 'Nosotros',
                                'blog'     => 'Blog / Noticias',
                                'contacto' => 'Contacto',
                            ])
                            ->placeholder('Selecciona una página...')
                            ->native(false),
                        TextInput::make('sort_order')
                            ->label('Orden de visualización')
                            ->numeric()
                            ->default(0)
                            ->helperText('Número menor = aparece primero. Útil si hay múltiples banners en la misma página.'),
                        FileUpload::make('image_path')
                            ->label('Imagen del Banner')
                            ->image()
                            ->directory('page-banners')
                            ->columnSpanFull()
                            ->helperText('Tamaño recomendado: 1920×600px, formato JPG/WEBP. Máx. 5MB.'),
                    ])
                    ->columns(2),

                Section::make('Texto del Banner (Opcional)')
                    ->description('Si dejas vacíos estos campos, el banner mostrará solo la imagen sin sombreado ni texto.')
                    ->schema([
                        TextInput::make('subtitle')
                            ->label('Subtítulo / Etiqueta')
                            ->placeholder('Ej: Promociones de Verano')
                            ->maxLength(100),
                        TextInput::make('title')
                            ->label('Título Principal')
                            ->placeholder('Ej: Hasta 30% de descuento')
                            ->maxLength(150),
                    ])
                    ->columns(2),
            ]);
    }
}

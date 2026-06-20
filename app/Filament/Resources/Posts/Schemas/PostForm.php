<?php

namespace App\Filament\Resources\Posts\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Detalles del Artículo')
                    ->schema([
                        TextInput::make('title')
                            ->label('Título del Artículo')
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn ($set, $state) => $set('slug', Str::slug($state)))
                            ->maxLength(255),
                        TextInput::make('slug')
                            ->label('Slug / URL Amigable')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),
                        FileUpload::make('image_path')
                            ->label('Imagen de Portada')
                            ->image()
                            ->directory('blog'),
                        DateTimePicker::make('published_at')
                            ->label('Fecha de Publicación')
                            ->default(now()),
                        Toggle::make('is_published')
                            ->label('¿Publicado?')
                            ->inline(false)
                            ->default(true),
                        RichEditor::make('content')
                            ->label('Contenido del Artículo')
                            ->required()
                            ->columnSpanFull(),
                    ])
                    ->columns(2)
            ]);
    }
}

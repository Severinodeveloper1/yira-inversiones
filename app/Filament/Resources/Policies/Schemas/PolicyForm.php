<?php

namespace App\Filament\Resources\Policies\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PolicyForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Section::make('Política de la Empresa')
                    ->schema([
                        TextInput::make('key')
                            ->label('Identificador Único (ej: envios, devoluciones-lima)')
                            ->helperText('Use una sola palabra o palabras separadas por guiones. Este será el identificador interno.')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(50),
                        TextInput::make('title')
                            ->label('Título de la Sección')
                            ->required()
                            ->maxLength(255),
                        RichEditor::make('content')
                            ->label('Contenido de la Política')
                            ->required()
                            ->columnSpanFull(),
                    ])
                    ->columns(2)
            ]);
    }
}

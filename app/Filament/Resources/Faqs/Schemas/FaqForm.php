<?php

namespace App\Filament\Resources\Faqs\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class FaqForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Pregunta Frecuente')
                    ->schema([
                        TextInput::make('question')
                            ->label('Pregunta')
                            ->required()
                            ->maxLength(255),
                        Toggle::make('is_active')
                            ->label('¿Pregunta Activa?')
                            ->inline(false)
                            ->default(true),
                        Textarea::make('answer')
                            ->label('Respuesta')
                            ->required()
                            ->rows(4)
                            ->columnSpanFull(),
                    ])
                    ->columns(2)
            ]);
    }
}

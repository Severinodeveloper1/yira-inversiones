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
            ->components([
                Section::make('Política de la Empresa')
                    ->schema([
                        Select::make('key')
                            ->label('Tipo de Política')
                            ->required()
                            ->options([
                                'envio' => 'Política de Envío',
                                'devolucion' => 'Política de Devolución',
                                'pago' => 'Política de Pago',
                                'entrega' => 'Política de Entrega',
                            ])
                            ->unique(ignoreRecord: true),
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

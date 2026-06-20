<?php

namespace App\Filament\Resources\Quotes\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class QuoteForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Detalles del Solicitante')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nombre Completo')
                            ->required(),
                        TextInput::make('email')
                            ->label('Correo Electrónico')
                            ->email()
                            ->required(),
                        TextInput::make('phone')
                            ->label('Teléfono / WhatsApp')
                            ->required(),
                        TextInput::make('project')
                            ->label('Proyecto / Asunto')
                            ->default(null),
                    ])
                    ->columns(2),

                Section::make('Requerimiento')
                    ->schema([
                        Textarea::make('message')
                            ->label('Mensaje o Detalles de la Cotización')
                            ->required()
                            ->rows(5)
                            ->columnSpanFull(),
                        Select::make('status')
                            ->label('Estado')
                            ->options([
                                'pendiente' => 'Pendiente',
                                'en_proceso' => 'En Proceso',
                                'atendido' => 'Atendido',
                                'cancelado' => 'Cancelado',
                            ])
                            ->required()
                            ->default('pendiente'),
                    ])
            ]);
    }
}

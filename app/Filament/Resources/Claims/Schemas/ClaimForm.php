<?php

namespace App\Filament\Resources\Claims\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ClaimForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Hoja de Reclamación')
                    ->schema([
                        TextInput::make('claim_number')
                            ->label('Nro. de Reclamación')
                            ->disabled()
                            ->required(),
                        Select::make('status')
                            ->label('Estado de Atención')
                            ->required()
                            ->options([
                                'pendiente' => 'Pendiente',
                                'atendido' => 'Atendido',
                            ])
                            ->default('pendiente'),
                        TextInput::make('fullname')
                            ->label('Nombre Completo del Cliente')
                            ->disabled()
                            ->required(),
                        TextInput::make('email')
                            ->label('Correo Electrónico')
                            ->disabled()
                            ->required(),
                        TextInput::make('document_type')
                            ->label('Tipo de Documento')
                            ->disabled()
                            ->required(),
                        TextInput::make('document_number')
                            ->label('Nro. de Documento')
                            ->disabled()
                            ->required(),
                        TextInput::make('phone')
                            ->label('Teléfono de Contacto')
                            ->disabled()
                            ->required(),
                        TextInput::make('type')
                            ->label('Tipo de Incidencia')
                            ->disabled()
                            ->required(),
                        Textarea::make('description')
                            ->label('Detalle y Descripción del Reclamo/Queja')
                            ->disabled()
                            ->required()
                            ->columnSpanFull()
                            ->rows(4),
                    ])
                    ->columns(2)
            ]);
    }
}

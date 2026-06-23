<?php

namespace App\Filament\Resources\Customers\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class CustomerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Section::make('Información del Cliente')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nombre Completo / Razón Social')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('email')
                            ->label('Correo Electrónico')
                            ->email()
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),
                        TextInput::make('phone')
                            ->label('Teléfono / Celular')
                            ->tel()
                            ->required()
                            ->maxLength(20),
                        Select::make('document_type')
                            ->label('Tipo de Documento')
                            ->options([
                                'DNI' => 'DNI (Doc. Nacional de Identidad)',
                                'RUC' => 'RUC (Registro Único de Contribuyentes)',
                                'CE' => 'CE (Carnet de Extranjería)',
                                'PASAPORTE' => 'Pasaporte',
                            ])
                            ->required(),
                        TextInput::make('document_number')
                            ->label('Número de Documento')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(20),
                        TextInput::make('password')
                            ->label('Contraseña')
                            ->password()
                            ->dehydrated(fn ($state) => filled($state))
                            ->required(fn (string $context): bool => $context === 'create')
                            ->maxLength(255)
                            ->helperText('Dejar en blanco para mantener la contraseña actual.'),
                        Toggle::make('is_active')
                            ->label('¿Cliente Activo?')
                            ->default(true)
                            ->helperText('Si se desactiva, el cliente no podrá iniciar sesión ni completar pedidos.'),
                    ])
                    ->columns(2)
            ]);
    }
}


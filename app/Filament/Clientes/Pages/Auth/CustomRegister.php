<?php

namespace App\Filament\Clientes\Pages\Auth;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Auth\Pages\Register;
use Filament\Schemas\Schema;

class CustomRegister extends Register
{
    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                $this->getNameFormComponent(),
                $this->getEmailFormComponent()
                    ->unique('customers', 'email'),
                Select::make('document_type')
                    ->label('Tipo de Documento')
                    ->options([
                        'DNI' => 'DNI',
                        'RUC' => 'RUC',
                        'CE' => 'Carnet de Extranjería',
                        'PASAPORTE' => 'Pasaporte',
                    ])
                    ->required(),
                TextInput::make('document_number')
                    ->label('Número de Documento')
                    ->required()
                    ->unique('customers', 'document_number')
                    ->maxLength(20)
                    ->helperText('Debe ser único y corresponder a su documento oficial.'),
                TextInput::make('phone')
                    ->label('Teléfono / WhatsApp')
                    ->required()
                    ->maxLength(20),
                $this->getPasswordFormComponent(),
                $this->getPasswordConfirmationFormComponent(),
            ]);
    }
}


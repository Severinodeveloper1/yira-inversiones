<?php

namespace App\Filament\Resources\Settings\Tables;

use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SettingsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nombre Comercial')
                    ->sortable(),
                ImageColumn::make('logo_path')
                    ->label('Logo'),
                TextColumn::make('phone')
                    ->label('Teléfono de Contacto'),
                TextColumn::make('email')
                    ->label('Correo Electrónico'),
                TextColumn::make('address')
                    ->label('Dirección')
                    ->limit(40),
            ])
            ->filters([
                // No filters needed for a single setting record
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                // Disable bulk action deletions to protect settings integrity
            ]);
    }
}

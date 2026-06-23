<?php

namespace App\Filament\Resources\PageBanners\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PageBannersTable
{
    public static function configure(Table $table): Table
    {
        $pageLabels = [
            'tienda'   => 'Tienda y Catálogos',
            'nosotros' => 'Nosotros',
            'blog'     => 'Blog / Noticias',
            'contacto' => 'Contacto',
        ];

        return $table
            ->columns([
                ImageColumn::make('image_path')
                    ->label('Imagen')
                    ->disk('public')
                    ->height(60)
                    ->width(120),
                TextColumn::make('sort_order')
                    ->label('Orden')
                    ->numeric()
                    ->sortable()
                    ->alignCenter(),
                TextColumn::make('page')
                    ->label('Página')
                    ->formatStateUsing(fn($state) => $pageLabels[$state] ?? ucfirst($state))
                    ->badge()
                    ->color('primary')
                    ->searchable(),
                TextColumn::make('title')
                    ->label('Título')
                    ->default('—')
                    ->limit(50)
                    ->searchable(),
                TextColumn::make('subtitle')
                    ->label('Subtítulo')
                    ->default('—')
                    ->limit(40),
                TextColumn::make('updated_at')
                    ->label('Actualizado')
                    ->since()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}

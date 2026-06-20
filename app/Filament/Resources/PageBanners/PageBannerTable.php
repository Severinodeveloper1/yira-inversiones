<?php

namespace App\Filament\Resources\PageBanners;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PageBannerTable
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
                    ->sortable()
                    ->alignCenter(),
                TextColumn::make('page')
                    ->label('Página')
                    ->formatStateUsing(fn($state) => $pageLabels[$state] ?? ucfirst($state))
                    ->badge()
                    ->color('primary'),
                TextColumn::make('title')
                    ->label('Título')
                    ->default('—')
                    ->limit(50),
                TextColumn::make('subtitle')
                    ->label('Subtítulo')
                    ->default('—')
                    ->limit(40),
                TextColumn::make('updated_at')
                    ->label('Actualizado')
                    ->since()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make()->label('Editar'),
                ViewAction::make()->label('Ver')
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}

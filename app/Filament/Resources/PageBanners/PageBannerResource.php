<?php

namespace App\Filament\Resources\PageBanners;

use App\Filament\Resources\PageBanners\Pages\CreatePageBanner;
use App\Filament\Resources\PageBanners\Pages\EditPageBanner;
use App\Filament\Resources\PageBanners\Pages\ListPageBanners;
use App\Filament\Resources\PageBanners\Pages\ViewPageBanner;
use App\Filament\Resources\PageBanners\Schemas\PageBannerForm;
use App\Filament\Resources\PageBanners\Schemas\PageBannerInfolist;
use App\Filament\Resources\PageBanners\Tables\PageBannersTable;
use App\Models\PageBanner;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PageBannerResource extends Resource
{
    protected static ?string $model = PageBanner::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $navigationLabel = 'Banners de Páginas';

    protected static ?string $modelLabel = 'Banner de Página';

    protected static ?string $pluralModelLabel = 'Banners de Páginas';

    protected static string|\UnitEnum|null $navigationGroup = 'Contenido Web';

    protected static ?int $navigationSort = 5;

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return PageBannerForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return PageBannerInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PageBannersTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPageBanners::route('/'),
            'create' => CreatePageBanner::route('/create'),
            'view' => ViewPageBanner::route('/{record}'),
            'edit' => EditPageBanner::route('/{record}/edit'),
        ];
    }
}

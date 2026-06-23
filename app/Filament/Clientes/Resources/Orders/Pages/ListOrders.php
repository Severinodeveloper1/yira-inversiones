<?php

namespace App\Filament\Clientes\Resources\Orders\Pages;

use App\Filament\Clientes\Resources\Orders\OrderResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListOrders extends ListRecords
{
    protected static string $resource = OrderResource::class;
}


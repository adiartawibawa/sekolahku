<?php

namespace App\Filament\Resources\SarprasBangunanResource\Pages;

use App\Filament\Imports\SarprasBangunanImporter;
use App\Filament\Resources\SarprasBangunanResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSarprasBangunans extends ListRecords
{
    protected static string $resource = SarprasBangunanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->icon('heroicon-o-plus-circle'),
            Actions\ImportAction::make()
                ->label('Import')
                ->icon('heroicon-o-arrow-down-tray')
                ->importer(SarprasBangunanImporter::class),
        ];
    }
}

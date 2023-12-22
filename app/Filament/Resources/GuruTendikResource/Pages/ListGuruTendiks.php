<?php

namespace App\Filament\Resources\GuruTendikResource\Pages;

use App\Filament\Imports\GuruTendikImporter;
use App\Filament\Resources\GuruTendikResource;
use Filament\Actions;
use Filament\Pages\Concerns\ExposesTableToWidgets;
use Filament\Resources\Pages\ListRecords;

class ListGuruTendiks extends ListRecords
{

    protected static string $resource = GuruTendikResource::class;

    protected function getHeaderActions(): array
    {
        return [

            Actions\CreateAction::make()
                ->icon('heroicon-o-plus-circle'),

            Actions\ImportAction::make()
                ->label('Import')
                ->icon('heroicon-o-arrow-down-tray')
                ->importer(GuruTendikImporter::class)
                ->chunkSize(100),
        ];
    }
}

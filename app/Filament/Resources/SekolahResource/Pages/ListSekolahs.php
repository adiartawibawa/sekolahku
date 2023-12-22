<?php

namespace App\Filament\Resources\SekolahResource\Pages;

use App\Filament\Imports\SekolahImporter;
use App\Filament\Resources\SekolahResource;
use Filament\Actions;
use Filament\Pages\Concerns\ExposesTableToWidgets;
use Filament\Resources\Pages\ListRecords;

class ListSekolahs extends ListRecords
{
    use ExposesTableToWidgets;

    protected static string $resource = SekolahResource::class;

    protected function getHeaderWidgets(): array
    {
        return [
            SekolahResource\Widgets\SekolahOverview::class,
            SekolahResource\Widgets\SekolahCustomOverview::class,
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->icon('heroicon-o-plus-circle'),
            Actions\ImportAction::make()
                ->label('Import')
                ->icon('heroicon-o-arrow-down-tray')
                ->importer(SekolahImporter::class),
        ];
    }
}

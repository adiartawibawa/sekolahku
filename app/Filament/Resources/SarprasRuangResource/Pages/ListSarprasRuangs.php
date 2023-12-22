<?php

namespace App\Filament\Resources\SarprasRuangResource\Pages;

use App\Filament\Imports\SarprasRuangImporter;
use App\Filament\Resources\SarprasRuangResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSarprasRuangs extends ListRecords
{
    protected static string $resource = SarprasRuangResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->icon('heroicon-o-plus-circle'),
            Actions\ImportAction::make()
                ->label('Import')
                ->icon('heroicon-o-arrow-down-tray')
                ->importer(SarprasRuangImporter::class),
        ];
    }
}

<?php

namespace App\Filament\Resources\DesaResource\Pages;

use App\Filament\Imports\DesaImporter;
use App\Filament\Resources\DesaResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageDesas extends ManageRecords
{
    protected static string $resource = DesaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->icon('heroicon-o-plus-circle'),
            Actions\ImportAction::make()
                ->label('Import')
                ->icon('heroicon-o-arrow-down-tray')
                ->importer(DesaImporter::class),
        ];
    }
}

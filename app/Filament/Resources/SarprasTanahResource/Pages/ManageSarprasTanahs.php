<?php

namespace App\Filament\Resources\SarprasTanahResource\Pages;

use App\Filament\Imports\SarprasTanahImporter;
use App\Filament\Resources\SarprasTanahResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageSarprasTanahs extends ManageRecords
{
    protected static string $resource = SarprasTanahResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->icon('heroicon-o-plus-circle'),
            Actions\ImportAction::make()
                ->label('Import')
                ->icon('heroicon-o-arrow-down-tray')
                ->importer(SarprasTanahImporter::class),
        ];
    }
}

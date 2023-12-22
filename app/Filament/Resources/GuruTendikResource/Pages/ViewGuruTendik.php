<?php

namespace App\Filament\Resources\GuruTendikResource\Pages;

use App\Filament\Resources\GuruTendikResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewGuruTendik extends ViewRecord
{
    protected static string $resource = GuruTendikResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}

<?php

namespace App\Filament\Resources\SarprasRuangResource\Pages;

use App\Filament\Resources\SarprasRuangResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewSarprasRuang extends ViewRecord
{
    protected static string $resource = SarprasRuangResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}

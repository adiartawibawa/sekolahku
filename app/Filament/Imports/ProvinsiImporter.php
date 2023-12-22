<?php

namespace App\Filament\Imports;

use App\Models\Provinsi;
use Carbon\Carbon;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;
use Filament\Forms\Components\Checkbox;

use function GuzzleHttp\json_encode;

class ProvinsiImporter extends Importer
{
    protected static ?string $model = Provinsi::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('code')
                ->requiredMapping()
                ->rules(['required', 'max:2']),
            ImportColumn::make('name')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            // ImportColumn::make('lat')
            //     ->numeric(decimalPlaces: 7),
            // ImportColumn::make('lon')
            //     ->numeric(decimalPlaces: 7),
        ];
    }

    public function resolveRecord(): ?Provinsi
    {
        return Provinsi::firstOrNew([
            'code' => $this->data['code'],
            'name' => $this->data['name'],
            'meta' => json_encode(['lat' => $this->data['lat'], 'lon' => $this->data['lon']]),
        ]);

        // return new Provinsi();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your provinsi import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}

<?php

namespace App\Filament\Imports;

use App\Models\Kecamatan;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class KecamatanImporter extends Importer
{
    protected static ?string $model = Kecamatan::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('code')
                ->requiredMapping()
                ->rules(['required', 'max:7']),
            ImportColumn::make('name')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
        ];
    }

    public function resolveRecord(): ?Kecamatan
    {
        return Kecamatan::firstOrNew([
            'kabupaten_code' => $this->data['kabupaten_code'],
            'code' => $this->data['code'],
            'name' => $this->data['name'],
            'meta' => json_encode(['lat' => $this->data['lat'], 'lon' => $this->data['lon']]),
        ]);

        // return new Kecamatan();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your kecamatan import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}

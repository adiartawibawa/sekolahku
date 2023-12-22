<?php

namespace App\Filament\Imports;

use App\Models\Desa;
use App\Models\Sekolah;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;
use Filament\Forms\Components\Checkbox;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Str;

class SekolahImporter extends Importer
{
    protected static ?string $model = Sekolah::class;

    // public static function getOptionsFormComponents(): array
    // {
    //     return [
    //         Checkbox::make('update_existing')
    //             ->label('Update existing records'),
    //     ];
    // }

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('sekolah_forms_code')
                ->label('Bentuk Pendidikan')
                ->guess(['bentuk_pendidikan'])
                ->requiredMapping()
                ->rules(['required', 'max:8']),
            ImportColumn::make('desa')
                ->label('Desa')
                ->rules(['nullable', 'max:10']),
            ImportColumn::make('kecamatan')
                ->label('Kecamatan'),
            ImportColumn::make('npsn')
                ->label('NPSN')
                ->requiredMapping()
                ->rules(['required', 'max:8']),
            ImportColumn::make('nama')
                ->label('Nama Sekolah')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('status')
                ->label('Status Sekolah')
                ->rules(['max:10']),
            ImportColumn::make('alamat')
                ->label('Alamat Sekolah')
                ->requiredMapping()
                ->rules(['required', 'max:65535']),
            ImportColumn::make('lintang')
                ->label('Lintang'),
            ImportColumn::make('bujur')
                ->label('Bujur'),
        ];
    }

    public function resolveRecord(): ?Sekolah
    {
        $desa = Desa::getCodeByDesaAndKecamatan($this->data['desa'], $this->data['kecamatan']);

        return Sekolah::firstOrCreate([
            'npsn' => $this->data['npsn'],
            'nama' => $this->data['nama'],
            'sekolah_forms_code' => $this->data['sekolah_forms_code'],
            'status' => $this->data['status'],
            'alamat' => $this->data['alamat'],
            'desa_code' => $desa,
            'meta' => json_encode(['lat' => $this->data['lintang'], 'lon' => $this->data['bujur']]),
        ]);
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your sekolah import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}

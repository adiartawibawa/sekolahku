<?php

namespace App\Filament\Imports;

use App\Models\Prasarana;
use App\Models\SarprasTanah;
use App\Models\Sekolah;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class SarprasTanahImporter extends Importer
{
    protected static ?string $model = SarprasTanah::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('npsn')
                ->label('NPSN')
                ->rules(['required']),
            ImportColumn::make('sekolah')
                ->label('Sekolah')
                ->requiredMapping()
                ->relationship()
                ->rules(['required']),
            ImportColumn::make('prasarana')
                ->label('Jenis Prasarana')
                ->requiredMapping()
                ->relationship()
                ->rules(['required']),
            ImportColumn::make('nama')
                ->label('Nama')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('no_sertifikat')
                ->label('No. Sertifikat')
                ->requiredMapping()
                ->rules(['required']),
            ImportColumn::make('panjang')
                ->label('Panjang Tanah')
                ->requiredMapping()
                ->rules(['required']),
            ImportColumn::make('lebar')
                ->label('Lebar Tanah')
                ->requiredMapping()
                ->rules(['required']),
            ImportColumn::make('luas')
                ->label('Luas Tanah')
                ->requiredMapping()
                ->numeric()
                ->rules(['required']),
            ImportColumn::make('luas_tersedia')
                ->label('Luas Tanah Tersedia')
                ->requiredMapping()
                ->numeric()
                ->rules(['required']),
            ImportColumn::make('kepemilikan')
                ->label('Kepemilikan')
                ->requiredMapping()
                ->rules(['required']),
            ImportColumn::make('njop')
                ->label('NJOP')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('keterangan')
                ->label('Keterangan')
                ->rules(['max:65535']),
        ];
    }

    public function resolveRecord(): ?SarprasTanah
    {
        $tanah = SarprasTanah::firstOrNew(
            [
                'sekolah_id' => Sekolah::where('npsn', $this->data['npsn'])->value('id'),
                'jenis_prasarana_id' => $this->data['prasarana'],
            ],
            [
                'nama' => $this->data['nama'],
                'no_sertifikat' => $this->data['no_sertifikat'],
                'panjang' => $this->data['panjang'],
                'lebar' => $this->data['lebar'],
                'luas' => $this->data['luas'],
                'luas_tersedia' => $this->data['luas_tersedia'],
                'kepemilikan' => $this->data['kepemilikan'],
                'njop' => $this->data['njop'],
                'keterangan' => $this->data['keterangan'],
            ]
        );

        return $tanah;

        // return new SarprasTanah();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your sarpras tanah import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}

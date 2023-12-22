<?php

namespace App\Filament\Imports;

use App\Models\SarprasBangunan;
use App\Models\SarprasTanah;
use App\Models\Sekolah;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class SarprasBangunanImporter extends Importer
{
    protected static ?string $model = SarprasBangunan::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('npsn')
                ->label('NPSN'),
            ImportColumn::make('sekolah')
                ->label('Sekolah')
                ->requiredMapping()
                ->relationship()
                ->rules(['required']),
            ImportColumn::make('jenis_prasarana_id')
                ->label('Jenis Prasarana')
                ->requiredMapping()
                ->numeric()
                ->rules(['required', 'integer']),
            ImportColumn::make('tanah')
                ->label('No. Sertipikat')
                ->requiredMapping()
                ->relationship()
                ->rules(['required']),
            ImportColumn::make('kode_bangunan')
                ->label('Kode Bangunan')
                ->rules(['max:25']),
            ImportColumn::make('nama')
                ->label('Nama Bangunan')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('panjang')
                ->label('Panjang Bangunan')
                ->requiredMapping()
                ->numeric()
                ->rules(['required']),
            ImportColumn::make('lebar')
                ->label('Lebar Bangunan')
                ->requiredMapping()
                ->numeric()
                ->rules(['required']),
            ImportColumn::make('luas_tapak_bangunan')
                ->label('Luas Tapak Bangunan')
                ->requiredMapping()
                ->numeric()
                ->rules(['required']),
            ImportColumn::make('kepemilikan')
                ->label('Status Kepemilikan')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('peminjam_meminjamkan')
                ->label('Peminjam/yang meminjamkan')
                ->rules(['max:255']),
            ImportColumn::make('nilai_aset')
                ->label('Nilai Aset')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('jml_lantai')
                ->label('Jumlah Lantai')
                ->requiredMapping()
                ->numeric()
                ->rules(['required', 'integer']),
            ImportColumn::make('tahun_bangun')
                ->label('Tahun dibangun')
                ->requiredMapping()
                ->rules(['required', 'date']),
            ImportColumn::make('keterangan')
                ->label('Keterangan')
                ->rules(['max:65535']),
            ImportColumn::make('tanggal_sk_pemakai')
                ->label('Tanggal SK Pemakai')
                ->requiredMapping()
                ->rules(['required', 'date']),
            ImportColumn::make('volume_pondasi')
                ->label('Volume Pondasi')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('volume_sloop')
                ->label('Volume Sloop')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('panjang_kuda')
                ->label('Panjang Kuda - Kuda')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('panjang_kaso')
                ->label('Panjang Kaso')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('panjang_reng')
                ->label('Panjang Reng')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('luas_tutup_atap')
                ->label('Luas Tutup Atas')
                ->numeric()
                ->rules(['integer']),
        ];
    }

    public function resolveRecord(): ?SarprasBangunan
    {
        return SarprasBangunan::firstOrNew(
            [
                'sekolah_id' => Sekolah::where('npsn', $this->data['npsn'])->value('id'),
                'tanah_id' => SarprasTanah::where('no_sertifikat', $this->data['tanah'])->value('id'),
                'kode_bangunan' => $this->data['kode_bangunan'],
            ],
            [
                'jenis_prasarana_id' => $this->data['prasarana'],
                'nama' => $this->data['nama'],
                'panjang' => $this->data['panjang'],
                'lebar' => $this->data['lebar'],
                'luas_tapak_bangunan' => $this->data['luas_tapak_bangunan'],
                'kepemilikan' => $this->data['kepemilikan'],
                'peminjam_meminjamkan' => $this->data['peminjam_meminjamkan'],
                'nilai_aset' => $this->data['nilai_aset'],
                'jml_lantai' => $this->data['jml_lantai'],
                'tahun_bangun' => $this->data['tahun_bangun'],
                'keterangan' => $this->data['keterangan'],
                'tanggal_sk_pemakai' => $this->data['tanggal_sk_pemakai'],
                'volume_pondasi' => $this->data['volume_pondasi'],
                'volume_sloop' => $this->data['volume_sloop'],
                'panjang_kuda' => $this->data['panjang_kuda'],
                'panjang_kaso' => $this->data['panjang_kaso'],
                'panjang_reng' => $this->data['panjang_reng'],
                'luas_tutup_atap' => $this->data['luas_tutup_atap'],
            ]
        );

        // return new SarprasBangunan();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your sarpras bangunan import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}

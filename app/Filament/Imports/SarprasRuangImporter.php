<?php

namespace App\Filament\Imports;

use App\Models\SarprasRuang;
use App\Models\Sekolah;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class SarprasRuangImporter extends Importer
{
    protected static ?string $model = SarprasRuang::class;

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
            ImportColumn::make('referensi_ruang_id')
                ->label('Referensi Ruang')
                ->requiredMapping()
                ->relationship()
                ->rules(['required']),
            ImportColumn::make('bangunan')
                ->label('Nama Bangunan')
                ->requiredMapping()
                ->relationship()
                ->rules(['required']),
            ImportColumn::make('kode_ruang')
                ->label('Kode Ruang')
                ->rules(['max:25']),
            ImportColumn::make('nama')
                ->label('Nama Ruang')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('registrasi_ruang')
                ->label('Registrasi Ruang')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('lantai_ke')
                ->label('Lantai Ke-')
                ->requiredMapping()
                ->numeric()
                ->rules(['required', 'integer']),
            ImportColumn::make('panjang')
                ->label('Panjang Ruang')
                ->requiredMapping()
                ->numeric()
                ->rules(['required']),
            ImportColumn::make('lebar')
                ->label('Lebar Ruang')
                ->requiredMapping()
                ->numeric()
                ->rules(['required']),
            ImportColumn::make('luas')
                ->label('Luas Ruang')
                ->requiredMapping()
                ->numeric()
                ->rules(['required']),
            ImportColumn::make('kapasitas')
                ->label('Kapasitas Ruang')
                ->requiredMapping()
                ->numeric()
                ->rules(['required']),
            ImportColumn::make('luas_plester')
                ->label('Luas Plester')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('luas_plafond')
                ->label('Luas Plafond')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('luas_dinding')
                ->label('Luas Dinding')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('luas_daun_jendela')
                ->label('Luas Daun Jendela')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('luas_daun_pintu')
                ->label('Luas Daun Pintu')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('panjang_kusen')
                ->label('Panjang Kusen')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('luas_tutup_lantai')
                ->label('Luas Tutup Lantai')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('luas_instalasi_listrik')
                ->label('Luas Instalasi Listrik')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('jumlah_instalasi_listrik')
                ->label('Jumlah Instalasi Listrik')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('panjang_instalasi_air')
                ->label('Panjang Instalasi Air')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('jumlah_instalasi_air')
                ->label('Jumlah Instalasi Air')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('panjang_drainase')
                ->label('Panjang Darinase')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('luas_finish_struktur')
                ->label('Luas Finish Struktur')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('luas_finish_plafond')
                ->label('Luas Finish Plafond')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('luas_finish_dinding')
                ->label('Luas Finish Dinding')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('luas_finish_kjp')
                ->label('Luas Finish KJP')
                ->numeric()
                ->rules(['integer']),
        ];
    }

    public function resolveRecord(): ?SarprasRuang
    {
        return SarprasRuang::firstOrNew(
            [
                'sekolah_id' => Sekolah::where('npsn', $this->data['npsn'])->value('id'),
                'kode_ruang' => $this->data['kode_ruang'],
                'bangunan_id' => $this->data['kode_bangunan'],
            ],
            [
                'referensi_ruang_id' => $this->data['referensi_ruang_id'],
                'nama' => $this->data['nama'],
                'registrasi_ruang' => $this->data['registrasi_ruang'],
                'lantai_ke' => $this->data['lantai_ke'],
                'panjang' => $this->data['panjang'],
                'lebar' => $this->data['lebar'],
                'luas' => $this->data['luas'],
                'kapasitas' => $this->data['kapasitas'],
                'luas_plester' => $this->data['luas_plester'],
                'luas_plafond' => $this->data['luas_plafond'],
                'luas_dinding' => $this->data['luas_dinding'],
                'luas_daun_jendela' => $this->data['luas_daun_jendela'],
                'luas_daun_pintu' => $this->data['luas_daun_pintu'],
                'panjang_kusen' => $this->data['panjang_kusen'],
                'luas_tutup_lantai' => $this->data['luas_tutup_lantai'],
                'luas_instalasi_listrik' => $this->data['luas_instalasi_listrik'],
                'jumlah_instalasi_listrik' => $this->data['jumlah_instalasi_listrik'],
                'panjang_instalasi_air' => $this->data['panjang_instalasi_air'],
                'jumlah_instalasi_air' => $this->data['jumlah_instalasi_air'],
                'panjang_drainase' => $this->data['panjang_drainase'],
                'luas_finish_struktur' => $this->data['luas_finish_struktur'],
                'luas_finish_plafond' => $this->data['luas_finish_plafond'],
                'luas_finish_dinding' => $this->data['luas_finish_dinding'],
                'luas_finish_kjp' => $this->data['luas_finish_kjp'],
            ]
        );

        // return new SarprasRuang();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your sarpras ruang import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}

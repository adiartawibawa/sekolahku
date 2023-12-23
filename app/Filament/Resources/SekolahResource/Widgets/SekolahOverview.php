<?php

namespace App\Filament\Resources\SekolahResource\Widgets;

use App\Filament\Resources\SekolahResource\Pages\ListSekolahs;
use App\Models\Kecamatan;
use App\Models\Sekolah;
use Filament\Widgets\Concerns\InteractsWithPageTable;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Database\Eloquent\Builder;

class SekolahOverview extends BaseWidget
{
    use InteractsWithPageTable;

    protected static ?string $pollingInterval = '10s';

    protected function getTablePage(): string
    {
        return ListSekolahs::class;
    }

    protected function getStats(): array
    {
        $data = $this->getPageTableQuery()
            ->get()
            ->groupBy('desa.kecamatan.name')
            ->map(function ($group) {
                return $group->countBy('sekolah_forms_code')->values();
            });
        // dd(json_decode($data['KUTA SELATAN'], true));
        return [
            // Kuta Selatan
            Stat::make('Sekolah di Kuta Selatan', $data['KUTA SELATAN']->sum())
                ->chart(json_decode($data['KUTA SELATAN'], true))
                ->color('success'),

            // Kuta
            Stat::make('Sekolah di Kuta', $data['KUTA']->sum())
                ->chart(json_decode($data['KUTA'], true))
                ->color('success'),

            //Kuta Utara
            Stat::make('Sekolah di Kuta Utara', $data['KUTA UTARA']->sum())
                ->chart(json_decode($data['KUTA UTARA'], true))
                ->color('success'),

            //Mengwi
            Stat::make('Sekolah di Mengwi', $data['MENGWI']->sum())
                ->chart(json_decode($data['MENGWI'], true))
                ->color('success'),

            // Abiansemal
            Stat::make('Sekolah di Abiansemal', $data['ABIANSEMAL']->sum())
                ->chart(json_decode($data['ABIANSEMAL'], true))
                ->color('success'),

            // Petang
            Stat::make('Sekolah di Petang', $data['PETANG']->sum())
                ->chart(json_decode($data['PETANG'], true))
                ->color('success'),

        ];
    }
}

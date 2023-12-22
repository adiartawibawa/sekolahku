<?php

namespace App\Filament\Resources\SekolahResource\Widgets;

use App\Filament\Resources\SekolahResource\Pages\ListSekolahs;
use Filament\Widgets\Concerns\InteractsWithPageTable;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class SekolahOverview extends BaseWidget
{
    use InteractsWithPageTable;

    protected function getTablePage(): string
    {
        return ListSekolahs::class;
    }

    protected function getStats(): array
    {
        return [
            Stat::make('Total Sekolah', $this->getPageTableQuery()->count()),

            Stat::make(
                'Total SD',
                $this->getPageTableQuery()->whereHas('bentuk', function ($query) {
                    $query->where('code', 'SD');
                })->count()
            ),

            Stat::make(
                'Total SMP',
                $this->getPageTableQuery()->whereHas('bentuk', function ($query) {
                    $query->where('code', 'SMP');
                })->count()
            ),
        ];
    }
}

<?php

namespace App\Filament\Resources\GuruTendikResource\Widgets;

use App\Filament\Resources\GuruTendikResource\Pages\ListGuruTendiks;
use Filament\Widgets\Concerns\InteractsWithPageTable;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class GuruTendikOverview extends BaseWidget
{
    use InteractsWithPageTable;

    protected static ?string $pollingInterval = '10s';

    protected function getTablePage(): string
    {
        return ListGuruTendiks::class;
    }

    protected function getStats(): array
    {
        $datas = $this->getPageTableQuery()->with('kepegawaian')
            ->get()
            ->countBy('kepegawaian.status_kepegawaian');

        foreach ($datas as $key => $item) {
            $data[] = Stat::make($key, $item);
        }

        return $data;
    }
}

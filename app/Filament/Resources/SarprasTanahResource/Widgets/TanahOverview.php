<?php

namespace App\Filament\Resources\SarprasTanahResource\Widgets;

use App\Filament\Resources\SarprasTanahResource\Pages\ManageSarprasTanahs;
use Filament\Widgets\Concerns\InteractsWithPageTable;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TanahOverview extends BaseWidget
{
    use InteractsWithPageTable;

    protected static ?string $pollingInterval = '10s';

    protected function getTablePage(): string
    {
        return ManageSarprasTanahs::class;
    }

    protected function getStats(): array
    {
        $datas = $this->getPageTableQuery()
            ->get()
            ->countBy('kepemilikan');

        $data[] = null;
        foreach ($datas as $key => $item) {
            $data[] = Stat::make($key, $item);
        }

        return $data;
    }
}

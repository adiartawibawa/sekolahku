<?php

namespace App\Filament\Resources\GuruTendikResource\Widgets;

use App\Filament\Resources\GuruTendikResource\Pages\ListGuruTendiks;
use Filament\Widgets\ChartWidget;
use Filament\Widgets\Concerns\InteractsWithPageTable;

class GuruTendikChart extends ChartWidget
{
    use InteractsWithPageTable;

    protected static ?string $heading = 'Grafik PTK';

    protected int | string | array $columnSpan = 'full';

    protected static ?string $maxHeight = '400px';

    protected function getTablePage(): string
    {
        return ListGuruTendiks::class;
    }

    protected function getData(): array
    {
        $datas = $this->getPageTableQuery()->with('kepegawaian')
            ->get()
            ->countBy('kepegawaian.jenis_ptk');

        $data[] = null;
        $label[] = null;
        foreach ($datas as $key => $value) {
            $data[] = $value;
            $label[] = $key;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah',
                    'data' => $data,
                    'backgroundColor' => [
                        '#f97316', '#84cc16', '#10b981', '#06b6d4', '#6366f1', '#d946ef',
                    ],
                    'borderColor' => [
                        '#fff7ed', '#f7fee7', '#ecfdf5', '#ecfeff', '#eef2ff', '#fdf4ff',
                    ],
                ],
            ],
            'labels' => $label,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}

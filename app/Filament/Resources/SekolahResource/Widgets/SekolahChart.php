<?php

namespace App\Filament\Resources\SekolahResource\Widgets;

use App\Filament\Resources\SekolahResource\Pages\ListSekolahs;
use Filament\Widgets\ChartWidget;
use Filament\Widgets\Concerns\InteractsWithPageTable;

class SekolahChart extends ChartWidget
{
    protected static ?string $heading = 'Grafik Sekolah di Badung';

    protected int | string | array $columnSpan = 'full';

    protected static ?string $maxHeight = '300px';

    use InteractsWithPageTable;

    protected function getTablePage(): string
    {
        return ListSekolahs::class;
    }

    private function sekolahData()
    {
        $data = $this->getPageTableQuery()->get()->countBy('sekolah_forms_code')
            ->map(function ($value, $key) {
                return [
                    'key' => $key,
                    'value' => $value,
                ];
            });

        return $data;
    }

    protected function getData(): array
    {
        $datas = $this->sekolahData();

        foreach ($datas as $item) {
            $data[] = $item['value'];
            $label[] = $item['key'];
        }
        // dd($data);
        return [
            'datasets' => [
                [
                    'label' => 'Sekolah',
                    'data' => $data,
                    'backgroundColor' => [
                        '#ef4444', '#f97316', '#84cc16', '#10b981', '#06b6d4', '#6366f1', '#d946ef',
                    ],
                    'borderColor' => [
                        '#fef2f2', '#fff7ed', '#f7fee7', '#ecfdf5', '#ecfeff', '#eef2ff', '#fdf4ff',
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

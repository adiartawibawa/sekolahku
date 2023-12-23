<?php

namespace App\Filament\Resources\SekolahResource\Widgets;

use App\Filament\Resources\SekolahResource\Pages\ListSekolahs;
use Filament\Widgets\ChartWidget;
use Filament\Widgets\Concerns\InteractsWithPageTable;

class SekolahChart extends ChartWidget
{
    protected static ?string $heading = 'Grafik Sekolah di Badung';

    protected int | string | array $columnSpan = 'full';
    protected static ?string $maxHeight = '400px';

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
                    'label' => 'Sekolah di Badung',
                    'data' => $data,
                    'backgroundColor' => '#10b981',
                    'borderColor' => '#ecfdf5',
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

<?php

namespace App\Filament\Resources\SekolahResource\Widgets;

use Filament\Widgets\Concerns\InteractsWithPageTable;
use Filament\Widgets\Widget;

class SekolahCustomOverview extends Widget
{
    protected static string $view = 'filament.resources.sekolah-resource.widgets.sekolah-custom-overview';

    use InteractsWithPageTable;

    protected function getTablePage(): string
    {
        return ListSekolahs::class;
    }
}

<?php

namespace Database\Seeders;

use App\Models\Prasarana;
use App\Models\ReferensiRuang;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SarprasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $prasaranas = Prasarana::defaultJenisPrasarana();

        foreach ($prasaranas as $item) {
            Prasarana::firstOrCreate($item);
        }

        $this->command->info('Default jenis prasarana ditambahkan.');

        $referensis = ReferensiRuang::defaultReferensiRuang();

        foreach ($referensis as $item) {
            ReferensiRuang::firstOrCreate($item);
        }

        $this->command->info('Default referensi ruang ditambahkan.');
    }
}

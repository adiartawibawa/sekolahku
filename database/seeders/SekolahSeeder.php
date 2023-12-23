<?php

namespace Database\Seeders;

use App\Models\SekolahForm;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SekolahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sekolahForm = SekolahForm::defaultSekolahForm();

        foreach ($sekolahForm as $item) {
            SekolahForm::firstOrCreate($item);
        }

        $this->command->info('Default jenis bentukan sekolah ditambahkan.');
    }
}

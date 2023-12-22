<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SekolahForm extends Model
{
    protected $table = 'sekolah_forms';

    protected $fillable = ['code', 'name', 'desc'];

    protected $searchableColumns = ['code', 'name', 'desc'];

    public static function defaultSekolahForm()
    {
        return [
            ['code' => 'TPA', 'name' => 'Tempat Penitipan Anak', 'desc' => 'Tempat Penitipan Anak'],
            ['code' => 'KB', 'name' => 'Kelompok Belajar', 'desc' => 'Kelompok Belajar'],
            ['code' => 'TK', 'name' => 'Taman Kanak - Kanak', 'desc' => 'Taman Kanak - Kanak'],
            ['code' => 'SD', 'name' => 'Sekolah Dasar', 'desc' => 'Sekolah Dasar'],
            ['code' => 'SMP', 'name' => 'Sekolah Menengah Pertama', 'desc' => 'Sekolah Menengah Pertama'],
            ['code' => 'SKB', 'name' => 'Sanggar Kegiatan Belajar', 'desc' => 'Sanggar Kegiatan Belajar'],
            ['code' => 'PKBM', 'name' => 'Pusat Kegiatan Belajar Masyarakat', 'desc' => 'Pusat Kegiatan Belajar Masyarakat'],
        ];
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TugasGuruTendik extends Model
{
    protected $table = 'tugas_gtks';

    protected $fillable = [
        'sekolah_id',
        'guru_tendik_id',
        'status_tugas',
        'mapel_ajar',
        'jam_mengajar',
        'tahun',
        'semester'
    ];

    public function gtk()
    {
        return $this->belongsTo(GuruTendik::class, 'guru_tendik_id', 'id');
    }

    public function sekolah()
    {
        return $this->belongsTo(Sekolah::class, 'sekolah_id', 'id');
    }
}

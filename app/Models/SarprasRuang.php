<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class SarprasRuang extends Model implements HasMedia
{
    use HasUuids;
    use InteractsWithMedia;

    protected $table = 'ruangs';

    protected $fillable = [
        'sekolah_id',
        'referensi_ruang_id',
        'bangunan_id',
        'kode_ruang',
        'nama',
        'registrasi_ruang',
        'lantai_ke',
        'panjang',
        'lebar',
        'luas',
        'kapasitas',
        'luas_plester',
        'luas_plafond',
        'luas_dinding',
        'luas_daun_jendela',
        'luas_daun_pintu',
        'panjang_kusen',
        'luas_tutup_lantai',
        'luas_instalasi_listrik',
        'jumlah_instalasi_listrik',
        'panjang_instalasi_air',
        'jumlah_instalasi_air',
        'panjang_drainase',
        'luas_finish_struktur',
        'luas_finish_plafond',
        'luas_finish_dinding',
        'luas_finish_kjp'
    ];

    public function referensiRuangPrasarana(): BelongsTo
    {
        return $this->belongsTo(ReferensiRuang::class, 'jenis_prasarana_id', 'id');
    }

    public function bangunan(): BelongsTo
    {
        return $this->belongsTo(SarprasBangunan::class, 'tanah_id', 'id');
    }

    public function sekolah(): BelongsTo
    {
        return $this->belongsTo(Sekolah::class, 'sekolah_id', 'id');
    }
}

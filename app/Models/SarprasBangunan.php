<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SarprasBangunan extends Model
{
    use HasUuids;

    protected $table = 'bangunans';

    protected $fillable = [
        'sekolah_id',
        'jenis_prasarana_id',
        'tanah_id',
        'kode_bangunan',
        'nama',
        'panjang',
        'lebar',
        'luas_tapak_bangunan',
        'kepemilikan',
        'peminjam_meminjamkan',
        'nilai_aset',
        'jml_lantai',
        'tahun_bangun',
        'keterangan',
        'tanggal_sk_pemakai',
        'volume_pondasi',
        'volume_sloop',
        'panjang_kuda',
        'panjang_kaso',
        'panjang_reng',
        'luas_tutup_atap'
    ];

    public function prasarana(): BelongsTo
    {
        return $this->belongsTo(Prasarana::class, 'jenis_prasarana_id', 'id');
    }

    public function tanah(): BelongsTo
    {
        return $this->belongsTo(SarprasTanah::class, 'tanah_id', 'id');
    }

    public function sekolah(): BelongsTo
    {
        return $this->belongsTo(Sekolah::class, 'sekolah_id', 'id');
    }
}

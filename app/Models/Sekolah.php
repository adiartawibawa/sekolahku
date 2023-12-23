<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Sekolah extends Model implements HasMedia
{
    use InteractsWithMedia;
    use HasUuids;
    use SoftDeletes;

    protected $fillable = [
        'npsn',
        'nama',
        'sekolah_forms_code',
        'status',
        'alamat',
        'desa_code',
        'meta'
    ];

    protected $searchableColumns = ['npsn', 'nama', 'status', 'desa.name', 'bentuk.name'];

    public function desa()
    {
        return $this->belongsTo(Desa::class, 'desa_code', 'code');
    }

    public function bentuk()
    {
        return $this->belongsTo(SekolahForm::class, 'sekolah_forms_code', 'code');
    }

    public function pegawais()
    {
        return $this->hasMany(TugasGuruTendik::class, 'sekolah_id', 'id');
    }
}

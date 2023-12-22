<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GuruTendik extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasUuids;

    protected $fillable = [
        'user_id',
        'nama',
        'nik',
        'nuptk',
        'nip',
        'gender',
        'tempat_lahir',
        'tanggal_lahir',
        'no_telp'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function tugas()
    {
        return $this->hasMany(TugasGuruTendik::class, 'guru_tendik_id', 'id');
    }

    public function kepegawaian()
    {
        return $this->hasOne(KepegawaianGuruTendik::class, 'guru_tendik_id', 'id');
    }
}

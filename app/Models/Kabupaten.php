<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kabupaten extends Model
{
    protected $fillable = ['code', 'provinsi_code', 'name', 'meta'];

    protected $searchableColumns = ['code', 'name', 'provinsi.name'];

    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class, 'provinsi_code', 'code');
    }

    public function kecamatans()
    {
        return $this->hasMany(Kecamatan::class, 'kabupaten_code', 'code');
    }

    public function desas()
    {
        return $this->hasManyThrough(
            Desa::class,
            Kecamatan::class,
            'kabupaten_code',
            'kecamatan_code',
            'code',
            'code'
        );
    }

    public function getProvinsiNameAttribute()
    {
        return $this->provinsi->name;
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    protected $fillable = ['code', 'kabupaten_code', 'name', 'meta'];

    protected $searchableColumns = ['code', 'name', 'kabupaten.name'];

    public function kabupaten()
    {
        return $this->belongsTo(Kabupaten::class, 'kabupaten_code', 'code');
    }

    public function desas()
    {
        return $this->hasMany(Desa::class, 'kecamatan_code', 'code');
    }

    public function getKabupatenNameAttribute()
    {
        return $this->kabupaten->name;
    }

    public function getProvinsiNameAttribute()
    {
        return $this->kabupaten->provinsi->name;
    }
}

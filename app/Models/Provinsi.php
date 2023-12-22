<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Provinsi extends Model
{
    protected $fillable = ['code', 'name', 'meta'];

    public function cities()
    {
        return $this->hasMany(Kabupaten::class, 'provinsi_code', 'code');
    }

    public function districts()
    {
        return $this->hasManyThrough(
            Kecamatan::class,
            Kabupaten::class,
            'provinsi_code',
            'kabupaten_code',
            'code',
            'code'
        );
    }
}

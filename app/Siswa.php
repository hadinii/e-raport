<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'siswa';
    protected $guarded = ['id'];

    // Setters
    public function setIsAktifAttribute($value)
    {
        $value && $this->tahun_keluar = null;
        $this->attributes['is_aktif'] = $value;
    }

    // Relations
    public function kelas()
    {
        return $this->hasMany('App\Raport', 'siswa_id');
    }
}

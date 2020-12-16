<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = 'kelas';
    protected $guarded = ['id'];

    protected $appends = [
        'tingkat',
        'jumlah_siswa',
        'jumlah_mapel'
    ];

    public function getTingkatAttribute()
    {
        return $this->tingkat()->first()->nama;
    }

    public function getJumlahSiswaAttribute()
    {
        return $this->siswa()->count();
    }

    public function getJumlahMapelAttribute()
    {
        return $this->pelajaran()->count();
    }

    public function tingkat()
    {
        return $this->belongsTo('App\Tingkat');
    }

    public function wali_kelas()
    {
        return $this->belongsTo('App\User', 'wali_kelas_id');
    }

    public function siswa()
    {
        return $this->hasMany('App\Raport', 'kelas_id');
    }

    public function pelajaran()
    {
        return $this->hasMany('App\Jadwal', 'pelajaran_id');
    }
}

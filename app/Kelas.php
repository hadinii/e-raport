<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = 'kelas';
    protected $guarded = ['id'];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'tingkat',
        'jumlah_siswa',
        'jumlah_mapel'
    ];

    // Getters
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

    // Relations
    public function tingkat()
    {
        return $this->belongsTo('App\Tingkat');
    }

    public function wali_kelas()
    {
        return $this->belongsTo('App\User');
    }

    public function siswa()
    {
        return $this->hasMany('App\Raport', 'kelas_id');
    }

    public function pelajaran()
    {
        return $this->hasMany('App\Jadwal', 'pelajaran_id');
    }

    public function tahun_ajaran()
    {
        return $this->belongsTo('App\TahunAjaran');
    }
}

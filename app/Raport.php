<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Raport extends Model
{
    protected $table = 'raport';
    protected $guarded = ['id'];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'nama_siswa',
        'nama_kelas',
        'nama_tahun_ajaran',
    ];

    // Gettters
    public function getNamaSiswaAttribute()
    {
        return $this->siswa()
            ->first()
            ->nama;
    }

    public function getNamaKelasAttribute()
    {
        return $this->kelas()->first()->nama_lengkap;
    }

    public function getNamaTahunAjaranAttribute()
    {
        return $this->tahun_ajaran()
            ->first()
            ->nama;
    }

    // Relations
    public function siswa()
    {
        return $this->belongsTo('App\Siswa');
    }

    public function tahun_ajaran()
    {
        return $this->belongsTo('App\TahunAjaran');
    }

    public function kelas()
    {
        return $this->belongsTo('App\Kelas');
    }

    public function nilai()
    {
        return $this->hasMany('App\Nilai');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Raport extends Model
{
    protected $table = 'raport';
    protected $guarded = ['id'];

    protected $attributes = [
        'ekskul' => '[]'
    ];

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

    public function getEkskulAttribute($value)
    {
        return json_decode($value);
    }

    public function getNilai()
    {
        return $this->nilai()
            ->with('pelajaran')
            ->get();
    }

    public function getPrestasi()
    {
        return $this->prestasi()
            ->get();
    }

    public function getSiswa()
    {
        return $this->siswa()->first();
    }

    public function getKelas()
    {
        return $this->kelas()->first();
    }

    public function getTahunAjaran()
    {
        return $this->tahun_ajaran()->first();
    }

    // Setters
    public function setEkskulAttribute($value)
    {
        $this->attributes['ekskul'] = json_encode($value);
    }

    public function addNewEkskul($value)
    {
        $ekskul = $this->ekskul;
        foreach ($ekskul as $row) {
            if ($row->ekskul->id == $value['ekskul']->id) {
                return;
            }
        }
        array_push($ekskul, $value);
        $this->update(['ekskul' => $ekskul]);
    }

    public function removeEkskul($value)
    {
        $ekskul = $this->ekskul;
        foreach ($ekskul as $index => $row) {
            if ($row->ekskul->id == $value) {
                unset($ekskul[$index]);
            }
        }
        $this->update(['ekskul' => $ekskul]);
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

    public function prestasi()
    {
        return $this->hasMany('App\Prestasi');
    }
}

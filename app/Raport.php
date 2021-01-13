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
    ];

    // Gettters
    public function getNamaSiswaAttribute()
    {
        return $this->siswa()
            ->first()
            ->nama;
    }

    // Relations
    public function siswa()
    {
        return $this->belongsTo('App\Siswa');
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

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Raport extends Model
{
    protected $table = 'raport';
    protected $guarded = ['id'];

    public function siswa()
    {
        return $this->belongsTo('App\Siswa');
    }

    public function kelas()
    {
        return $this->belongsTo('App\Kelas');
    }
}

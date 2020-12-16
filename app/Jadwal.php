<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected $table = 'jadwal';
    protected $guarded = ['id'];

    public function guru()
    {
        return $this->belongsTo('App\User');
    }

    public function kelas()
    {
        return $this->belongsTo('App\Kelas');
    }

    public function pelajaran()
    {
        return $this->belongsTo('App\Pelajaran');
    }
}

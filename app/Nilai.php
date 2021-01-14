<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    protected $table = 'nilai';
    protected $guarded = ['id'];

    // Relations
    public function pelajaran()
    {
        return $this->belongsTo('App\Pelajaran');
    }

    public function raport()
    {
        return $this->belongsTo('App\Raport');
    }
}

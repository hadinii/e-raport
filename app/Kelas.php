<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = 'kelas';
    protected $guarded = ['id'];

    public function tingat()
    {
        return $this->belongsTo('App\Tingkat');
    }
}

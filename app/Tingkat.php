<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tingkat extends Model
{
    protected $table = 'tingkat';
    protected $guarded = ['id'];

    // Relations
    public function kelas()
    {
        return $this->hasMany('App\Kelas');
    }
}

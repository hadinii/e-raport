<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kurikulum extends Model
{
    protected $table = 'kurikulum';
    protected $guarded = ['id'];

    // Relations
    public function pelajaran()
{
    return $this->hasMany('App\Pelajaran');
}
}



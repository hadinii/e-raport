<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kurikulum extends Model
{
    protected $table = 'kurikulum';
    protected $guarded = ['id'];

    // Getters
    public static function getAll()
    {
        return self::latest()->get();
    }

    // Relations
    public function semester()
    {
        return $this->belongsToMany('App\TahunAjaran');
    }
}

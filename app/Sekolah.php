<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sekolah extends Model
{
    protected $table = 'sekolah';
    protected $guarded = ['id'];

    // Getters
    public static function getSekolah()
    {
        return self::first();
    }
}

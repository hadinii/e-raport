<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pelajaran extends Model
{
    protected $table = 'pelajaran';
    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at',
    ];

    // Relations
    public function kurikulum()
    {
        return $this->belongsTo('App\Kurikulum');
    }

    public function jadwal()
    {
        return $this->hasMany('App\Jadwal');
    }
}

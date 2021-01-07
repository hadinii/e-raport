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

    // Getters
    public static function getByKurikulum($kurikulum_id = null)
    {
        return self::when($kurikulum_id, function ($q) use ($kurikulum_id) {
            return $q->where('kurikulum_id', $kurikulum_id);
        })
            ->latest()
            ->get();
    }

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

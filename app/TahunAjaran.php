<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TahunAjaran extends Model
{
    protected $table = 'tahun_ajaran';
    protected $guarded = ['id'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'tanggal_raport' => 'datetime',
    ];

    public function setIsAktifAttribute($value)
    {
        if ($value) {
            $allSemester = TahunAjaran::where('id', '!=', $this->id);
            $allSemester->update(['is_aktif' => 0]);
        }
        $this->attributes['is_aktif'] = $value;
    }
}

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

    // Getters
    public static function getActive()
    {
        return TahunAjaran::where('is_aktif', 1)->first();
    }

    public static function getAll()
    {
        return TahunAjaran::latest()->get();
    }

    // Setters
    public function setIsAktifAttribute($value)
    {
        if ($value) {
            $allSemester = TahunAjaran::where('id', '!=', $this->id);
            $allSemester->update(['is_aktif' => 0]);
        }
        $this->attributes['is_aktif'] = $value;
    }

    // Relations
    public function kelas()
    {
        return $this->hasMany('App\Kelas', 'tahun_ajaran_id');
    }
}

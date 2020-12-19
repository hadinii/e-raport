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

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'kurikulum',
        'nama'
    ];

    // Getters
    public static function getAll()
    {
        return self::latest()
            ->get();
    }

    public static function getActive()
    {
        return self::where('is_aktif', 1)
            ->with(['kelas'])
            ->first();
    }

    public function getPelajaran()
    {
        return $this->kurikulum()
            ->pelajaran;
    }

    public function getTanggalRaportAttribute($value)
    {
        return $this->castAttribute('tanggal_raport', $value)
            ->format('d F Y');
    }

    public function getKurikulumAttribute()
    {
        return $this->kurikulum()
            ->first()
            ->nama;
    }

    public function getNamaAttribute()
    {
        return "{$this->tahun_aktif} - {$this->semester}";
    }

    // Setters
    public function setIsAktifAttribute($value)
    {
        if ($value) {
            $allSemester = self::where('id', '!=', $this->id);
            $allSemester->update(['is_aktif' => 0]);
        }
        $this->attributes['is_aktif'] = $value;
    }

    // Relations
    public function kelas()
    {
        return $this->hasMany('App\Kelas', 'tahun_ajaran_id');
    }

    public function kurikulum()
    {
        return $this->belongsTo('App\Kurikulum')->first();
    }
}

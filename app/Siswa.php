<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'siswa';
    protected $guarded = ['id'];

    // Getters
    public static function getAll($semester = null, $status = null)
    {
        return self::with('kelas')
            ->when($status, function ($q) use ($status) {
                return $q->where('is_aktif', $status == 'Aktif');
            })
            ->when($semester, function ($q) use ($semester) {
                return $q->whereHas('kelas', function ($q) use ($semester) {
                    return $q->where('tahun_ajaran_id', $semester);
                });
            })
            ->latest()
            ->get();
    }

    public static function getActive()
    {
        return self::where('is_aktif', 1)
            ->latest()
            ->pluck('id', 'nama');
    }

    // Setters
    public function setIsAktifAttribute($value)
    {
        $value && $this->tahun_keluar = null;
        $this->attributes['is_aktif'] = $value;
    }

    public function setTanggalLahirAttribute($value)
    {
        $this->attributes['tanggal_lahir'] = date('d F Y', strtotime($value));
    }

    // Relations
    public function kelas()
    {
        return $this->hasMany('App\Raport', 'siswa_id');
    }
}

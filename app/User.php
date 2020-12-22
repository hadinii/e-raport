<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama', 'nip', 'password', 'is_aktif'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // Setters
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    // Getters
    public static function getAll()
    {
        return self::where('role', 'Non-Admin')
            ->latest()
            ->get();
    }

    public static function getActive()
    {
        return self::where('role', 'Non-Admin')
            ->where('is_aktif', 1)
            ->latest()
            ->pluck('id', 'nama');
    }

    public function getKelas()
    {
        return $this->kelas()
            ->with('tahun_ajaran')
            ->latest()
            ->get();
    }

    public function getJadwal()
    {
        return $this->pelajaran()
            ->with('pelajaran', 'kelas.tahun_ajaran')
            ->latest()
            ->get();
    }

    // Relations
    public function pelajaran()
    {
        return $this->hasMany('App\Jadwal', 'guru_id');
    }

    public function kelas()
    {
        return $this->hasMany('App\Kelas', 'wali_kelas_id');
    }
}

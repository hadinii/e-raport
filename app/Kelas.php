<?php

namespace App;

use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = 'kelas';
    protected $guarded = ['id'];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'nama_lengkap',
        'tingkat',
        'wali_kelas',
        'jumlah_siswa',
        'jumlah_mapel'
    ];

    protected static function boot()
    {
        parent::boot();
        // Override on create
        self::creating(function (Kelas $model) {
            $model->setSemester();
        });
        // Override on delete
        self::deleting(function (Kelas $model) {
            $model->pelajaran()->each(function ($pelajaran) {
                $pelajaran->delete();
            });
            $model->siswa()->each(function ($siswa) {
                $siswa->delete();
            });
        });
    }

    // Getters
    public function getNamaLengkapAttribute()
    {
        return "{$this->getTingkatAttribute()} - {$this->nama}";
    }

    public function getTingkatAttribute()
    {
        return $this->tingkat()->nama;
    }

    public function getWaliKelasAttribute()
    {
        return $this->wali_kelas();
    }

    public function getJumlahSiswaAttribute()
    {
        return $this->siswa()
            ->count();
    }

    public function getJumlahMapelAttribute()
    {
        return $this->pelajaran()
            ->count();
    }

    public function getPelajaran()
    {
        return $this->pelajaran()
            ->with('pelajaran', 'guru')
            ->get();
    }

    public function getSiswa()
    {
        return $this->siswa()
            ->with('siswa')
            ->get();
    }

    // Setters
    public function setPelajaran($pelajaran)
    {
        foreach ($pelajaran as $row) {
            $this->pelajaran()->create([
                'kelas_id' => $this->id,
                'pelajaran_id' => $row,
                'guru_id' => null
            ]);
        }
    }

    public function setSemester()
    {
        $currentSemester = TahunAjaran::getActive();
        if (is_null($currentSemester)) {
            Log::error('Tidak ada semester aktif');
            return false;
        }
        $this->tahun_ajaran_id = $currentSemester->id;
    }

    // Relations
    public function tingkat()
    {
        return $this->belongsTo('App\Tingkat')->first();
    }

    public function wali_kelas()
    {
        return $this->belongsTo('App\User')->first();
    }

    public function tahun_ajaran()
    {
        return $this->belongsTo('App\TahunAjaran')->first();
    }
    public function siswa()
    {
        return $this->hasMany('App\Raport', 'kelas_id');
    }

    public function pelajaran()
    {
        return $this->hasMany('App\Jadwal', 'kelas_id');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected $table = 'jadwal';
    protected $guarded = ['id'];

    // Getters
    public function getPelajaran()
    {
        return $this->pelajaran()
            ->first();
    }

    public function getKelas()
    {
        return $this->kelas()
            ->first();
    }

    public function getRaport()
    {
        return $this->kelas()
            ->first()
            ->getSiswa($this->pelajaran_id);
    }

    public function getNilai()
    {
        $raport = self::getRaport();

        $data = collect();
        foreach ($raport as $row) {
            $nilai = Nilai::with('raport')->firstOrCreate(['raport_id' => $row->id, 'pelajaran_id' => $this->pelajaran_id]);
            $data->push($nilai);
        }
        return $data;
    }

    public function getSemester()
    {
        return $this->kelas()
            ->first()
            ->getSemester();
    }

    // Relations
    public function guru()
    {
        return $this->belongsTo('App\User');
    }

    public function kelas()
    {
        return $this->belongsTo('App\Kelas');
    }

    public function pelajaran()
    {
        return $this->belongsTo('App\Pelajaran');
    }
}

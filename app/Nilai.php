<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    protected $table = 'nilai';
    protected $guarded = ['id'];

    // Relations
    public function pelajaran()
    {
        return $this->belongsTo('App\Pelajaran');
    }

    public function raport()
    {
        return $this->belongsTo('App\Raport');
    }

    public function setNilaiPengetahuanAttribute($value)
    {
        $this->attributes['nilai_pengetahuan'] = ($value);

        $deskripsi = "-";

        if($value <= 70 && $value>=0){
            $deskripsi = "Kurang";
        } elseif($value<=79) {
            $deskripsi = "Cukup";
        } elseif($value<=89) {
            $deskripsi = "Baik";
        } elseif($value<=100) {
            $deskripsi = "Sangat Baik";
        } else{
            $deskripsi = "-";
        }

        $this->attributes['deskripsi_pengetahuan'] = $deskripsi;
    }

    public function setNilaiKeterampilanAttribute($value)
    {
        $this->attributes['nilai_keterampilan'] = ($value);

        $deskripsi = "-";

        if($value <= 70 && $value>=0){
            $deskripsi = "Kurang";
        } elseif($value<=79) {
            $deskripsi = "Cukup";
        } elseif($value<=89) {
            $deskripsi = "Baik";
        } elseif($value<=100) {
            $deskripsi = "Sangat Baik";
        } else{
            $deskripsi = "-";
        }

        $this->attributes['deskripsi_keterampilan'] = $deskripsi;
    }
}

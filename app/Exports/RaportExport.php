<?php

namespace App\Exports;

use App\Kelas;
use App\Raport;
use App\TahunAjaran;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
// use Maatwebsite\Excel\Concerns\WithColumnFormatting;

class RaportExport implements FromQuery, WithMapping, WithHeadings
{
    protected $raport;

    public function __construct(Kelas $kelas)
    {
        $this->tahunAjaran = TahunAjaran::getActive();
        $this->kelas = $kelas;
        $this->index = 1;
    }

    public function query()
    {
        return Raport::query()->select('kelas_id', 'siswa_id')->with('siswa');
    }

    public function map($raport): array
    {
        return [
            $this->index++,
            $raport->siswa->nisn,
            $this->kelas->id
        ];
    }

    public function headings(): array
    {
        return [
            'No',
            'NISN',
            'kelas_id'
        ];
    }
}

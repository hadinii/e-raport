<?php

namespace App\Imports;

use App\Kelas;
use App\Raport;
use App\Siswa;
use App\TahunAjaran;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class RaportImport implements ToCollection, WithHeadingRow
{
    protected $kelas;

    public function __construct(Kelas $kelas)
    {
        $this->kelas = $kelas;
    }

    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        $tahunAjaran = TahunAjaran::getActive();
        $kelas_id = $this->kelas->id;

        foreach ($collection as $row) {
            $nisn = $row['nisn'];

            if (!isset($nisn)) {
                return null;
            }

            $siswa = Siswa::where('nisn', $nisn)->first();
            if (is_null($siswa)) {
                return null;
            }

            Raport::updateOrCreate(
                [
                    'tahun_ajaran_id'  => $tahunAjaran->id,
                    'siswa_id' => $siswa->id
                ],
                [
                    'tahun_ajaran_id'  => $tahunAjaran->id,
                    'siswa_id' => $siswa->id,
                    'kelas_id' => $kelas_id
                ]
            );
        }
    }
}

<?php

namespace App\Imports;

use App\Kelas;
use App\Raport;
use App\Siswa;
use App\TahunAjaran;
use Illuminate\Support\Collection;
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

            $raport = $siswa->kelas()
                ->where('tahun_ajaran_id', $tahunAjaran->id)
                ->where('kelas_id', $kelas_id)
                ->first();

            $raport->update([
                'sikap_spiritual' => $row['sikap_spiritual'],
                'sikap_sosial' => $row['sikap_sosial'],
                'saran' => $row['saran'],
                'tinggi_badan' => $row['tinggi_badan'],
                'berat_badan' => $row['berat_badan'],
                'kondisi_pendengaran' => $row['kondisi_pendengaran'],
                'kondisi_penglihatan' => $row['kondisi_penglihatan'],
                'kondisi_gigi' => $row['kondisi_gigi'],
                'sakit' => $row['sakit'],
                'izin' => $row['izin'],
                'tanpa_keterangan' => $row['tanpa_keterangan'],
            ]);

            // Raport::updateOrCreate(
            //     [
            //         'tahun_ajaran_id'  => $tahunAjaran->id,
            //         'siswa_id' => $siswa->id
            //     ],
            //     [
            //         'tahun_ajaran_id'  => $tahunAjaran->id,
            //         'siswa_id' => $siswa->id,
            //         'kelas_id' => $kelas_id,
            //         'sikap_spiritual' => $row['sikap_spiritual'],
            //         'sikap_sosial' => $row['sikap_sosial'],
            //         'saran' => $row['saran'],
            //         'tinggi_badan' => $row['tinggi_badan'],
            //         'berat_badan' => $row['berat_badan'],
            //         'kondisi_pendengaran' => $row['kondisi_pendengaran'],
            //         'kondisi_penglihatan' => $row['kondisi_penglihatan'],
            //         'kondisi_gigi' => $row['kondisi_gigi'],
            //         'sakit' => $row['sakit'],
            //         'izin' => $row['izin'],
            //         'tanpa_keterangan' => $row['tanpa_keterangan'],
            //     ]
            // );
        }
    }
}

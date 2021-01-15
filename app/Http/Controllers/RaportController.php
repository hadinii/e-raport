<?php

namespace App\Http\Controllers;

use App\Raport;
use App\Ekskul;
use App\Kelas;
use App\Sekolah;
use Illuminate\Http\Request;
use App\Imports\RaportImport;
use App\Exports\RaportExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade as PDF;

class RaportController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \App\Raport  $raport
     * @return \Illuminate\Http\Response
     */
    public function show(Raport $raport)
    {
        $data = [
            'raport' => $raport,
            'siswa' => $raport->getSiswa(),
            'kelas' => $raport->getKelas(),
            'nilai' => $raport->getNilai(),
            'prestasi' => $raport->getPrestasi(),
            'tahun_ajaran' => $raport->getTahunAjaran(),
            'sekolah' => Sekolah::getSekolah(),
            'ekskul' => Ekskul::all()
        ];
        return view('raport.show', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Raport  $raport
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Raport $raport)
    {
        $raport->update($request->all());

        return redirect()
            ->route('raport.show', $raport)
            ->withSuccess('Berhasil mengubah data raport!');
    }

    public function updateEkskul(Request $request, Raport $raport)
    {
        $ekskul_id = $request->ekskul_id;
        $keterangan = $request->keterangan;

        $newEkskul = collect();
        $ekskul = Ekskul::find($ekskul_id);
        $newEkskul->put('ekskul', $ekskul);
        $newEkskul->put('keterangan', $keterangan);

        $raport->addNewEkskul($newEkskul);

        return redirect()
            ->route('raport.show', $raport)
            ->withSuccess('berhasil menambah nilai ekskul!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Raport  $raport
     * @return \Illuminate\Http\Response
     */
    public function destroyEkskul(Request $request, Raport $raport)
    {
        $ekskul_id = $request->ekskul_id;

        $raport->removeEkskul($ekskul_id);

        return redirect()
            ->route('raport.show', $raport)
            ->withSuccess('berhasil menghapus nilai ekskul!');
    }

    /**
     * Import a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function import(Request $request, Kelas $kelas)
    {
        Excel::import(new RaportImport($kelas), $request->file('data-siswa'));

        return redirect()
            ->route('user.kelas')
            ->withSuccess('berhasil mengimport nilai!');
    }

    /**
     * Export resource in storage.
     *
     * @param  \App\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function export(Kelas $kelas)
    {
        $name = "import nilai kelas {$kelas->nama_lengkap}.xlsx";
        return Excel::download(new RaportExport($kelas), $name);
    }

    /**
     * Print resource in storage as PDF.
     *
     * @param  \App\Raport  $raport
     * @return \Illuminate\Http\Response
     */
    public function print(Raport $raport)
    {
        $data = [
            'raport' => $raport,
            'siswa' => $raport->getSiswa(),
            'kelas' => $raport->getKelas(),
            'nilai' => $raport->getNilai(),
            'prestasi' => $raport->getPrestasi(),
            'tahun_ajaran' => $raport->getTahunAjaran(),
            'sekolah' => Sekolah::getSekolah(),
            'ekskul' => Ekskul::all()
        ];
        // return $data;
        // return view('raport.print', $data);
        $pdf = PDF::loadView('raport.print', $data);
        return $pdf->download("Raport {$raport->nama_siswa} ({$raport->nama_tahun_ajaran}).pdf");
    }
}

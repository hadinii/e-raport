<?php

namespace App\Http\Controllers;

use App\Kurikulum;
use App\Sekolah;
use App\TahunAjaran;
use Illuminate\Http\Request;

class TahunAjaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $semester = TahunAjaran::getAll();
        $kurikulum = Kurikulum::getAll();
        $sekolah = Sekolah::getSekolah();

        $data = [
            'semester' => $semester,
            'kurikulum' => $kurikulum,
            'sekolah' => $sekolah
        ];
        return view('tahun_ajaran.index', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $form = $this->validate($request, [
            'tahun_aktif' => 'required|string',
            'semester' => 'required|string|in:Ganjil,Genap',
            'tanggal_raport' => 'required|date',
            'kurikulum_id' => 'required',
            'nama_kepala_sekolah' => 'required|string',
            'nip_kepala_sekolah' => 'required|string',
        ]);

        $form['is_aktif'] = $request->is_aktif ? true : false;
        $semester = TahunAjaran::create($form);

        return redirect()
            ->route('tahun.index')
            ->withSuccess('Berhasil menambah data tahun ajaran!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TahunAjaran  $tahunAjaran
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TahunAjaran $tahunAjaran)
    {
        $form = $this->validate($request, [
            'tahun_aktif' => 'required|string',
            'semester' => 'required|string|in:Ganjil,Genap',
            'tanggal_raport' => 'required|date',
            'kurikulum_id' => 'required',
        ]);

        $form['is_aktif'] = $request->is_aktif ? true : false;
        $tahunAjaran->update($form);

        return redirect()
            ->route('tahun.index')
            ->withSuccess('Berhasil mengubah data tahun ajaran!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TahunAjaran  $tahunAjaran
     * @return \Illuminate\Http\Response
     */
    public function destroy(TahunAjaran $tahunAjaran)
    {
        $tahunAjaran->delete();

        return redirect()
            ->route('tahun.index')
            ->withSuccess('Berhasil menghapus data tahun ajaran!');
    }
}

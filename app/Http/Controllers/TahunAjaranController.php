<?php

namespace App\Http\Controllers;

use App\Kurikulum;
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
        $semester = TahunAjaran::get();
        $kurikulum = Kurikulum::getAll();

        $data = [
            'semester' => $semester,
            'kurikulum' => $kurikulum
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
        ]);

        $form['is_aktif'] = $request->is_aktif ? true : false;
        $semester = TahunAjaran::create($form);

        return redirect()
            ->route('tahun.index')
            ->withSuccess('Berhasil menambah data tahun ajaran!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TahunAjaran  $tahunAjaran
     * @return \Illuminate\Http\Response
     */
    public function show(TahunAjaran $tahunAjaran)
    {
        //
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
        //
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

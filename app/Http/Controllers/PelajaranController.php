<?php

namespace App\Http\Controllers;

use App\Pelajaran;
use App\Kurikulum;
use App\TahunAjaran;
use Illuminate\Http\Request;

class PelajaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $currentKurikulum = $request->kurikulum;

        if (is_null($currentKurikulum)) {
            $currentKurikulum = TahunAjaran::getActive()->kurikulum_id;
        }

        $pelajaran = Pelajaran::getByKurikulum($currentKurikulum);
        $kurikulum = Kurikulum::all();

        $data = [
            'pelajaran' => $pelajaran,
            'currentKurikulum' => $currentKurikulum,
            'kurikulum' => $kurikulum
        ];
        return view('pelajaran.index', $data);
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
            'kurikulum_id'   => 'required',
            'nama'           => 'required|string',
            'singkatan'      => 'required|String',
        ]);

        $pelajaran = Pelajaran::create($form);

        return redirect()
            ->route('pelajaran.index')
            ->withSuccess('Berhasil menambah data pelajaran!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pelajaran  $pelajaran
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pelajaran $pelajaran)
    {
        $form = $this->validate($request, [
            'nama'           => 'required|string',
            'singkatan'      => 'required|String',
        ]);

        $pelajaran->update($form);

        return redirect()
            ->route('pelajaran.index')
            ->withSuccess('Berhasil mengubah data pelajaran!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pelajaran  $pelajaran
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pelajaran $pelajaran)
    {
        $pelajaran->delete();

        return redirect()
            ->route('pelajaran.index')
            ->withSuccess('Berhasil menghapus data pelajaran!');
    }
}

<?php

namespace App\Http\Controllers;

use App\Kurikulum;
use Illuminate\Http\Request;

class KurikulumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kurikulum = Kurikulum::with('pelajaran')->get();

        $data = [
            'kurikulum' => $kurikulum
        ];
        return view('kurikulum.index', $data);
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
            'nama'           => 'required|string',
            'deskripsi'      => 'required|String',
        ]);

        $kurikulum = Kurikulum::create($form);

        return redirect()
            ->route('kurikulum.index')
            ->withSuccess('Berhasil menambah data kurikulum!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Kurikulum  $kurikulum
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kurikulum $kurikulum)
    {
        $form = $this->validate($request, [
            'nama'           => 'required|string',
            'deskripsi'      => 'required|String',
        ]);

        $kurikulum->update($form);

        return redirect()
            ->route('kurikulum.index')
            ->withSuccess('Berhasil mengubah data kurikulum!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Kurikulum  $kurikulum
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kurikulum $kurikulum)
    {
        $kurikulum->delete();

        return redirect()
            ->route('kurikulum.index')
            ->withSuccess('Berhasil menghapus data kurikulum!');
    }
}

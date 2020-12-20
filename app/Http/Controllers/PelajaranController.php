<?php

namespace App\Http\Controllers;

use App\Pelajaran;
use App\Kurikulum;
use Illuminate\Http\Request;

class PelajaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kurikulum = Kurikulum::All();

        $data = [
            'kurikulum' => $kurikulum
        ];
        return view('pelajaran.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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

        // make default password
        // $form['password'] = '12345678';
        // $form['is_aktif'] = $request->is_aktif ? true : false;
        $pelajaran = Pelajaran::create($form);

        return redirect()
            ->route('pelajaran.index')
            ->withSuccess('Berhasil menambah data pelajaran!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pelajaran  $pelajaran
     * @return \Illuminate\Http\Response
     */
    public function show(Pelajaran $pelajaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pelajaran  $pelajaran
     * @return \Illuminate\Http\Response
     */
    public function edit(Pelajaran $pelajaran)
    {
        //
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

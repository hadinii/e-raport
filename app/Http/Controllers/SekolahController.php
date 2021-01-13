<?php

namespace App\Http\Controllers;

use App\Sekolah;
use Illuminate\Http\Request;

class SekolahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sekolah = Sekolah::latest()->first();

        $data = [
            'sekolah' => $sekolah
        ];
        return view('sekolah.index', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Sekolah  $sekolah
     * @return \Illuminate\Http\Response
     */
    public function edit(Sekolah $sekolah)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sekolah  $sekolah
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sekolah $sekolah)
    {
        $form = $this->validate($request, [
            'nama'           => 'required|string',
            'alamat'         => 'required|String',
            'kepala_sekolah' => 'required|String',
        ]);

        $sekolah->update($form);

        return redirect()
            ->route('sekolah.index')
            ->withSuccess('Berhasil mengubah data sekolah!');
    }
}

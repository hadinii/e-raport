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
            'alamat'         => 'required|string',
            'kepala_sekolah' => 'required|string',
            'nip_kepala_sekolah' => 'required|string',
        ]);

        $sekolah->update($form);

        return redirect()
            ->route('sekolah.index')
            ->withSuccess('Berhasil mengubah data sekolah!');
    }
}

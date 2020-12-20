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
        $sekolah = Sekolah::All();

        $data = [
            'sekolah' => $sekolah
        ];
        return view('sekolah.index', $data);
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
            'nama'           => 'required|string',
            'alamat'         => 'required|String',
            'kepala_sekolah' => 'required|String',
        ]);

        // make default password
        // $form['password'] = '12345678';
        // $form['is_aktif'] = $request->is_aktif ? true : false;
        $user = Sekolah::create($form);

        return redirect()
            ->route('sekolah.index')
            ->withSuccess('Berhasil menambah data sekolah!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Sekolah  $sekolah
     * @return \Illuminate\Http\Response
     */
    public function show(Sekolah $sekolah)
    {
        //
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sekolah  $sekolah
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sekolah $sekolah)
    {
        $sekolah->delete();

        return redirect()
            ->route('sekolah.index')
            ->withSuccess('Berhasil menghapus data sekolah!');
    }
}

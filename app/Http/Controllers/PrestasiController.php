<?php

namespace App\Http\Controllers;

use App\Prestasi;
use App\Raport;
use Illuminate\Http\Request;

class PrestasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
        Prestasi::create($request->all());

        return redirect()
            ->route('raport.show', $request->raport_id)
            ->withSuccess('Berhasil menambah prestasi!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Prestasi  $prestasi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Prestasi $prestasi)
    {
        $prestasi->delete();

        return redirect()
            ->route('raport.show', $request->raport_id)
            ->withSuccess('Berhasil menghapus prestasi!');
    }
}

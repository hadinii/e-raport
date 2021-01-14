<?php

namespace App\Http\Controllers;

use App\Kelas;
use App\Raport;
use Illuminate\Http\Request;
use App\Imports\RaportImport;
use App\Exports\RaportExport;
use Maatwebsite\Excel\Facades\Excel;

class RaportController extends Controller
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            ->route('kelas.show', $kelas)
            ->withSuccess('berhasil mengimport data siswa!');
    }

    /**
     * Export resource in storage.
     *
     * @param  \App\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function export(Kelas $kelas)
    {
        $name = "import kelas {$kelas->nama_lengkap}.xlsx";
        return Excel::download(new RaportExport($kelas), $name);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Raport  $raport
     * @return \Illuminate\Http\Response
     */
    public function show(Raport $raport)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Raport  $raport
     * @return \Illuminate\Http\Response
     */
    public function edit(Raport $raport)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Raport  $raport
     * @return \Illuminate\Http\Response
     */
    public function destroy(Raport $raport)
    {
        //
    }
}

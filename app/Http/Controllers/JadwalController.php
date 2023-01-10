<?php

namespace App\Http\Controllers;

use App\Kelas;
use App\Jadwal;
use Illuminate\Http\Request;

class JadwalController extends Controller
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function show(Jadwal $jadwal)
    {
        $pelajaran = $jadwal->getPelajaran();
        $kelas = $jadwal->getKelas();
        $semester = $jadwal->getSemester();
        $nilai = $jadwal->getNilai();

        $data = [
            'jadwal' => $jadwal,
            'pelajaran' => $pelajaran,
            'kelas' => $kelas,
            'tahun_ajaran' => $semester,
            'nilai' => $nilai
        ];
        // return $data;
        return view('jadwal.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function edit(Jadwal $jadwal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kelas $kelas)
    {
        // return $request->all();
        foreach ($request->all() as $row => $value) {
            $name = explode('-', $row);
            if ($name[0] == 'guru_id') {
                Jadwal::find($name[1])->update([$name[0] => $value]);
            }
        }

        return redirect()
            ->route('kelas.show', $kelas)
            ->withSuccess('Berhasil mengubah guru pelajaran!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jadwal $jadwal)
    {
        //
    }
}

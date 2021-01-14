<?php

namespace App\Http\Controllers;

use App\User;
use App\Kelas;
use App\TahunAjaran;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $currentSemester = TahunAjaran::find($request->semester);
        is_null($currentSemester) && $currentSemester = TahunAjaran::getActive();

        $semester = TahunAjaran::getAll();
        $guru = User::getActive();

        $data = [
            'currentSemester' => $currentSemester,
            'semester' => $semester,
            'guru' => $guru
        ];
        return view('kelas.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // TO DO: check semester available
        $currentSemester = TahunAjaran::getActive();
        $pelajaran = $currentSemester->getPelajaran();

        $guru = User::getActive();

        $data = [
            'guru' => $guru,
            'pelajaran' => $pelajaran
        ];
        return view('kelas.create', $data);
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
            'nama' => 'required|string',
            'tingkat_id' => 'required|integer',
            'wali_kelas_id' => 'required|integer',
            'pelajaran' => 'required|array'
        ]);

        $kelas = Kelas::create($form);
        $kelas->setPelajaran($form['pelajaran']);

        return redirect()
            ->route('kelas.show', $kelas)
            ->withSuccess('Berhasil manambah data kelas!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function show(Kelas $kelas)
    {
        $guru = User::getActive();
        $currentSemester = TahunAjaran::getActive();

        $data = [
            'kelas' => $kelas,
            'pelajaran' => $kelas->getPelajaran(),
            'siswa' => $kelas->getSiswa(),
            'tahun_ajaran' => $kelas->getSemester(),
            'guru' => $guru
        ];
        return view('kelas.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function edit(Kelas $kelas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kelas $kelas)
    {
        $form = $this->validate($request, [
            'nama' => 'required|string',
            'tingkat_id' => 'required|integer',
            'wali_kelas_id' => 'required|integer',
            // 'pelajaran' => 'required|array'
        ]);

        $kelas->update($form);

        return redirect()
            ->route('kelas.index')
            ->withSuccess('Berhasil mengubah data kelas!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kelas $kelas)
    {
        $kelas->delete();

        return redirect()
            ->route('kelas.index')
            ->withSuccess('Berhasil menghapus data kelas!');
    }
}

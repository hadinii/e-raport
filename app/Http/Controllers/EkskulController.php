<?php

namespace App\Http\Controllers;

use App\Ekskul;
use Illuminate\Http\Request;

class EkskulController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ekskul = Ekskul::get();

        $data = [
            'ekskul' => $ekskul,
        ];
        return view('ekskul.index', $data);
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
            'nama' => 'required',
            'deskripsi' => 'required'
        ]);

        $ekskul = Ekskul::create($form);

        return redirect()
            ->route('ekskul.index')
            ->withSuccess('Berhasil menambah data ekskul!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ekskul  $ekskul
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ekskul $ekskul)
    {
        $form = $this->validate($request, [
            'nama' => 'required',
            'deskripsi' => 'required'
        ]);

        $ekskul->update($form);

        return redirect()
            ->route('ekskul.index')
            ->withSuccess('Berhasil mengubah data ekskul!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ekskul  $ekskul
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ekskul $ekskul)
    {
        $ekskul->delete();

        return redirect()
            ->route('ekskul.index')
            ->withSuccess('Berhasil menghapus data ekskul!');
    }
}

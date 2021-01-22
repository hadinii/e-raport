<?php

namespace App\Http\Controllers;

use App\Kelas;
use App\Siswa;
use App\User;
<<<<<<< HEAD
use App\TahunAjaran;
=======
use App\Pelajaran;
>>>>>>> dc78a51de242dcdd0a04c212eddccc98652db851
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $siswa = Siswa::getActive();
        $kelas = Kelas::all();
        $guru = User::getAll();
        $pelajaran = Pelajaran::all();
        $data = [
            'totalSiswaActive' => count($siswa),
            'totalKelas' => count($kelas),
            'totalGuru' => count($guru),
            'totalPelajaran' => count($pelajaran),
            'user' => Auth::user()
        ];
        return view('dashboard.administrator', $data);
    }
    public function indexGuru()
    {
        $siswa = Siswa::getActive();
        $kelas = Kelas::all();
        $guru = User::getAll();
        $pelajaran = Pelajaran::all();
        $data = [
            'totalSiswaActive' => count($siswa),
            'totalKelas' => count($kelas),
            'totalGuru' => count($guru),
            'totalPelajaran' => count($pelajaran),
            'user' => Auth::user()
        ];
        // return $data;
        return view('dashboard.administrator', $data);
    }

    public function guru()
    {
        $user = Auth::user();
        $semester = TahunAjaran::getActive();

        $waliKelas = $semester ? $user->getKelas($semester->id)->first() : [];
        $jadwal = $semester ? $user->getJadwal($semester->id) : [];

        $data = [
            'semester' => $semester,
            'waliKelas' => $waliKelas,
            'jadwal' => $jadwal
        ];
        // return $data;
        return view('dashboard.guru', $data);
    }
}

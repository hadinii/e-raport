<?php

namespace App\Http\Controllers;

use App\Kelas;
use App\Siswa;
use App\User;
use App\TahunAjaran;
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
        $user = Auth::user();
        return $user->role == 'Admin' ? $this->admin() : $this->guru();
    }

    public function admin()
    {
        $semester = TahunAjaran::getActive();
        $siswa = Siswa::getActive();
        $guru = User::getActive();
        $kelas = Kelas::getActive();

        $data = [
            'semester' => $semester,
            'siswa' => $siswa->count(),
            'guru' => $guru->count(),
            'kelas' => count($kelas),
        ];
        // return $data;
        return view('dashboard.administrator', $data);
    }

    public function guru()
    {
        $data = [];
        return view('dashboard.guru', $data);
    }
}

<?php

use App\Sekolah;
use Illuminate\Database\Seeder;

class SekolahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sekolah')->insert([
            'nama' => 'SMP 10 Tapung',
            'alamat' => 'Jl. Garuda Sakti Km.3',
            'kepala_sekolah' => 'Jeddii',
            'nip_kepala_sekolah' => '123456789'
        ]);
    }
}

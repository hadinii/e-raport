<?php

use App\Tingkat;
use Illuminate\Database\Seeder;

class TingkatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['nama' => 'I'],
            ['nama' => 'II'],
            ['nama' => 'III'],
            ['nama' => 'IV'],
            ['nama' => 'V'],
            ['nama' => 'VI']
        ];
        DB::table('tingkat')->insert($data);
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRaportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('raport', function (Blueprint $table) {
            $table->id();
            $table->integer('siswa_id');
            $table->integer('tahun_ajaran_id');
            $table->integer('kelas_id');
            $table->text('sikap_spiritual');
            $table->text('sikap_sosial');
            $table->text('saran');
            $table->string('tinggi_badan');
            $table->string('berat_badan');
            $table->string('kondisi_pendengaran');
            $table->string('kondisi_penglihatan');
            $table->string('kondisi_gigi');
            $table->string('sakit');
            $table->string('alfa');
            $table->string('tanpa_keterangan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('raport');
    }
}

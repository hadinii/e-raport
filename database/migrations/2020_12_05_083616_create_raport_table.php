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
            $table->text('sikap_spiritual')->nullable();
            $table->text('sikap_sosial')->nullable();
            $table->text('saran')->nullable();
            $table->string('tinggi_badan')->nullable();
            $table->string('berat_badan')->nullable();
            $table->string('kondisi_pendengaran')->nullable();
            $table->string('kondisi_penglihatan')->nullable();
            $table->string('kondisi_gigi')->nullable();
            $table->string('sakit')->nullable();
            $table->string('alfa')->nullable();
            $table->string('tanpa_keterangan')->nullable();
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

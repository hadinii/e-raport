<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNilaiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nilai', function (Blueprint $table) {
            $table->id();
            $table->integer('raport_id');
            $table->integer('pelajaran_id');
            $table->integer('nilai_pengetahuan')->min(0)->max(100);
            $table->string('deskripsi_pengetahuan');
            $table->integer('nilai_keterampilan')->min(0)->max(100);
            $table->string('deskripsi_keterampilan');
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
        Schema::dropIfExists('nilai');
    }
}

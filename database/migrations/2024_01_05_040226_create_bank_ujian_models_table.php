<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_ujian', function (Blueprint $table) {
            $table->id();
            $table->string('ujian_id',50);
            $table->text('nama_ujian');
            $table->string('ujian_untuk',50);
            $table->string('jumlah_soal',4);
            $table->string('bobot_nilai',3);
            $table->string('minimal_nilai',3);
            $table->timestamps();

            $table->foreign('ujian_id')->references('ujian_id')->on('bank_soal')->delete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bank_ujian');
    }
};

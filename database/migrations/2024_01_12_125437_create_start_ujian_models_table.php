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
        Schema::create('start_ujian', function (Blueprint $table) {
            $table->id();
            $table->string('ujian_id',50);
            $table->string('email',50);
            $table->string('nilai_ujian',20)->nullable();
            $table->string('minimal_nilai',20)->nullable();
            $table->string('jawaban_benar',20)->nullable();
            $table->string('jawaban_salah',20)->nullable();
            $table->string('status_ujian',20)->default('pending');
            $table->string('status_kelulusan',20)->default('belum_ujian');
            $table->timestamps();

            $table->foreign('ujian_id')->references('ujian_id')->on('bank_ujian')->delete('cascade');
            $table->foreign('email')->references('email')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('start_ujian');
    }
};

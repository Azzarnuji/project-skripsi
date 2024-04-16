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
        Schema::create('kelas_siswa', function (Blueprint $table) {
            $table->id();
            $table->string('id_kelas_foreign',50);
            $table->string('email_foreign',50);
            $table->timestamps();

            $table->foreign('id_kelas_foreign')->references('id_kelas')->on('kelas')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('email_foreign')->references('email')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kelas_siswa');
    }
};

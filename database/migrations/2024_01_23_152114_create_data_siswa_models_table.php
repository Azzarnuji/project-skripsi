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
        Schema::create('data_siswa', function (Blueprint $table) {
            $table->id();
            $table->string('email',50)->nullable(true);
            $table->text('nama_lengkap');
            $table->text('nis')->nullable();
            $table->text('nisn')->nullable();
            $table->text('TTL')->nullable();
            $table->text('nama_ayah')->nullable();
            $table->text('pekerjaan_ayah')->nullable();
            $table->text('alamat_ayah')->nullable();
            $table->text('no_hp_ayah')->nullable();
            $table->text('nama_ibu')->nullable();
            $table->text('pekerjaan_ibu')->nullable();
            $table->text('alamat_ibu')->nullable();
            $table->text('no_hp_ibu')->nullable();
            $table->text('status')->nullable();
            $table->text('image')->nullable();

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
        Schema::dropIfExists('data_siswa');
    }
};

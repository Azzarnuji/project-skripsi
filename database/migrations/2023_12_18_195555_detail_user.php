<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('detail_user',function(Blueprint $table){
            $table->id();
            $table->string('email',50)->nullable(true);
            $table->string('name',50)->nullable();
            $table->string('gender',50)->nullable();
            $table->text('address')->nullable();
            $table->string('phone',50)->nullable();
            $table->string('religion',50)->nullable();
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

            $table->foreign('email')->references('email')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });

        DB::table('detail_user')->insert([
            'email'=>'admin@admin.com',
            'name'=>'admin',
            'gender'=>'Laki-Laki',
            'address'=>'Jl. Cempaka Putih',
            'phone'=>'08123456789',
            'religion'=>'Islam'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists("detail_user");
    }
};

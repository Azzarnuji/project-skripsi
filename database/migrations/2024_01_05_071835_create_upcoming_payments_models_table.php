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
        Schema::create('upcoming_payments', function (Blueprint $table) {
            $table->id();
            $table->string('pembayaran_id_foreign',50);
            $table->string('payment_id',50);
            $table->string('email',50);
            $table->string('rekening_asal',50)->nullable(true);
            $table->text('nama_pemilik_rekening')->nullable(true);
            $table->text('bukti_pembayaran')->nullable(true);
            $table->string('status',50)->nullable(true);
            $table->timestamps();

            $table->foreign('pembayaran_id_foreign')->references('pembayaran_id')->on('pembayaran');
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
        Schema::dropIfExists('upcoming_payments');
    }
};

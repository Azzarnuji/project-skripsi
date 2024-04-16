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
        Schema::create('users',function(Blueprint $table){
            $table->id();
            $table->string('email',50)->unique();
            $table->string('password',255);
            $table->integer('role');
            $table->timestamp('verified_at')->nullable();
        });
        DB::table('users')->insert([
            'email'=>'admin@admin.com',
            'password'=>password_hash('admin',PASSWORD_BCRYPT),
            'role'=>'1'
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
        Schema::dropIfExists("users");
    }
};

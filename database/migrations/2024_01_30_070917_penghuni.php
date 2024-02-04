<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Penghuni extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penghuni', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('code');
            $table->string('nama');
            $table->string('tmpt_lahir');
            $table->date('tgl_lahir');
            $table->unsignedBigInteger('no_telp');
            $table->string('agama');
            $table->integer('status_pemilik');
            $table->integer('status');
            $table->integer('tower');
            $table->integer('lantai');
            $table->integer('room');
            $table->bigInteger('ktp');
            $table->text('foto_ktp');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('penghuni');
    }
}

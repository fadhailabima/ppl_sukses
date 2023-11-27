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
        Schema::create('p_k_l_s', function (Blueprint $table) {
            $table->id();
            $table->string('mahasiswa_id');
            $table->string('semester');
            $table->string('nilai_pkl')->nullable();
            $table->string('instansi');
            $table->string('dosenpengampu');
            $table->string('scanpkl')->nullable();
            $table->boolean('isverified')->default('0');
            $table->timestamps();
            $table->foreign('mahasiswa_id')->references('nim')->on('mahasiswas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('p_k_l_s', function (Blueprint $table) {
            $table->dropForeign(['mahasiswa_id']);
        });
        Schema::dropIfExists('PKL');
    }
};
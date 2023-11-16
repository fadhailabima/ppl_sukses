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
        Schema::create('skripsis', function (Blueprint $table) {
            $table->id();
            $table->string('mahasiswa_id');
            $table->string('semester');
            $table->date('tglsidang');
            $table->string('dosenpembimbing');
            $table->string('scansidang')->nullable();
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
        Schema::table('skripsis', function (Blueprint $table) {
            $table->dropForeign(['mahasiswa_id']);
        });
        Schema::dropIfExists('Skripsi');
    }
};
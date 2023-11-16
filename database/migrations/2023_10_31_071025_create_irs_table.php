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
        Schema::create('IRS', function (Blueprint $table) {
            $table->id();
            $table->string('mahasiswa_id');
            $table->string('semester')->nullable();
            $table->integer('jmlsks')->nullable();
            $table->string('scansks')->nullable();
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
        Schema::table('IRS', function (Blueprint $table) {
            $table->dropForeign(['mahasiswa_id']);
        });

        Schema::dropIfExists('IRS');
    }
};
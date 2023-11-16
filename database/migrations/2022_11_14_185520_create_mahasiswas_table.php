<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mahasiswas', function (Blueprint $table) {
            $table->string('nim')->primary();
            $table->string('nama');
            $table->string('alamat')->nullable();
            $table->string('kab_kota')->nullable();
            $table->string('propinsi')->nullable();
            $table->string('angkatan');
            $table->enum('jalur_masuk', ['SNMPTN', 'SBMPTN', 'MANDIRI']);
            $table->string('email')->nullable();
            $table->string('handphone')->nullable();
            $table->enum('status', ['Aktif', 'Cuti', 'Mangkir', 'DO', 'Undur Diri', 'Lulus', 'Meninggal Dunia'])->default('Aktif');
            $table->string('foto_mahasiswa')->nullable();
            $table->string('dosen_wali');
            $table->unsignedBigInteger('user_id');

            $table->foreign('dosen_wali')->references('nip')->on('dosenwalis');
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::table('mahasiswas', function (Blueprint $table) {
            $table->dropForeign(['dosen_wali']);
            $table->dropForeign(['user_id']);
        });

        Schema::dropIfExists('mahasiswas');
    }
};

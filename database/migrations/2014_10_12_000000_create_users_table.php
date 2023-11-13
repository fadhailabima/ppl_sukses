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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique()->nullable();
            $table->string('nim')->unique();
            $table->integer('angkatan')->nullable();
            $table->string('alamat')->nullable();
            $table->string('kotakab')->nullable();
            $table->string('provinsi')->nullable();
            $table->string('jalurmasuk')->nullable();
            $table->string('nomortlp')->nullable();
            $table->string('photo',128)->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->string('level')->default('user');
            $table->string('status');
            $table->string('dosenwali')->nullable();
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
        Schema::dropIfExists('users');
    }
};

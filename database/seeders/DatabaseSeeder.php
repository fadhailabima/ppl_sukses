<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Fadhail A Bima',
            'email' => 'fadhail@students.com',
            'password' => bcrypt('informatika'),
            'nim' => '24060121140174',
            'jurusan' => 'Informatika S1',
            'angkatan' => '2021',
            'level' => 'user',
            'dosenwali' => 'Nurdin Bahtiar',
            'status' => 'Aktif'
        ]);

        User::create([
            'name' => 'Derva Anargya Ghaly',
            'email' => 'derva@students.com',
            'password' => bcrypt('informatika'),
            'nim' => '24010122150214',
            'jurusan' => 'Informatika S1',
            'angkatan' => '2021',
            'level' => 'user',
            'dosenwali' => 'Adi Wibowo',
            'status' => 'Aktif'
        ]);

        User::create([
            'name' => 'FSM UNDIP',
            'email' => 'fsmundip@students.com',
            'password' => bcrypt('informatika'),
            'nim' => '247474754',
            'jurusan' => 'Informatika',
            'angkatan' => '1989',
            'level' => 'department',
            'status' => 'Aktif'
        ]);

        User::create([
            'name' => 'Nurdin Bahtiar',
            'email' => 'nurdin@students.com',
            'password' => bcrypt('informatika'),
            'nim' => '19560701',
            'jurusan' => 'Informatika S1',
            'level' => 'dosen',
            'status' => 'Aktif'
        ]);

        User::create([
            'name' => 'Admin Informatika 1',
            'email' => 'admin-informatika@students.com',
            'password' => bcrypt('petugas'),
            'nim' => '11254682',
            'jurusan' => 'Informatika S1',
            'level' => 'admin',
            'status' => 'Operator'
        ]);
    }
}
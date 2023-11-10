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
            'name' => 'FSM UNDIP',
            'email' => 'fsmundip@students.com',
            'password' => bcrypt('informatika'),
            'nim' => '247474754',
            'angkatan' => '1989',
            'level' => 'department',
            'status' => 'Aktif'
        ]);

        User::create([
            'name' => 'Nurdin Bahtiar',
            'email' => 'nurdin@undip.com',
            'password' => bcrypt('informatika'),
            'nim' => '19560701',
            'level' => 'dosen',
            'status' => 'Aktif'
        ]);

        User::create([
            'name' => 'Admin Informatika 1',
            'email' => 'admin-informatika@students.com',
            'password' => bcrypt('petugas'),
            'nim' => '11254682',
            'level' => 'admin',
            'status' => 'Operator'
        ]);
    }
}
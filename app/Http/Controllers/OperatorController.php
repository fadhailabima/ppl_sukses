<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\MHS;
use Illuminate\Http\Request;

class OperatorController extends Controller
{
    public function index()
    {
        //status
        $useractivecount = MHS::query()
            ->where('status', '=', 'Aktif')
            ->count();
        $userMangkircount = MHS::query()
            ->where('status', '=', 'Mangkir')
            ->count();
        $userCuticount = MHS::query()
            ->where('status', '=', 'Cuti')
            ->count();
        $userDropoutcount = MHS::query()
            ->where('status', '=', 'DO')
            ->count();
        $userLuluscount = MHS::query()
            ->where('status', '=', 'Lulus')
            ->count();


        //level
        $mahasiswa = User::query()
            ->where('level', '=', 'mahasiswa')
            ->count();
        $dosen = User::query()
            ->where('level', '=', 'dosen')
            ->count();
        $department = User::query()
            ->where('level', '=', 'department')
            ->count();
        $operator = User::query()
            ->where('level', '=', 'operator')
            ->count();



        return view('operator.dashboardoperator', compact(
            'useractivecount',
            'mahasiswa',
            'dosen',
            'department',
            'operator',
            'userMangkircount',
            'userCuticount',
            'userDropoutcount',
            'userLuluscount'
        ));
    }
}
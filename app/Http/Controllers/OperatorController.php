<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class OperatorController extends Controller
{
    public function index()
    {
        //status
        $useractivecount = User::query()
            ->where('status', '=', 'Aktif')
            ->count();
        $userMangkircount = User::query()
            ->where('status', '=', 'Mangkir')
            ->count();
        $userCuticount = User::query()
            ->where('status', '=', 'Cuti')
            ->count();
        $userDropoutcount = User::query()
            ->where('status', '=', 'Dropout')
            ->count();
        $userOperatorcount = User::query()
            ->where('status', '=', 'Operator')
            ->count();


        //level
        $mahasiswa = User::query()
            ->where('level', '=', 'user')
            ->count();
        $dosen = User::query()
            ->where('level', '=', 'dosen')
            ->count();
        $department = User::query()
            ->where('level', '=', 'department')
            ->count();
        $admin = User::query()
            ->where('level', '=', 'admin')
            ->count();



        return view('operator.dashboardoperator', compact(
            'useractivecount',
            'mahasiswa',
            'dosen',
            'department',
            'admin',
            'userMangkircount',
            'userCuticount',
            'userDropoutcount',
            'userOperatorcount'
        ));
    }
}
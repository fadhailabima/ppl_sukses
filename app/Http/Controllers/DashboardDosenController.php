<?php

namespace App\Http\Controllers;

use App\Models\IRS;
use App\Models\KHS;
use App\Models\PKL;
use App\Models\Skripsi;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DashboardDosenController extends Controller
{
    public function index()
    {


        $jmlmhs = User::query()
            ->where('dosenwali', '=', auth()->user()->name)
            ->count();

        //IRS
        $irscountnotverified = DB::table('irs')
            ->join('users', 'irs.userid', '=', 'users.id')
            ->where('dosenwali', '=', auth()->user()->name)
            ->where('isverified', '=', '0')
            ->count();
        $irscountverified = DB::table('irs')
            ->join('users', 'irs.userid', '=', 'users.id')
            ->where('dosenwali', '=', auth()->user()->name)
            ->where('isverified', '=', '1')
            ->count();
        $irsbelum = $jmlmhs - $irscountnotverified - $irscountverified;

        //KHS
        $khscountnotverified = DB::table('k_h_s')
            ->join('users', 'k_h_s.userid', '=', 'users.id')
            ->where('dosenwali', '=', auth()->user()->name)
            ->where('isverified', '=', '0')
            ->count();
        $khscountverified = DB::table('k_h_s')
            ->join('users', 'k_h_s.userid', '=', 'users.id')
            ->where('dosenwali', '=', auth()->user()->name)
            ->where('isverified', '=', '1')
            ->count();
        $khsbelum = $jmlmhs - $khscountnotverified - $khscountverified;

        //PKL
        $pklcountnotverified = DB::table('p_k_l_s')
            ->join('users', 'p_k_l_s.userid', '=', 'users.id')
            ->where('dosenwali', '=', auth()->user()->name)
            ->where('isverified', '=', '0')
            ->count();
        $pklcountverified = DB::table('p_k_l_s')
            ->join('users', 'p_k_l_s.userid', '=', 'users.id')
            ->where('dosenwali', '=', auth()->user()->name)
            ->where('isverified', '=', '1')
            ->count();
        $pklbelum = $jmlmhs - $pklcountnotverified - $pklcountverified;

        //skripsi
        $skripsicountnotverified = DB::table('skripsis')
            ->join('users', 'skripsis.userid', '=', 'users.id')
            ->where('dosenwali', '=', auth()->user()->name)
            ->where('isverified', '=', '0')
            ->count();
        $skripsicountverified = DB::table('skripsis')
            ->join('users', 'skripsis.userid', '=', 'users.id')
            ->where('dosenwali', '=', auth()->user()->name)
            ->where('isverified', '=', '1')
            ->count();
        $skripsibelum = $jmlmhs - $skripsicountnotverified - $skripsicountverified;

        return view('dosen.dashboardDosen', compact(
            'jmlmhs',
            'irscountverified',
            'irscountnotverified',
            'irsbelum',
            'khscountnotverified',
            'khscountverified',
            'khsbelum',
            'pklcountnotverified',
            'pklcountverified',
            'pklbelum',
            'skripsicountnotverified',
            'skripsicountverified',
            'skripsibelum'
        ));
    }
}
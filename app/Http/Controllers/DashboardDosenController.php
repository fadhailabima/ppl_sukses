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

        $irsData = DB::table('irs')
            ->join('users', 'irs.userid', '=', 'users.id')
            ->where('dosenwali', '=', auth()->user()->name)
            ->select(
                'users.id as user_id',
                'irs.semester',
                'irs.isverified'
            )
            ->get();

        $uniqueUsers = $irsData->groupBy('user_id');

        $irscountnotverified = $uniqueUsers->flatMap(function ($group) {
            return $group->where('isverified', '=', 0)->pluck('user_id')->unique();
        })->count();

        $irscountverified = $uniqueUsers->flatMap(function ($group) {
            return $group->where('isverified', '=', 1)->pluck('user_id')->unique();
        })->count();
        $irsbelum = max(0, $jmlmhs - $irscountnotverified - $irscountverified);
        //KHS
        $khsData = DB::table('k_h_s')
            ->join('users', 'k_h_s.userid', '=', 'users.id')
            ->where('dosenwali', '=', auth()->user()->name)
            ->select(
                'users.id as user_id',
                'k_h_s.semester',
                'k_h_s.isverified'
            )
            ->get();

        $uniqueUsers = $khsData->groupBy('user_id');
        $khscountnotverified = $uniqueUsers->flatMap(function ($group) {
            return $group->where('isverified', '=', 0)->pluck('user_id')->unique();
        })->count();

        $khscountverified = $uniqueUsers->flatMap(function ($group) {
            return $group->where('isverified', '=', 1)->pluck('user_id')->unique();
        })->count();
        $khsbelum = max(0, $jmlmhs - $khscountnotverified - $khscountverified);

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

        return view(
            'dosen.dashboardDosen',
            compact(
                'jmlmhs',
                // 'semester',
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
            )
        );
    }
}
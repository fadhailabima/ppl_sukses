<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MHS;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DaftarMHSdosenController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('search')) {
            $mahasiswa = DB::table('mahasiswas')
                ->where('dosen_wali', '=', auth()->user()->dosenWali->nip) // Filter hanya level user
                ->where(function ($query) use ($request) {
                    $query->where('nama', 'LIKE', '%' . $request->search . '%')
                        ->orWhere('nim', 'LIKE', '%' . $request->search . '%');
                })
                ->paginate(10);
        } else {
            $mahasiswa = DB::table('mahasiswas')
                ->where('dosen_wali', '=', auth()->user()->dosenWali->nip) // Filter hanya level user
                ->paginate(10);
        }
        return view('dosen.DataMhsdosen', compact('mahasiswa'));
    }

    public function detail(Request $request, $nim)
    {
    $mahasiswa = MHS::where('nim', $nim)
        ->where('dosen_wali', auth()->user()->dosenWali->nip)
        ->first();

    if (!$mahasiswa) {
        return redirect()->back()->with('error', 'Mahasiswa tidak ditemukan atau tidak terkait dengan perwalian Anda.');
    }

    return view('dosen.detailDataMHS', compact('mahasiswa'));
    }
}

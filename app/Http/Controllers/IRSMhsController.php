<?php

namespace App\Http\Controllers;

use App\Models\IRS;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class IRSMhsController extends Controller
{
    public function index()
    {
        return view('mahasiswa.IsiIrsMhs', [
            'title' => 'Isi IRS Mahasiswa'
        ]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validatedata = $request->validate([
            'semester' => 'required',
            'jmlsks' => 'required|lte:25',
            'scansks' => 'required|file|mimes:pdf'
        ]);
        $validatedata['userid'] = auth()->user()->id;
        $validatedata['scansks'] = $nameimg = $request->file('scansks')->getClientOriginalName();
        if (DB::table('irs')->where('userid',  auth()->user()->id)->count() >= 1) {
            return redirect('/dashboardmahasiswa/IsiIRSMahasiswa')->with('gagal', 'Anda Sudah memasukan data irs');
        } else {
            $request->file('scansks')->storeAs('public/post-scansks/', $nameimg);
            Irs::create($validatedata);
            return redirect('/dashboardmahasiswa/IsiIRSMahasiswa')->with('success', 'Data berhasil di masukkan');
        }
    }
    public function show()
    {
        $data = IRS::query()
            ->where('userid', '=', auth()->user()->id)
            ->get();
        return view('mahasiswa.IsiIrsMhs', compact('data'));
    }
}
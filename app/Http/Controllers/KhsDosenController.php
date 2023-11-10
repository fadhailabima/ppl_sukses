<?php

namespace App\Http\Controllers;

use App\Models\KHS;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KhsDosenController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('search')) {
            $datakhs = DB::table('k_h_s')
                ->join('users', 'k_h_s.userid', '=', 'users.id')
                ->select(
                    'users.name',
                    'k_h_s.id',
                    'k_h_s.semester',
                    'k_h_s.skssemester',
                    'k_h_s.skskumulatif',
                    'k_h_s.ipsemester',
                    'k_h_s.ipkumulatif',
                    'k_h_s.scankhs',
                    'k_h_s.isverified'
                )
                ->where('name', 'LIKE', '%' . $request->search . '%')->paginate(10);
        } else {
            $datakhs = DB::table('k_h_s')
                ->join('users', 'k_h_s.userid', '=', 'users.id')
                ->select(
                    'users.name',
                    'k_h_s.id',
                    'k_h_s.semester',
                    'k_h_s.skssemester',
                    'k_h_s.skskumulatif',
                    'k_h_s.ipsemester',
                    'k_h_s.ipkumulatif',
                    'k_h_s.scankhs',
                    'k_h_s.isverified'
                )
                ->paginate(10);
        }


        return view('dosen.KhsDosen', compact('datakhs'));
    }

    public function download($id)
    {

        $downloadkhs = DB::table('k_h_s')->where('id', '=', $id)->first();
        $filepath = public_path("storage/post-scankhs/{$downloadkhs->scankhs}");
        return response()->download($filepath);
    }

    public function changestatus(Request $request)
    {
        $datakhs = KHS::find($request->id);

        $datakhs->isverified = $request->isverified;
        // dd($request);
        $datakhs->update(['isverified' => 1]);
        return redirect('/dashboarddosen/khs')->with('success', 'KHS setujui');
    }

    public function unchangestatus(Request $request)
    {
        $datakhs = KHS::find($request->id);

        $datakhs->isverified = $request->isverified;
        // dd($request);
        $datakhs->update(['isverified' => 0]);
        return redirect('/dashboarddosen/khs')->with('gagal', 'KHS tidak disetujui');
    }
}
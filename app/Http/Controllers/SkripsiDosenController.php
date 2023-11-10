<?php

namespace App\Http\Controllers;

use App\Models\Skripsi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SkripsiDosenController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('search')) {
            $dataskripsi = DB::table('skripsis')
                ->join('users', 'skripsis.userid', '=', 'users.id')
                ->select('users.name', 'skripsis.id', 'skripsis.semester', 'skripsis.tglsidang', 'skripsis.dosenpembimbing', 'skripsis.scansidang', 'skripsis.isverified')
                ->where('name', 'LIKE', '%' . $request->search . '%')
                ->orWhere('dosenpembimbing', 'LIKE', '%' . $request->search . '%')->paginate(10);
        } else {
            $dataskripsi = DB::table('skripsis')
                ->join('users', 'skripsis.userid', '=', 'users.id')
                ->select('users.name', 'skripsis.id', 'skripsis.semester', 'skripsis.tglsidang', 'skripsis.dosenpembimbing', 'skripsis.scansidang', 'skripsis.isverified')
                ->paginate(10);
        }

        return view('dosen.skripsidosen', compact('dataskripsi'));
    }
    public function download($id)
    {

        $downloadskripsi = DB::table('skripsis')->where('id', '=', $id)->first();
        $filepath = public_path("storage/post-scansidang/{$downloadskripsi->scansidang}");
        return response()->download($filepath);
    }
    public function changestatus(Request $request)
    {
        $dataskripsi = Skripsi::find($request->id);

        $dataskripsi->isverified = $request->isverified;
        // dd($request);
        $dataskripsi->update(['isverified' => 1]);
        return redirect('/dashboarddosen/skripsi')->with('success', 'Skripsi setujui');
    }

    public function unchangestatus(Request $request)
    {
        $dataskripsi = Skripsi::find($request->id);

        $dataskripsi->isverified = $request->isverified;
        $dataskripsi->update(['isverified' => 0]);
        return redirect('/dashboarddosen/skripsi')->with('gagal', 'Skripsi tidak disetujui');
    }
}
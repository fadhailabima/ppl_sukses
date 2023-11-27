<?php

namespace App\Http\Controllers;

use App\Models\PKL;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PklDosenController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('search')) {
            $datapkl = DB::table('p_k_l_s')
                ->join('mahasiswas', 'p_k_l_s.mahasiswa_id', '=', 'mahasiswas.nim')
                ->select('mahasiswas.nama', 'p_k_l_s.id', 'p_k_l_s.semester', 'p_k_l_s.instansi', 'p_k_l_s.dosenpengampu', 'p_k_l_s.scanpkl', 'p_k_l_s.isverified','p_k_l_s.nilai_pkl')
                ->where('dosen_wali', '=', auth()->user()->dosenWali->nip)
                ->where('nama', 'LIKE', '%' . $request->search . '%')
                ->orWhere('dosenpengampu', 'LIKE', '%' . $request->search . '%')->paginate(10);
        } else {
            $datapkl = DB::table('p_k_l_s')
                ->join('mahasiswas', 'p_k_l_s.mahasiswa_id', '=', 'mahasiswas.nim')
                ->where('dosen_wali', '=', auth()->user()->dosenWali->nip)
                ->select('mahasiswas.nama', 'p_k_l_s.id', 'p_k_l_s.semester', 'p_k_l_s.instansi', 'p_k_l_s.dosenpengampu', 'p_k_l_s.scanpkl', 'p_k_l_s.isverified', 'p_k_l_s.nilai_pkl')
                ->paginate(10);
        }

        return view('dosen.PklDosen', compact('datapkl'));
    }

    public function download($id)
    {

        $downloadpkl = DB::table('p_k_l_s')->where('id', '=', $id)->first();
        $filepath = public_path("storage/post-scanpkl/{$downloadpkl->scanpkl}");
        return response()->download($filepath);
    }
    public function changestatus(Request $request)
    {
        $datapkl = PKL::find($request->id);

        $datapkl->isverified = $request->isverified;
        // dd($request);
        $datapkl->update(['isverified' => 1]);
        return redirect('/dashboarddosen/pkl')->with('success', 'PKL setujui');
    }

    public function unchangestatus(Request $request)
    {
        $datapkl = PKL::find($request->id);

        $datapkl->isverified = $request->isverified;
        // dd($request);
        $datapkl->update(['isverified' => 0]);
        return redirect('/dashboarddosen/pkl')->with('gagal', 'PKL tidak disetujui');
    }
}
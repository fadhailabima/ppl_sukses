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
    public function store(Request $request)
    {
        $user_id = auth()->user()->id;
        $semester = $request->input('semester');

        // Cek apakah ada IRS sebelumnya yang belum disetujui
        $previousSemester = $semester - 1;
        $previousIRS = IRS::where('userid', $user_id)
            ->where('semester', $previousSemester)
            ->where('isverified', 0)
            ->first();

        if ($previousIRS) {
            return redirect('/dashboardmahasiswa/IsiIRSMahasiswa')->with('gagal', 'Anda harus menunggu persetujuan IRS semester sebelumnya.');
        }

        // Dapatkan semester terakhir yang telah diisi oleh mahasiswa
        $latestSemester = IRS::where('userid', $user_id)
            ->max('semester');

        // Tentukan semester berikutnya yang seharusnya diisi
        $expectedSemester = $latestSemester + 1;

        // Jika semester yang akan diisi tidak sesuai dengan yang seharusnya, beri pesan kesalahan
        if ($semester != $expectedSemester) {
            return redirect('/dashboardmahasiswa/IsiIRSMahasiswa')->with('gagal', 'Anda hanya dapat mengisi IRS untuk semester ' . $expectedSemester);
        }

        // Cek apakah ada IRS yang lebih tinggi dari semester yang akan diisi
        $nextIRS = IRS::where('userid', $user_id)
            ->where('semester', '>', $semester)
            ->exists();

        if ($nextIRS) {
            return redirect('/dashboardmahasiswa/IsiIRSMahasiswa')->with('gagal', 'Anda harus mengisi IRS semester sebelumnya terlebih dahulu.');
        }

        // Cek apakah sudah ada IRS untuk semester yang akan diisi
        $existingIRS = IRS::where('userid', $user_id)
            ->where('semester', $semester)
            ->exists();

        if ($existingIRS) {
            return redirect('/dashboardmahasiswa/IsiIRSMahasiswa')->with('gagal', 'Anda sudah mengisi IRS untuk semester ini.');
        }

        $validatedata = $request->validate([
            'semester' => 'required',
            'jmlsks' => 'required|lte:25',
            'scansks' => 'required|file|mimes:pdf'
        ]);

        $validatedata['userid'] = $user_id;
        $validatedata['scansks'] = $request->file('scansks')->getClientOriginalName();

        $request->file('scansks')->storeAs('public/post-scansks/', $validatedata['scansks']);
        Irs::create($validatedata);

        return redirect('/dashboardmahasiswa/IsiIRSMahasiswa')->with('success', 'Data berhasil dimasukkan');
    }
}
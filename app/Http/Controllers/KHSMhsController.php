<?php

namespace App\Http\Controllers;

use App\Models\KHS;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class KHSMhsController extends Controller
{
    public function index()
    {
        return view('mahasiswa.IsiKhsMhs', [
            'title' => 'Isi KHS Mahasiswa'
        ]);
    }
    public function store(Request $request)
    {
        $validatedata = $request->validate([
            'semester' => 'required',
            'skssemester' => 'required|integer|lte:25',
            'skskumulatif' => 'required|integer|lte:150',
            'ipsemester' => 'required|regex:/^\d+(\.\d{1,2})?$/|lte:4',
            'ipkumulatif' => 'required|regex:/^\d+(\.\d{1,2})?$/|lte:4',
            'scankhs' => 'required|file|mimes:pdf'
        ]);
        $validatedata['userid'] = auth()->user()->id;
        $validatedata['scankhs'] = $request->file('scankhs')->getClientOriginalName();
        $semester = $validatedata['semester'];

        // Cek apakah ada KHS sebelumnya yang belum disetujui
        $previousSemester = $semester - 1;
        $previousKHS = KHS::where('userid', auth()->user()->id)
            ->where('semester', $previousSemester)
            ->where('isverified', 0)
            ->first();

        if ($previousKHS) {
            return redirect('/dashboardmahasiswa/IsiKHSMahasiswa')->with('gagal', 'Anda harus menunggu persetujuan KHS semester sebelumnya.');
        }

        // Dapatkan semester terakhir yang telah diisi oleh mahasiswa
        $latestSemester = KHS::where('userid', auth()->user()->id)
            ->max('semester');

        // Tentukan semester berikutnya yang seharusnya diisi
        $expectedSemester = $latestSemester + 1;

        // Jika semester yang akan diisi tidak sesuai dengan yang seharusnya, beri pesan kesalahan
        if ($semester != $expectedSemester) {
            return redirect('/dashboardmahasiswa/IsiKHSMahasiswa')->with('gagal', 'Anda hanya dapat mengisi KHS untuk semester ' . $expectedSemester);
        }

        // Cek apakah ada KHS yang lebih tinggi dari semester yang akan diisi
        $nextKHS = KHS::where('userid', auth()->user()->id)
            ->where('semester', '>', $semester)
            ->exists();

        if ($nextKHS) {
            return redirect('/dashboardmahasiswa/IsiKHSMahasiswa')->with('gagal', 'Anda harus mengisi KHS semester sebelumnya terlebih dahulu.');
        }

        // Cek apakah sudah ada KHS untuk semester yang akan diisi
        $existingKHS = KHS::where('userid', auth()->user()->id)
            ->where('semester', $semester)
            ->exists();

        if ($existingKHS) {
            return redirect('/dashboardmahasiswa/IsiKHSMahasiswa')->with('gagal', 'Anda sudah mengisi KHS untuk semester ini.');
        }

        $request->file('scankhs')->storeAs('public/post-scankhs/', $validatedata['scankhs']);
        KHS::create($validatedata);

        return redirect('/dashboardmahasiswa/IsiKHSMahasiswa')->with('success', 'Data berhasil dimasukkan');
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\IRS;
use App\Models\KHS;
use App\Models\PKL;
use App\Models\Skripsi;
use App\Models\User;
use App\Models\MHS;
use App\Models\DosenWali;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class OperatorController extends Controller
{
    public function index()
    {
        //status
        $useractivecount = MHS::query()
            ->where('status', '=', 'Aktif')
            ->count();
        $userMangkircount = MHS::query()
            ->where('status', '=', 'Mangkir')
            ->count();
        $userCuticount = MHS::query()
            ->where('status', '=', 'Cuti')
            ->count();
        $userDropoutcount = MHS::query()
            ->where('status', '=', 'DO')
            ->count();
        $userLuluscount = MHS::query()
            ->where('status', '=', 'Lulus')
            ->count();


        //level
        $mahasiswa = User::query()
            ->where('level', '=', 'mahasiswa')
            ->count();
        $dosen = User::query()
            ->where('level', '=', 'dosen')
            ->count();
        $department = User::query()
            ->where('level', '=', 'department')
            ->count();
        $operator = User::query()
            ->where('level', '=', 'operator')
            ->count();



        return view(
            'operator.dashboardoperator',
            compact(
                'useractivecount',
                'mahasiswa',
                'dosen',
                'department',
                'operator',
                'userMangkircount',
                'userCuticount',
                'userDropoutcount',
                'userLuluscount'
            )
        );
    }

    public function dataMHS(Request $request)
    {
        if ($request->has('search')) {
            $mahasiswa = DB::table('mahasiswas')
                // ->where('dosen_wali', '=', auth()->user()->dosenWali->nip)
                ->where(function ($query) use ($request) {
                    $query->where('nama', 'LIKE', '%' . $request->search . '%')
                        ->orWhere('nim', 'LIKE', '%' . $request->search . '%');
                })
                ->paginate(10);
        } else {
            $mahasiswa = DB::table('mahasiswas')
                // ->where('dosen_wali', '=', auth()->user()->dosenWali->nip)
                ->paginate(10);
        }
        return view('operator.dataMHSoperator', compact('mahasiswa'));
    }

    public function ubahstatus(Request $request)
    {
        $datamhs = MHS::find($request->nim);

        if (!$datamhs) {
            return redirect('/dashboardadmin/daftarmahasiswa')->with('error', 'Mahasiswa tidak ditemukan');
        }

        $datamhs->status = $request->status;
        $datamhs->save();

        return redirect('/dashboardadmin/daftarmahasiswa')->with('success', 'Status mahasiswa berhasil diubah');
    }

    public function rekapPKL()
    {

        $tahun = DB::table('mahasiswas')
            ->select('angkatan')
            ->distinct()
            ->orderBy('angkatan', 'asc')
            ->pluck('angkatan')
            ->toArray();

        $minYear = 2017; // Tahun terkecil yang Anda inginkan
        $maxYear = 2022; // Tahun terbesar yang Anda inginkan

        // Generate range tahun dari minYear sampai maxYear
        $tahunRange = range($minYear, $maxYear);

        // Loop untuk setiap tahun dalam rentang yang Anda tentukan
        foreach ($tahunRange as $year) {
            // Jika tahun tidak ada dalam data dari database
            if (!in_array($year, $tahun)) {
                $jumlahMahasiswaPKL[$year] = 0;
                $jumlahMahasiswaBlmPKL[$year] = 0;
            } else {
                // Hitung jumlah mahasiswa PKL dan belum PKL untuk tahun yang ada dalam database
                $jumlahMahasiswaPKL[$year] = PKL::join('mahasiswas', 'p_k_l_s.mahasiswa_id', '=', 'mahasiswas.nim')
                    ->where('mahasiswas.angkatan', $year)
                    ->where('p_k_l_s.isverified', 1)
                    ->select(DB::raw('COUNT(DISTINCT mahasiswas.nim) as jumlah'))
                    ->count();

                $jumlahMahasiswaBlmPKL[$year] = MHS::where('angkatan', $year)
                    ->where(function ($query) {
                        $query->whereDoesntHave('pkl')
                            ->orWhereHas('pkl', function ($query) {
                                $query->where('isverified', 0);
                            });
                    })
                    ->count();
            }
        }

        return view('operator.rekapPKLoperator', compact('jumlahMahasiswaPKL', 'jumlahMahasiswaBlmPKL', 'tahunRange', 'minYear', 'maxYear'));
    }

    public function generatedrekapPkl()
    {
        $tahun = DB::table('mahasiswas')
            ->select('angkatan')
            ->distinct()
            ->orderBy('angkatan', 'asc')
            ->pluck('angkatan')
            ->toArray();

        $minYear = 2017; // Tahun terkecil yang Anda inginkan
        $maxYear = 2022; // Tahun terbesar yang Anda inginkan

        $tahunRange = range($minYear, $maxYear);

        $jumlahMahasiswaPKL = [];
        $jumlahMahasiswaBlmPKL = [];

        foreach ($tahunRange as $year) {
            if (!in_array($year, $tahun)) {
                $jumlahMahasiswaPKL[$year] = 0;
                $jumlahMahasiswaBlmPKL[$year] = 0;
            } else {
                $jumlahMahasiswaPKL[$year] = PKL::join('mahasiswas', 'p_k_l_s.mahasiswa_id', '=', 'mahasiswas.nim')
                    ->where('mahasiswas.angkatan', $year)
                    ->where('p_k_l_s.isverified', 1)
                    ->select(DB::raw('COUNT(DISTINCT mahasiswas.nim) as jumlah'))
                    ->count();

                $jumlahMahasiswaBlmPKL[$year] = MHS::where('angkatan', $year)
                    ->where(function ($query) {
                        $query->whereDoesntHave('pkl')
                            ->orWhereHas('pkl', function ($query) {
                                $query->where('isverified', 0);
                            });
                    })
                    ->count();
            }
        }

        $pdf = PDF::loadView('operator.rekapPKLoperator_pdf', compact('jumlahMahasiswaPKL', 'jumlahMahasiswaBlmPKL', 'tahunRange'))->setOptions(['defaultFont' => 'sans-serif']);

        return $pdf->stream();
    }

    public function dataSudahPKL($tahun)
    {


        $dosenwalis = DosenWali::join('mahasiswas', 'dosenwalis.nip', '=', 'mahasiswas.dosen_wali')
            ->where('mahasiswas.angkatan', $tahun)
            ->select('dosenwalis.nama') // Pilih kolom nama dosen
            ->first();

        $namaDosenWali = $dosenwalis ? $dosenwalis->nama : null;

        $p_k_l_s = PKL::join('mahasiswas', 'p_k_l_s.mahasiswa_id', '=', 'mahasiswas.nim')
            ->where('mahasiswas.angkatan', $tahun)
            ->where('p_k_l_s.isverified', 1)
            // ->where('PKL.persetujuan', 'Disetujui')
            ->select('p_k_l_s.*', 'mahasiswas.nim as nim', 'mahasiswas.nama as nama', 'mahasiswas.angkatan as angkatan', 'mahasiswas.dosen_wali as dosen_wali', 'p_k_l_s.nilai_pkl', 'p_k_l_s.dosenpengampu')
            ->get();

        return view('operator.listSudahPKLoperator', compact('p_k_l_s', 'tahun', 'dosenwalis', 'namaDosenWali'));
    }

    public function dataBlmPKL($tahun)
    {
        $dosenwalis = DosenWali::join('mahasiswas', 'dosenwalis.nip', '=', 'mahasiswas.dosen_wali')
            ->where('mahasiswas.angkatan', $tahun)
            ->select('dosenwalis.nama') // Pilih kolom nama dosen
            ->first();

        $namaDosenWali = $dosenwalis ? $dosenwalis->nama : null;

        $belumPKL = MHS::where('angkatan', $tahun)
            ->whereDoesntHave('pkl', function ($query) {
                $query->where('isverified', 0);
            })
            ->orWhereDoesntHave('pkl')
            ->get();

        return view('operator.listBelumPKLoperator', compact('belumPKL', 'tahun', 'dosenwalis', 'namaDosenWali'));
    }

    public function generatePDFSudahPKL($tahun)
    {
        $dosenwalis = DosenWali::join('mahasiswas', 'dosenwalis.nip', '=', 'mahasiswas.dosen_wali')
            ->where('mahasiswas.angkatan', $tahun)
            ->select('dosenwalis.nama') // Pilih kolom nama dosen
            ->first();

        $namaDosenWali = $dosenwalis ? $dosenwalis->nama : null;

        $p_k_l_s = PKL::join('mahasiswas', 'p_k_l_s.mahasiswa_id', '=', 'mahasiswas.nim')
            ->where('mahasiswas.angkatan', $tahun)
            ->where('p_k_l_s.isverified', 1)
            ->select('p_k_l_s.*', 'mahasiswas.nim as nim', 'mahasiswas.nama as nama', 'mahasiswas.angkatan as angkatan', 'mahasiswas.dosen_wali as dosen_wali', 'p_k_l_s.nilai_pkl', 'p_k_l_s.dosenpengampu')
            ->get();

        $pdf = PDF::loadView('operator.listSudahPKLoperator_pdf', compact('p_k_l_s', 'tahun', 'dosenwalis', 'namaDosenWali'))->setOptions(['defaultFont' => 'sans-serif']);

        return $pdf->stream('listSudahPKLoperator.pdf');
    }

    public function generatedlistBelumPKL($tahun)
    {
        $dosenwalis = DosenWali::join('mahasiswas', 'dosenwalis.nip', '=', 'mahasiswas.dosen_wali')
            ->where('mahasiswas.angkatan', $tahun)
            ->select('dosenwalis.nama') // Pilih kolom nama dosen
            ->first();

        $namaDosenWali = $dosenwalis ? $dosenwalis->nama : null;

        $belumPKL = MHS::where('angkatan', $tahun)
            ->whereDoesntHave('pkl', function ($query) {
                $query->where('isverified', 0);
            })
            ->orWhereDoesntHave('pkl')
            ->get();

        // Load view dengan data yang ingin Anda cetak ke PDF
        $pdf = PDF::loadView('operator.listBelumPKLoperator_pdf', compact('belumPKL', 'tahun', 'dosenwalis', 'namaDosenWali'));

        // Menggunakan setOptions untuk mengatur font default jika diperlukan
        $pdf->setOptions(['defaultFont' => 'sans-serif']);

        // Menghasilkan PDF dan mengembalikannya sebagai respons untuk diunduh
        return $pdf->stream('listBelumoperator_pkl.pdf');
    }

    public function rekapSkripsi()
    {

        $tahun = DB::table('mahasiswas')
            ->select('angkatan')
            ->distinct()
            ->orderBy('angkatan', 'asc')
            ->pluck('angkatan')
            ->toArray();

        $minYear = 2017; // Tahun terkecil yang Anda inginkan
        $maxYear = 2022; // Tahun terbesar yang Anda inginkan

        // Generate range tahun dari minYear sampai maxYear
        $tahunRange = range($minYear, $maxYear);

        // Loop untuk setiap tahun dalam rentang yang Anda tentukan
        foreach ($tahunRange as $year) {
            // Jika tahun tidak ada dalam data dari database
            if (!in_array($year, $tahun)) {
                $jumlahMahasiswaSkripsi[$year] = 0;
                $jumlahMahasiswaBlmSkripsi[$year] = 0;
            } else {
                // Hitung jumlah mahasiswa PKL dan belum PKL untuk tahun yang ada dalam database
                $jumlahMahasiswaSkripsi[$year] = Skripsi::join('mahasiswas', 'skripsis.mahasiswa_id', '=', 'mahasiswas.nim')
                    ->where('mahasiswas.angkatan', $year)
                    ->where('skripsis.isverified', 1)
                    ->select(DB::raw('COUNT(DISTINCT mahasiswas.nim) as jumlah'))
                    ->count();

                $jumlahMahasiswaBlmSkripsi[$year] = MHS::where('angkatan', $year)
                    ->where(function ($query) {
                        $query->whereDoesntHave('skripsi')
                            ->orWhereHas('skripsi', function ($query) {
                                $query->where('isverified', 0);
                            });
                    })
                    ->count();
            }
        }

        return view('operator.rekapSkripsioperator', compact('jumlahMahasiswaSkripsi', 'jumlahMahasiswaBlmSkripsi', 'tahunRange', 'minYear', 'maxYear'));
    }

    public function generatedrekapSkripsi()
    {
        $tahun = DB::table('mahasiswas')
            ->select('angkatan')
            ->distinct()
            ->orderBy('angkatan', 'asc')
            ->pluck('angkatan')
            ->toArray();

        $minYear = 2017; // Tahun terkecil yang Anda inginkan
        $maxYear = 2022; // Tahun terbesar yang Anda inginkan

        $tahunRange = range($minYear, $maxYear);

        $jumlahMahasiswaSkripsi = [];
        $jumlahMahasiswaBlmSkripsi = [];

        foreach ($tahunRange as $year) {
            if (!in_array($year, $tahun)) {
                $jumlahMahasiswaSkripsi[$year] = 0;
                $jumlahMahasiswaBlmSkripsi[$year] = 0;
            } else {
                $jumlahMahasiswaSkripsi[$year] = Skripsi::join('mahasiswas', 'skripsis.mahasiswa_id', '=', 'mahasiswas.nim')
                    ->where('mahasiswas.angkatan', $year)
                    ->where('skripsis.isverified', 1)
                    ->select(DB::raw('COUNT(DISTINCT mahasiswas.nim) as jumlah'))
                    ->count();

                $jumlahMahasiswaBlmSkripsi[$year] = MHS::where('angkatan', $year)
                    ->where(function ($query) {
                        $query->whereDoesntHave('skripsi')
                            ->orWhereHas('skripsi', function ($query) {
                                $query->where('isverified', 0);
                            });
                    })
                    ->count();
            }
        }

        $pdf = PDF::loadView('operator.rekapSkripsiOperator_pdf', compact('jumlahMahasiswaSkripsi', 'jumlahMahasiswaBlmSkripsi', 'tahunRange'))->setOptions(['defaultFont' => 'sans-serif']);

        return $pdf->stream();
    }

    public function dataBlmSkripsi($tahun)
    {
        $dosenwalis = DosenWali::join('mahasiswas', 'dosenwalis.nip', '=', 'mahasiswas.dosen_wali')
            ->where('mahasiswas.angkatan', $tahun)
            ->select('dosenwalis.nama') // Pilih kolom nama dosen
            ->first();

        $namaDosenWali = $dosenwalis ? $dosenwalis->nama : null;

        $belumSkripsi = MHS::where('angkatan', $tahun)
            ->whereDoesntHave('skripsi', function ($query) {
                $query->where('isverified', 0);
            })
            ->orWhereDoesntHave('skripsi')
            ->get();

        return view('operator.listBelumSkripsiOperator', compact('belumSkripsi', 'tahun', 'dosenwalis', 'namaDosenWali'));
    }

    public function generatedlistBelumSkripsi($tahun)
    {
        $dosenwalis = DosenWali::join('mahasiswas', 'dosenwalis.nip', '=', 'mahasiswas.dosen_wali')
            ->where('mahasiswas.angkatan', $tahun)
            ->select('dosenwalis.nama') // Pilih kolom nama dosen
            ->first();

        $namaDosenWali = $dosenwalis ? $dosenwalis->nama : null;

        $belumSkripsi = MHS::where('angkatan', $tahun)
            ->whereDoesntHave('skripsi', function ($query) {
                $query->where('isverified', 0);
            })
            ->orWhereDoesntHave('skripsi')
            ->get();

        // Load view dengan data yang ingin Anda cetak ke PDF
        $pdf = PDF::loadView('operator.listBelumSkripsiOperator_pdf', compact('belumSkripsi', 'tahun', 'dosenwalis', 'namaDosenWali'));

        // Menggunakan setOptions untuk mengatur font default jika diperlukan
        $pdf->setOptions(['defaultFont' => 'sans-serif']);

        // Menghasilkan PDF dan mengembalikannya sebagai respons untuk diunduh
        return $pdf->stream('listBelum_Skripsi.pdf');
    }

    public function dataSudahSkripsi($tahun)
    {


        $dosenwalis = DosenWali::join('mahasiswas', 'dosenwalis.nip', '=', 'mahasiswas.dosen_wali')
            ->where('mahasiswas.angkatan', $tahun)
            ->select('dosenwalis.nama') // Pilih kolom nama dosen
            ->first();

        $namaDosenWali = $dosenwalis ? $dosenwalis->nama : null;

        $skripsis = Skripsi::join('mahasiswas', 'skripsis.mahasiswa_id', '=', 'mahasiswas.nim')
            ->where('mahasiswas.angkatan', $tahun)
            ->where('skripsis.isverified', 1)
            // ->where('PKL.persetujuan', 'Disetujui')
            ->select('skripsis.*', 'mahasiswas.nim as nim', 'mahasiswas.nama as nama', 'mahasiswas.angkatan as angkatan', 'mahasiswas.dosen_wali as dosen_wali', 'skripsis.tglsidang', 'skripsis.dosenpembimbing')
            ->get();

        return view('operator.listSudahSkripsiOperator', compact('skripsis', 'tahun', 'dosenwalis', 'namaDosenWali'));
    }

    public function generatedlistSudahSkripsi($tahun)
    {
        $dosenwalis = DosenWali::join('mahasiswas', 'dosenwalis.nip', '=', 'mahasiswas.dosen_wali')
            ->where('mahasiswas.angkatan', $tahun)
            ->select('dosenwalis.nama') // Pilih kolom nama dosen
            ->first();

        $namaDosenWali = $dosenwalis ? $dosenwalis->nama : null;

        $skripsis = Skripsi::join('mahasiswas', 'skripsis.mahasiswa_id', '=', 'mahasiswas.nim')
            ->where('mahasiswas.angkatan', $tahun)
            ->where('skripsis.isverified', 1)
            ->select('skripsis.*', 'mahasiswas.nim as nim', 'mahasiswas.nama as nama', 'mahasiswas.angkatan as angkatan', 'mahasiswas.dosen_wali as dosen_wali', 'skripsis.tglsidang', 'skripsis.dosenpembimbing')
            ->get();

        $pdf = PDF::loadView('operator.listSudahSkripsiOperator_pdf', compact('skripsis', 'tahun', 'dosenwalis', 'namaDosenWali'))->setOptions(['defaultFont' => 'sans-serif']);

        return $pdf->stream('listSudahSkripsi.pdf');
    }

    public function rekapStatus()
    {
        $tahun = DB::table('mahasiswas')
            ->select('angkatan')
            ->distinct()
            ->orderBy('angkatan', 'asc')
            ->pluck('angkatan')
            ->toArray();

        $minYear = 2017; // Tahun terkecil yang Anda inginkan
        $maxYear = 2022; // Tahun terbesar yang Anda inginkan

        // Generate range tahun dari minYear sampai maxYear
        $tahunRange = range($minYear, $maxYear);

        // Array untuk menyimpan hasil
        $jumlahMahasiswaAktif = [];
        $jumlahMahasiswaNonAktif = [];

        // Loop untuk setiap tahun dalam rentang yang Anda tentukan
        foreach ($tahunRange as $year) {
            // Jika tahun tidak ada dalam data dari database
            if (!in_array($year, $tahun)) {
                $jumlahMahasiswaAktif[$year] = 0;
                $jumlahMahasiswaNonAktif[$year] = 0;
            } else {
                // Hitung jumlah mahasiswa PKL dan belum PKL untuk tahun yang ada dalam database
                $jumlahMahasiswaAktif[$year] = MHS::where('angkatan', $year)
                    ->where('status', 'Aktif') // Ganti 'Aktif' dengan status yang diinginkan
                    ->count();

                $jumlahMahasiswaNonAktif[$year] = MHS::where('angkatan', $year)
                    ->where(function ($query) {
                        $query->whereIn('status', ['NON AKTIF', 'Cuti', 'Mangkir', 'DO', 'Undur Diri', 'Lulus', 'Meninggal Dunia']);
                    })
                    ->count();
            }
        }

        // Lakukan apa yang diperlukan dengan hasil perhitungan
        // ...

        // Contoh mengirimkan hasil ke view
        return view('operator.rekapStatusOperator', compact('jumlahMahasiswaAktif', 'jumlahMahasiswaNonAktif', 'tahunRange', 'minYear', 'maxYear'));
    }

    public function generatedrekapStatus()
    {
        $tahun = DB::table('mahasiswas')
            ->select('angkatan')
            ->distinct()
            ->orderBy('angkatan', 'asc')
            ->pluck('angkatan')
            ->toArray();

        $minYear = 2017; // Tahun terkecil yang Anda inginkan
        $maxYear = 2022; // Tahun terbesar yang Anda inginkan

        $tahunRange = range($minYear, $maxYear);

        $jumlahMahasiswaSkripsi = [];
        $jumlahMahasiswaBlmSkripsi = [];

        foreach ($tahunRange as $year) {
            // Jika tahun tidak ada dalam data dari database
            if (!in_array($year, $tahun)) {
                $jumlahMahasiswaAktif[$year] = 0;
                $jumlahMahasiswaNonAktif[$year] = 0;
            } else {
                // Hitung jumlah mahasiswa PKL dan belum PKL untuk tahun yang ada dalam database
                $jumlahMahasiswaAktif[$year] = MHS::where('angkatan', $year)
                    ->where('status', 'Aktif') // Ganti 'Aktif' dengan status yang diinginkan
                    ->count();

                $jumlahMahasiswaNonAktif[$year] = MHS::where('angkatan', $year)
                    ->where(function ($query) {
                        $query->whereIn('status', ['NON AKTIF', 'Cuti', 'Mangkir', 'DO', 'Undur Diri', 'Lulus', 'Meninggal Dunia']);
                    })
                    ->count();
            }
        }

        $pdf = PDF::loadView('operator.rekapStatusOperator_pdf', compact('jumlahMahasiswaAktif', 'jumlahMahasiswaNonAktif', 'tahunRange'))->setOptions(['defaultFont' => 'sans-serif']);

        return $pdf->stream();
    }

    public function MhsAktif($tahun)
    {


        $dosenwalis = DosenWali::join('mahasiswas', 'dosenwalis.nip', '=', 'mahasiswas.dosen_wali')
            ->where('mahasiswas.angkatan', $tahun)
            ->select('dosenwalis.nama') // Pilih kolom nama dosen
            ->first();

        $namaDosenWali = $dosenwalis ? $dosenwalis->nama : null;

        $mahasiswaAktif = MHS::where('angkatan', $tahun)
            ->where('status', 'Aktif') // Ganti 'Aktif' dengan status yang diinginkan
            ->select('nim', 'nama', 'angkatan', 'dosen_wali')
            ->get();

        return view('operator.listStatusAktifOperator', compact('mahasiswaAktif', 'tahun', 'dosenwalis', 'namaDosenWali'));
    }

    public function generatedlistMhsAktif($tahun)
    {
        $dosenwalis = DosenWali::join('mahasiswas', 'dosenwalis.nip', '=', 'mahasiswas.dosen_wali')
            ->where('mahasiswas.angkatan', $tahun)
            ->select('dosenwalis.nama') // Pilih kolom nama dosen
            ->first();

        $namaDosenWali = $dosenwalis ? $dosenwalis->nama : null;

        $mahasiswaAktif = MHS::where('angkatan', $tahun)
            ->where('status', 'Aktif') // Ganti 'Aktif' dengan status yang diinginkan
            ->select('nim', 'nama', 'angkatan', 'dosen_wali')
            ->get();

        $pdf = PDF::loadView('operator.listStatusAktifOperator_pdf', compact('mahasiswaAktif', 'tahun', 'dosenwalis', 'namaDosenWali'))->setOptions(['defaultFont' => 'sans-serif']);

        return $pdf->stream('listStatusAktif.pdf');
    }

    public function MhsNonAktif($tahun)
    {


        $dosenwalis = DosenWali::join('mahasiswas', 'dosenwalis.nip', '=', 'mahasiswas.dosen_wali')
            ->where('mahasiswas.angkatan', $tahun)
            ->select('dosenwalis.nama') // Pilih kolom nama dosen
            ->first();

        $namaDosenWali = $dosenwalis ? $dosenwalis->nama : null;

        $status = MHS::where('angkatan', $tahun)
            ->where('status', ['NON AKTIF', 'Cuti', 'Mangkir', 'DO', 'Undur Diri', 'Lulus', 'Meninggal Dunia']) // Ganti 'Aktif' dengan status yang diinginkan
            ->select('nim', 'nama', 'angkatan', 'dosen_wali', 'status')
            ->get();

        return view('operator.listStatusNonaktifOperator', compact('status', 'tahun', 'dosenwalis', 'namaDosenWali'));
    }

    public function generatedlistMhsNonAktif($tahun)
    {
        $dosenwalis = DosenWali::join('mahasiswas', 'dosenwalis.nip', '=', 'mahasiswas.dosen_wali')
            ->where('mahasiswas.angkatan', $tahun)
            ->select('dosenwalis.nama') // Pilih kolom nama dosen
            ->first();

        $namaDosenWali = $dosenwalis ? $dosenwalis->nama : null;

        $status = MHS::where('angkatan', $tahun)
            ->where('status', ['NON AKTIF', 'Cuti', 'Mangkir', 'DO', 'Undur Diri', 'Lulus', 'Meninggal Dunia']) // Ganti 'Aktif' dengan status yang diinginkan
            ->select('nim', 'nama', 'angkatan', 'dosen_wali', 'status')
            ->get();

        $pdf = PDF::loadView('operator.listStatusNonaktifOperator_pdf', compact('status', 'tahun', 'dosenwalis', 'namaDosenWali'))->setOptions(['defaultFont' => 'sans-serif']);

        return $pdf->stream('listStatusNonAktif.pdf');
    }
}
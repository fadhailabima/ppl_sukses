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

class DepartmentsController extends Controller
{
    public function index()
    {
        // Menghitung jumlah mahasiswa
        $jmlmhs = MHS::count();

        // IRS
        $irsData = DB::table('irs')
            ->join('mahasiswas', 'irs.mahasiswa_id', '=', 'mahasiswas.nim')
            // ->where('dosen_wali', '=', auth()->user()->dosenWali->nip)
            ->select('mahasiswas.nim as mahasiswanim', 'irs.semester', 'irs.isverified')
            ->get();

        $irsCollection = collect($irsData);
        $uniqueUsersIRS = $irsCollection->groupBy('mahasiswanim');

        $irsCountNotVerified = $uniqueUsersIRS->flatMap(function ($group) {
            return $group->where('isverified', 0)->pluck('mahasiswanim')->unique();
        })->count();

        $irsCountVerified = $uniqueUsersIRS->flatMap(function ($group) {
            return $group->where('isverified', 1)->pluck('mahasiswanim')->unique();
        })->count();
        $irsbelum = max(0, $jmlmhs - $irsCountNotVerified - $irsCountVerified);

        // KHS
        $khsData = DB::table('k_h_s')
            ->join('mahasiswas', 'k_h_s.mahasiswa_id', '=', 'mahasiswas.nim')
            // ->where('dosen_wali', '=', auth()->user()->dosenWali->nip)
            ->select('mahasiswas.nim as mahasiswanim', 'k_h_s.semester', 'k_h_s.isverified')
            ->get();

        $khsCollection = collect($khsData);
        $uniqueUsersKHS = $khsCollection->groupBy('mahasiswanim');

        $khsCountNotVerified = $uniqueUsersKHS->flatMap(function ($group) {
            return $group->where('isverified', 0)->pluck('mahasiswanim')->unique();
        })->count();

        $khsCountVerified = $uniqueUsersKHS->flatMap(function ($group) {
            return $group->where('isverified', 1)->pluck('mahasiswanim')->unique();
        })->count();
        $khsbelum = max(0, $jmlmhs - $khsCountNotVerified - $khsCountVerified);

        // PKL
        $pklCountNotVerified = DB::table('p_k_l_s')
            ->join('mahasiswas', 'p_k_l_s.mahasiswa_id', '=', 'mahasiswas.nim')
            // ->where('dosen_wali', '=', auth()->user()->dosenWali->nip)
            ->where('isverified', '=', '0')
            ->count();
        $pklCountVerified = DB::table('p_k_l_s')
            ->join('mahasiswas', 'p_k_l_s.mahasiswa_id', '=', 'mahasiswas.nim')
            // ->where('dosen_wali', '=', auth()->user()->dosenWali->nip)
            ->where('isverified', '=', '1')
            ->count();

        // $pklCountNotVerified = $pklData->where('isverified', 0)->count();
        // $pklCountVerified = $pklData->where('isverified', 1)->count();
        $pklbelum = $jmlmhs - $pklCountNotVerified - $pklCountVerified;

        // Skripsi
        $skripsicountnotverified = DB::table('skripsis')
            ->join('mahasiswas', 'skripsis.mahasiswa_id', '=', 'mahasiswas.nim')
            // ->where('dosen_wali', '=', auth()->user()->dosenWali->nip)
            ->where('isverified', '=', '0')
            ->count();
        $skripsicountverified = DB::table('skripsis')
            ->join('mahasiswas', 'skripsis.mahasiswa_id', '=', 'mahasiswas.nim')
            // ->where('dosen_wali', '=', auth()->user()->dosenWali->nip)
            ->where('isverified', '=', '1')
            ->count();
        $skripsibelum = $jmlmhs - $skripsicountnotverified - $skripsicountverified;


        return view(
            'department.dashboardDepartment',
            compact(
                'jmlmhs',
                'irsCountNotVerified',
                'irsCountVerified',
                'irsbelum',
                'khsCountNotVerified',
                'khsCountVerified',
                'khsbelum',
                'pklCountNotVerified',
                'pklCountVerified',
                'pklbelum',
                'skripsicountnotverified',
                'skripsicountverified',
                'skripsibelum'
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
        return view('department.DataMhsdepartment', compact('mahasiswa'));
    }

    public function detailMHS(Request $request, $nim)
    {
        $mahasiswa = MHS::where('nim', $nim)
            // ->where('dosen_wali', auth()->user()->dosenWali->nip)
            ->with('irs', 'khs', 'pkl', 'skripsi')
            ->first();

        if (!$mahasiswa) {
            return redirect()->back()->with('error', 'Mahasiswa tidak ditemukan atau tidak terkait dengan perwalian Anda.');
        }

        $semesterStatus = [];

        // Loop untuk setiap semester
        for ($i = 1; $i <= 14; $i++) {
            $semesterStatus[$i] = 'red'; // Set default status merah

            // IRS
            $irsStatus = $mahasiswa->irs ? $mahasiswa->irs->where('semester', $i)->first() : null;

            // KHS
            $khsStatus = $mahasiswa->khs->where('semester', $i)->first();

            // PKL
            $pklStatus = $mahasiswa->pkl ? $mahasiswa->pkl->where('semester', $i)->first() : null;

            // Skripsi
            $skripsiStatus = $mahasiswa->skripsi ? $mahasiswa->skripsi->where('semester', $i)->first() : null;

            if ($irsStatus && $irsStatus->isverified && $khsStatus && $khsStatus->isverified && $pklStatus && $pklStatus->isverified) {
                $semesterStatus[$i] = 'yellow';
            } elseif ($irsStatus === null && $khsStatus === null && $pklStatus === null) {
                $semesterStatus[$i] = 'red'; // Jika IRS *dan* KHS disetujui, maka warna biru
            } elseif ($irsStatus && $irsStatus->isverified && $khsStatus && $khsStatus->isverified && $skripsiStatus && $skripsiStatus->isverified) {
                $semesterStatus[$i] = 'green'; // Jika Skripsi disetujui, maka warna hijau
            } elseif ($irsStatus === null && $khsStatus === null && $skripsiStatus === null) {
                $semesterStatus[$i] = 'red';
            } elseif ($irsStatus && $irsStatus->isverified && $khsStatus && $khsStatus->isverified) {
                $semesterStatus[$i] = 'blue';
            } elseif ($irsStatus === null && $khsStatus === null) {
                $semesterStatus[$i] = 'red'; // Jika PKL disetujui, maka warna kuning
            }
        }


        return view('department.detailMHS', compact('mahasiswa', 'semesterStatus'));
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

        return view('department.rekapPKL', compact('jumlahMahasiswaPKL', 'jumlahMahasiswaBlmPKL', 'tahunRange', 'minYear', 'maxYear'));
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

        $pdf = PDF::loadView('department.rekapPKL_pdf', compact('jumlahMahasiswaPKL', 'jumlahMahasiswaBlmPKL', 'tahunRange'))->setOptions(['defaultFont' => 'sans-serif']);

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

        return view('department.listSudahPKL', compact('p_k_l_s', 'tahun', 'dosenwalis', 'namaDosenWali'));
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

        return view('department.listBelumPKL', compact('belumPKL', 'tahun', 'dosenwalis', 'namaDosenWali'));
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
        $pdf = PDF::loadView('department.listBelumPKL_pdf', compact('belumPKL', 'tahun', 'dosenwalis', 'namaDosenWali'));

        // Menggunakan setOptions untuk mengatur font default jika diperlukan
        $pdf->setOptions(['defaultFont' => 'sans-serif']);

        // Menghasilkan PDF dan mengembalikannya sebagai respons untuk diunduh
        return $pdf->stream('listBelum_pkl.pdf');
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

        $pdf = PDF::loadView('department.listSudahPKL_pdf', compact('p_k_l_s', 'tahun', 'dosenwalis', 'namaDosenWali'))->setOptions(['defaultFont' => 'sans-serif']);

        return $pdf->stream('listSudahPKL.pdf');
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

        return view('department.rekapSkripsi', compact('jumlahMahasiswaSkripsi', 'jumlahMahasiswaBlmSkripsi', 'tahunRange', 'minYear', 'maxYear'));
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

        $pdf = PDF::loadView('department.rekapSkripsi_pdf', compact('jumlahMahasiswaSkripsi', 'jumlahMahasiswaBlmSkripsi', 'tahunRange'))->setOptions(['defaultFont' => 'sans-serif']);

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

        return view('department.listBelumSkripsi', compact('belumSkripsi', 'tahun', 'dosenwalis', 'namaDosenWali'));
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
        $pdf = PDF::loadView('department.listBelumSkripsi_pdf', compact('belumSkripsi', 'tahun', 'dosenwalis', 'namaDosenWali'));

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

        return view('department.listSudahSkripsi', compact('skripsis', 'tahun', 'dosenwalis', 'namaDosenWali'));
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

        $pdf = PDF::loadView('department.listSudahSkripsi_pdf', compact('skripsis', 'tahun', 'dosenwalis', 'namaDosenWali'))->setOptions(['defaultFont' => 'sans-serif']);

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
        return view('department.rekapStatus', compact('jumlahMahasiswaAktif', 'jumlahMahasiswaNonAktif', 'tahunRange', 'minYear', 'maxYear'));
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

        $pdf = PDF::loadView('department.rekapStatus_pdf', compact('jumlahMahasiswaAktif', 'jumlahMahasiswaNonAktif', 'tahunRange'))->setOptions(['defaultFont' => 'sans-serif']);

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

        return view('department.listStatusAktif', compact('mahasiswaAktif', 'tahun', 'dosenwalis', 'namaDosenWali'));
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

        $pdf = PDF::loadView('department.listStatusAktif_pdf', compact('mahasiswaAktif', 'tahun', 'dosenwalis', 'namaDosenWali'))->setOptions(['defaultFont' => 'sans-serif']);

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

        return view('department.listStatusNonaktif', compact('status', 'tahun', 'dosenwalis', 'namaDosenWali'));
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

        $pdf = PDF::loadView('department.listStatusNonaktif_pdf', compact('status', 'tahun', 'dosenwalis', 'namaDosenWali'))->setOptions(['defaultFont' => 'sans-serif']);

        return $pdf->stream('listStatusNonAktif.pdf');
    }

}

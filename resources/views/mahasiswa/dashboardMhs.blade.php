<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Siap Undip</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous">
    </script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

</head>

<body style="background-color:#bfdeeb">

    <!-- header-->

    <nav class=" navbar navbar-expand-lg navbar-light text-light"
        style="background-color:#083c7859; box-shadow: 2px 0px rgb(69, 67, 67);">
        <!-- <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"> -->
        <svg xmlns="http://www.w3.org/2000/svg" href="#" id="navbarDropdown" role="button"
            data-bs-toggle="dropdown" aria-expanded="false" width="40" height="40" fill="currentColor"
            class="bi bi-list ml-3" viewBox="0 0 16 16">
            <path fill-rule="evenodd"
                d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
        </svg>
        </a>
        <ul class="dropdown-menu text-light" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="{{ route('logout') }}">Logout</a></li>

        </ul>

        <div class="container">
            <img src="{{ asset('images/logo.png') }}" alt="logo" width="40" height="40">
            <div class="container justify-content-left text-left text-light">
                <h4>Sistem Monitoring Mahasiswa</h4>
                <h4>UNDIP</h4>
            </div>
        </div>
        <div class="me-4 align-items-center flex justify-center text-light" style="text-align:center">
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 256 256">
                <path fill="currentColor"
                    d="m226.53 56.41l-96-32a8 8 0 0 0-5.06 0l-96 32A8 8 0 0 0 24 64v80a8 8 0 0 0 16 0V75.1l33.59 11.19a64 64 0 0 0 20.65 88.05c-18 7.06-33.56 19.83-44.94 37.29a8 8 0 1 0 13.4 8.74C77.77 197.25 101.57 184 128 184s50.23 13.25 65.3 36.37a8 8 0 0 0 13.4-8.74c-11.38-17.46-27-30.23-44.94-37.29a64 64 0 0 0 20.65-88l44.12-14.7a8 8 0 0 0 0-15.18ZM176 120a48 48 0 1 1-86.65-28.45l36.12 12a8 8 0 0 0 5.06 0l36.12-12A47.89 47.89 0 0 1 176 120Zm-48-32.43L57.3 64L128 40.43L198.7 64Z" />
            </svg>
            <!-- <li class="nav-item"><a href="profil-mahasiswa.php" class="nav-pills-link justify-content-center text-light"><h5>Mahasiswa</h5></a></li> -->
            <h5>{{ auth()->user()->mahasiswa->nama }}</h5>
        </div>
    </nav>
    <!--form-->
    <div class="me-5 ms-5">
        <br>
        {{-- <ul class="nav nav-pills justify-content-center text-dark"> --}}
        <ul class="nav nav-pills justify-content-center text-dark">
            <li class="nav-item"><a href="#" class="nav-link active" aria-current="page"
                    style="background-color:#101E31"><b>Home</b></a></li>
            <li class="nav-item"><a href="/dashboardmahasiswa/profile/edit" class="nav-link text-dark"><b>Edit
                        Profil</b></a></li>
            <li class="nav-item"><a href="/dashboardmahasiswa/IsiIRSMahasiswa" class="nav-link text-dark"><b>Data
                        IRS</b></a></li>
            <li class="nav-item"><a href="/dashboardmahasiswa/IsiKHSMahasiswa" class="nav-link text-dark"><b>Data
                        KHS</b></a></li>
            <li class="nav-item"><a href="/dashboardmahasiswa/IsiPKLMahasiswa" class="nav-link text-dark"><b>Data
                        PKL</b></a></li>
            <li class="nav-item"><a href="/dashboardmahasiswa/IsiSkripsiMahasiswa" class="nav-link text-dark"><b>Data
                        Skripsi</b></a></li>
        </ul>

        <br>
        <div class="container bg-white rounded-2xl max-w-screen-lg" style="width: 600px">
            <div class="row">
                <div class="col-7" style="margin-top: 60px;">
                    <div class="row">
                        <div class="col-6">
                            <img src="{{ asset('storage/photo/' . auth()->user()->mahasiswa->foto_mahasiswa) }}"
                                class="rounded-circle img-thumbnail ml-8 mt-3"
                                style="position: absolute; margin: auto auto; left: 0; right: 300px; height: 200px; width: 200px;">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-9 ml-5" style="margin-top: 235px;">
                            <div class="ms-3" style="font-weight: bolder; font-size: 20px;">{{ auth()->user()->mahasiswa->nama }}
                            </div>
                            <div class="ms-3" style="font-size: 18px;">{{ auth()->user()->mahasiswa->nim }}</div>
                            <div class="ms-3" style="font-size: 18px;">{{ auth()->user()->mahasiswa->email }}</div>
                            <div class="ms-3" style="font-size: 18px;">{{ auth()->user()->mahasiswa->angkatan }}</div>
                            <br>
                            <br><br>
                        </div>
                    </div>
                </div>
                <div class="col-5 mt-3 text-white">
                    <div class="row">
                        <div class="col-6">
                            <div class="card mb-1 text-xs md:text-base w-96 h-24" style="background-color:#00b8ff;">
                                <div class="card-body text-light">
                                    <div class="row">
                                        <div class="col-6">
                                            <h5 class="card-title text-light"><b>IRS</b></h5>
                                        </div>
                                        <div class="col-6">
                                            <h5 class="card-title text-light text-center ms-5"></h5>
                                        </div>
                                    </div>
                                    @if ($irs)
                                        <div class="card-text">
                                            @if ($irs->isverified == 1)
                                                <p>SKS : {{ $irs->jmlsks }}</p>
                                                <p>Semester : {{ $irs->semester }}</p>
                                            @else
                                                <p>Belum Disetujui</p>
                                            @endif
                                        </div>
                                    @else
                                        <div class="card-text">
                                            <p>Tidak ada data IRS terbaru</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="card mb-1 text-xs md:text-base w-96 h-38" style="background-color:#009bd6;">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <h5 class="card-title text-light"><b>KHS</b></h5>
                                        </div>
                                        <div class="col-6">
                                            <h5 class="card-title text-light text-center ms-5"></h5>
                                        </div>
                                    </div>
                                    @if ($k_h_s)
                                        <div class="card-text">
                                            @if ($k_h_s->isverified == 1)
                                                <p>Semester : {{ $k_h_s->semester }}</p>
                                                <p>SKS Semester : {{ $k_h_s->skssemester }}</p>
                                                <p>IP Semester : {{ $k_h_s->ipsemester }}</p>
                                                <p>SKS Kumulatif : {{ $k_h_s->skskumulatif }}</p>
                                                <p>IP Kumulatif : {{ $k_h_s->ipkumulatif }}</p>
                                            @else
                                                <p>Belum Disetujui</p>
                                            @endif
                                        </div>
                                    @else
                                        <div class="card-text">
                                            <p>Tidak ada data KHS terbaru</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="card mb-1 md:text-base w-96 h-29" style="background-color:#00719c;">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <h5 class="card-title text-light"><b>PKL</b></h5>
                                        </div>
                                        <div class="col-6">
                                            <h5 class="card-title text-light text-center ms-5"></h5>
                                        </div>
                                    </div>
                                    <div class="card-text">
                                        @foreach ($p_k_l_s as $item)
                                            @if ($item->isverified == 1)
                                                <p>Semester : {{ $item->semester }}</p>
                                                <p>Instansi : {{ $item->instansi }}</p>
                                                <p>Dosen Pengampu : {{ $item->dosenpengampu }}</p>
                                            @else
                                                <p>Belum Disetujui</p>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="card mb-2 md:text-base w-96 h-40" style="background-color:#00415a;">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <h5 class="card-title text-light"><b>SKRIPSI</b></h5>
                                        </div>
                                        <div class="col-6">
                                            <h5 class="card-title text-light text-center ms-5"></h5>
                                        </div>
                                    </div>
                                    <div class="card-text">
                                        @foreach ($skripsis as $item)
                                            @if ($item->isverified == 1)
                                                <p>Tanggal Sidang : {{ $item->tglsidang }}</p>
                                                <p>Dosen Pembimbing : {{ $item->dosenpembimbing }}</p>
                                            @else
                                                <p>Belum Disetujui</p>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
</body>

</html>

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
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 32 32">
                <path fill="currentColor"
                    d="M4 6v2h22v16H12v2h18v-2h-2V6H4zm4.002 3A4.016 4.016 0 0 0 4 13c0 2.199 1.804 4 4.002 4A4.014 4.014 0 0 0 12 13c0-2.197-1.802-4-3.998-4zM14 10v2h5v-2h-5zm7 0v2h3v-2h-3zM8.002 11C9.116 11 10 11.883 10 13c0 1.12-.883 2-1.998 2C6.882 15 6 14.12 6 13c0-1.117.883-2 2.002-2zM14 14v2h10v-2H14zM4 18v8h2v-6h3v6h2v-5.342l2.064 1.092c.585.31 1.288.309 1.872 0v.002l3.53-1.867l-.933-1.77l-3.531 1.867l-3.096-1.634A3.005 3.005 0 0 0 9.504 18H4z" />
            </svg>
            <h5>{{ auth()->user()->dosenWali->nama }}</h5>
        </div>
    </nav>
    <!--form-->
    <div class="me-5 ms-5">

        <br>
        <div class="container bg-white rounded-2xl max-w-screen-xl" style="width: 600px">
            <div class="row">
                <div class="container bg-white rounded-2xl max-w-screen-xl" style="width: 600px; position: relative;">
                    <a href="/dashboarddosen/daftarmahasiswa"
                        class="btn btn-secondary btn-sm rounded-lg mb-3 mt-2 ml-2 position-absolute top-0 start-0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-arrow-left" viewBox="0 0 16 16">
                            <path
                                d="M11 8a.5.5 0 0 1 .5.5V14a.5.5 0 0 1-1 0V9.707L6.354 14.354a.5.5 0 1 1-.708-.708L9.293 8.5l-3.647-3.646a.5.5 0 1 1 .708-.708L9 7.293V2.5a.5.5 0 0 1 1 0V8z" />
                        </svg>
                        Back
                    </a>
                    <div class="col-7" style="margin-top: 32px;">

                        <div class="row">
                            <div class="col-6">
                                <img src="{{ asset('storage/photo/' . $mahasiswa->foto_mahasiswa) }}"
                                    class="rounded-circle img-thumbnail ml-8 mt-3"
                                    style="position: absolute; margin: auto auto; left: 0; right: 300px; height: 120px; width: 120px;">

                            </div>
                            <div class="col-6 ml-52 mt-4">
                                <table style="font-size: 16px;">
                                    <tr>
                                        <td>{{ $mahasiswa->nama }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ $mahasiswa->nim }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ $mahasiswa->angkatan }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ $mahasiswa->email }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div style="margin-top: 32x;">
                        <div class="row">
                            <div class="text-center mt-4">
                                <div class="font-semibold text-lg">Semester</div>
                                <br>
                            </div>
                            <div class="text-center mt-2">
                                <div class="grid grid-cols-7 gap-2">
                                    @for ($semester = 1; $semester <= 14; $semester++)
                                        @php
                                            $status = $semesterStatus[$semester];
                                            $buttonClass = '';

                                            // Menentukan kelas tambahan berdasarkan status
                                            if ($status === 'blue') {
                                                $buttonClass = 'btn-primary'; // Warna biru
                                            } elseif ($status === 'yellow') {
                                                $buttonClass = 'btn-warning'; // Warna kuning
                                            } elseif ($status === 'green') {
                                                $buttonClass = 'btn-success'; // Warna hijau
                                            } else {
                                                $buttonClass = 'btn-danger'; // Warna merah
                                            }
                                        @endphp

                                        <div class="mr-1">
                                            <button
                                                class="btn rounded-sm border-l border-t border-r rounded-t py-2 px-4 text-white font-semibold shadow-md inline-block semester-button {{ $buttonClass }}"
                                                data-bs-toggle="modal"
                                                data-bs-target="#semesterModal_{{ $semester }}">{{ $semester }}</button>
                                        </div>
                                    @endfor
                                </div>
                            </div>
                            <br>
                            @for ($semester = 1; $semester <= 14; $semester++)
                                <!-- Modal for semester {{ $semester }} -->
                                <div class="modal fade" id="semesterModal_{{ $semester }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel_{{ $semester }}" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <!-- Modal content here -->
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel_{{ $semester }}">
                                                    Detail Semester {{ $semester }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- IRS content for semester {{ $semester }} -->
                                                @php
                                                    $irsData = $mahasiswa->irs ? $mahasiswa->irs->where('semester', $semester)->first() : null;
                                                    $khsData = $mahasiswa->khs ? $mahasiswa->khs->where('semester', $semester)->first() : null;
                                                    $pklData = $mahasiswa->pkl ? $mahasiswa->pkl->where('semester', $semester)->first() : null;
                                                    $skripsiData = $mahasiswa->skripsi ? $mahasiswa->skripsi->where('semester', $semester)->first() : null;
                                                @endphp

                                                @if ($irsData && $khsData && $pklData)
                                                    <p>IRS Semester {{ $semester }}: {{ $irsData->jmlsks }} SKS
                                                    </p>
                                                    <p>KHS Semester {{ $semester }}: {{ $khsData->skssemester }}
                                                        SKS, IP Semester: {{ $khsData->ipsemester }}</p>
                                                    <p>PKL Semester {{ $semester }}: <!-- display PKL data --></p>
                                                @elseif ($skripsiData)
                                                    <p>Skripsi Semester {{ $semester }}:
                                                        <!-- display Skripsi data --></p>
                                                @else
                                                    <p>Data tidak tersedia untuk semester ini.</p>
                                                @endif
                                            </div>
                                            <!-- Modal footer -->
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger"
                                                    data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endfor
                        </div>
                    </div>
                    <div style="margin-top: 32px; margin-bottom: 32px;">
                        <div class="row">
                            <div class="text-left mt-4">
                                <div class="font-medium text-base">
                                    Keterangan :</div>
                                <div class="font-medium text-base flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-2" fill="none"
                                        stroke="red" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" viewBox="0 0 24 24">
                                        <rect width="18" height="18" x="3" y="3" fill="red"
                                            rx="4" />
                                    </svg>
                                    <span class="align-middle">Belum Diisikan (IRS dan KHS) atau tidak digunakan</span>
                                </div>
                                <div class="font-medium text-base flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-2" fill="none"
                                        stroke="blue" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" viewBox="0 0 24 24">
                                        <rect width="18" height="18" x="3" y="3" fill="blue"
                                            rx="4" />
                                    </svg>
                                    <span class="align-middle">Sudah Diisikan (IRS dan KHS)</span>
                                </div>
                                <div class="font-medium text-base flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-2" fill="none"
                                        stroke="yellow" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" viewBox="0 0 24 24">
                                        <rect width="18" height="18" x="3" y="3" fill="yellow"
                                            rx="4" />
                                    </svg>
                                    <span class="align-middle">Sudah Lulus PKL (IRS, KHS, dan PKL)</span>
                                </div>
                                <div class="font-medium text-base flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-2" fill="none"
                                        stroke="green" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" viewBox="0 0 24 24">
                                        <rect width="18" height="18" x="3" y="3" fill="green"
                                            rx="4" />
                                    </svg>
                                    <span class="align-middle">Sudah Lulus Skripsi</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function() {
                $('.semester-button').click(function() {
                    var semesterNumber = $(this).text();

                    // Di sini Anda perlu mengakses data IRS, KHS, PKL, dan Skripsi yang sesuai dengan semester yang dipilih
                    // Misalkan, Anda memiliki data IRS, KHS, PKL, dan Skripsi dalam variabel $irsData, $khsData, $pklData, dan $skripsiData untuk semester yang dipilih

                    var $irsData = ""; // Isi dengan data IRS untuk semester yang dipilih
                    var $khsData = ""; // Isi dengan data KHS untuk semester yang dipilih
                    var $pklData = ""; // Isi dengan data PKL untuk semester yang dipilih
                    var $skripsiData = ""; // Isi dengan data Skripsi untuk semester yang dipilih

                    // Update konten modal sesuai dengan data yang sesuai
                    if ($irsData && $khsData && $pklData) {
                        $('#exampleModalLabel').text('Informasi Semester ' + semesterNumber);
                        $('#irsTab').html('<p>' + $irsData + '</p>');
                        $('#khsTab').html('<p>' + $khsData + '</p>');
                        $('#pklTab').html('<p>' + $pklData + '</p>');
                        $('#skripsiTab').html('<p>' + $skripsiData + '</p>');
                        $('#khsTabLink').show();
                        $('#pklTabLink').show();
                        $('#skripsiTabLink').show();
                        $('#semesterModal').modal('show');
                    } else if ($skripsiData) {
                        $('#exampleModalLabel').text('Informasi Semester ' + semesterNumber);
                        $('#skripsiTab').html('<p>' + $skripsiData + '</p>');
                        $('#khsTabLink').hide();
                        $('#pklTabLink').hide();
                        $('#semesterModal').modal('show');
                    } else {
                        $('#exampleModalLabel').text('Informasi Semester ' + semesterNumber);
                        $('#irsTab').html('<p>Tidak ada progress akademik</p>');
                        $('#khsTab').html('');
                        $('#pklTab').html('');
                        $('#skripsiTab').html('');
                        $('#khsTabLink').hide();
                        $('#pklTabLink').hide();
                        $('#skripsiTabLink').hide();
                        $('#semesterModal').modal('show');
                    }
                });

                $('#semesterTabs a').on('shown.bs.tab', function(e) {
                    // Konten untuk tab IRS, KHS, PKL, dan Skripsi saat tab ditampilkan
                    if (e.target.id === 'irsTabLink') {
                        // Konten untuk tab IRS
                    } else if (e.target.id === 'khsTabLink') {
                        // Konten untuk tab KHS
                    } else if (e.target.id === 'pklTabLink') {
                        // Konten untuk tab PKL
                    } else if (e.target.id === 'skripsiTabLink') {
                        // Konten untuk tab Skripsi
                    }
                });
            });
        </script>
</body>

</html>

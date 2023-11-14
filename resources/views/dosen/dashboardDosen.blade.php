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
            <!-- <li class="nav-item"><a href="profil-mahasiswa.php" class="nav-pills-link justify-content-center text-light"><h5>Mahasiswa</h5></a></li> -->
            <h5>{{ auth()->user()->name }}</h5>
        </div>
    </nav>
    <!--form-->
    <div class="me-5 ms-5">
        <br>
        <ul class="nav nav-pills justify-content-center text-dark">
            <li class="nav-item"><a href="#" class="nav-link active" aria-current="page"
                    style="background-color:#101E31"><b>Home</b></a></li>
            <li class="nav-item"><a href="/dashboarddosen/irs" class="nav-link text-dark"><b> Data IRS Mahasiswa</b></a></li>
            <li class="nav-item"><a href="/dashboarddosen/khs" class="nav-link text-dark"><b> Data KHS Mahasiswa</b></a></li>
            <li class="nav-item"><a href="/dashboarddosen/pkl" class="nav-link text-dark"><b>Data Mahasiswa PKL</b></a>
            </li>
            <li class="nav-item"><a href="/dashboarddosen/skripsi" class="nav-link text-dark"><b>Data Mahasiswa
                        Skripsi</b></a></li>
        </ul>

        <br><br>
        <div class="container bg-white rounded-2xl max-w-screen-xl">
            <div class="row">
                <div class="col-6" style="margin-top: 50px;">
                    <div class="row">
                        <div class="col-3">
                            <img src="{{ asset('storage/photo/' . auth()->user()->photo) }}" width="140"
                                class="rounded-circle img-thumbnail ms-3 me-3">
                        </div>
                        <div class="col-9" style="margin-top: 15px;">
                            <div class="ms-3">{{ auth()->user()->name }}</div>
                            <div class="ms-3">{{ auth()->user()->nim }}</div>
                            <div class="ms-3">{{ auth()->user()->email }}</div>
                            <div class="ms-3">Fakultas Sains dan Matematika</div>
                            <br>
                            <br><br>
                        </div>
                        
                    </div>

                    <div class="row">
                        <div class="col-xl-5 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-h5">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Jumlah Mahasiswa Perwalian</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $jmlmhs }}
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-6">
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div class="col-md-6">
                            <div class="card" style="width: 250px; height: 250px;">
                                <div id="piechartirs" style="width: 100%; height: 100%;">
                                    <!-- Your IRS content here -->
                                </div>
                                <div class="mt-4 mb-4 ml-4">
                                    <a href=""
                                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">IRS
                                        Mahasiswa</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card" style="width: 250px; height: 250px;">
                                <div id="piechartkhs" style="width: 100%; height: 100%;">
                                    <!-- Your KHS content here -->
                                </div>
                                <div class="mt-4 mb-4 ml-4">
                                    <a href=""
                                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">KHS
                                        Mahasiswa</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-6">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="col-md-6">
                            <div class="card" style="width: 250px; height: 250px;">
                                <div id="piechartpkl" style="width: 100%; height: 100%;">
                                    <!-- Your IRS content here -->
                                </div>
                                <div class="mt-4 mb-4 ml-4">
                                    <a href=""
                                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">PKL
                                        Mahasiswa</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card" style="width: 250px; height: 250px;">
                                <div id="piechartskripsi" style="width: 100%; height: 100%;">
                                    <!-- Your KHS content here -->
                                </div>
                                <div class="mt-4 mb-4 ml-4">
                                    <a href=""
                                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Skripsi
                                        Mahasiswa</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
            google.charts.load('current', {
                'packages': ['corechart']
            });
            google.charts.setOnLoadCallback(drawChartirs);

            function drawChartirs() {

                var data = google.visualization.arrayToDataTable([
                    ['Task', 'Hours per Day'],
                    ['Belum Disetujui', {{ $irscountnotverified }}],
                    ['Sudah Disetujui', {{ $irscountverified }}],
                    ['Belum mengisi', {{ max(0, $irsbelum) }}],
                ]);

                var options = {
                    title: 'Data IRS Perwalian'
                };

                var chart = new google.visualization.PieChart(document.getElementById('piechartirs'));

                chart.draw(data, options);
            }
            google.charts.load('current', {
                'packages': ['corechart']
            });
            google.charts.setOnLoadCallback(drawChartkhs);

            function drawChartkhs() {

                var data = google.visualization.arrayToDataTable([
                    ['Task', 'Hours per Day'],
                    ['Belum Disetujui', {{ $khscountnotverified }}],
                    ['Sudah Disetujui', {{ $khscountverified }}],
                    ['Belum mengisi', {{ $khsbelum }}],
                ]);

                var options = {
                    title: 'Data KHS Perwalian'
                };

                var chart = new google.visualization.PieChart(document.getElementById('piechartkhs'));

                chart.draw(data, options);
            }

            google.charts.load('current', {
                'packages': ['corechart']
            });
            google.charts.setOnLoadCallback(drawChartpkl);

            function drawChartpkl() {

                var data = google.visualization.arrayToDataTable([
                    ['Task', 'Hours per Day'],
                    ['Belum Disetujui', {{ $pklcountnotverified }}],
                    ['Sudah Disetujui', {{ $pklcountverified }}],
                    ['Belum mengisi', {{ $pklbelum }}],
                ]);

                var options = {
                    title: 'Data PKL Perwalian'
                };

                var chart = new google.visualization.PieChart(document.getElementById('piechartpkl'));

                chart.draw(data, options);
            }

            google.charts.load('current', {
                'packages': ['corechart']
            });
            google.charts.setOnLoadCallback(drawChartskripsi);

            function drawChartskripsi() {

                var data = google.visualization.arrayToDataTable([
                    ['Task', 'Hours per Day'],
                    ['Belum Disetujui', {{ $skripsicountnotverified }}],
                    ['Sudah Disetujui', {{ $skripsicountverified }}],
                    ['Belum mengisi', {{ $skripsibelum }}],
                ]);

                var options = {
                    title: 'Data Skripsi Perwalian'
                };

                var chart = new google.visualization.PieChart(document.getElementById('piechartskripsi'));

                chart.draw(data, options);
            }
        </script>

    </div>

</body>

</html>

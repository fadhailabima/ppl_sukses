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
            <h5>{{ auth()->user()->dosenWali->nama }}</h5>
        </div>
    </nav>
    <!--form-->
    <div class="me-5 ms-5">

        <br>
        <div class="container bg-white rounded-2xl max-w-screen-xl" style="width: 600px">
            <div class="row">
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
                        <div class="text-center">
                            <ul class="grid grid-cols-7 gap-2 place-content-center">
                                <li class=" mr-1">
                                    <a class="rounded-sm bg-blue-700 inline-block border-l border-t border-r rounded-t py-2 px-4 text-white font-semibold shadow-md"
                                        href="#">1</a>
                                </li>
                                <li class="mr-1">
                                    <a class="rounded-sm bg-blue-700 inline-block border-l border-t border-r rounded-t py-2 px-4 text-white font-semibold shadow-md"
                                        href="#">2</a>
                                </li>
                                <li class="mr-1">
                                    <a class="rounded-sm bg-blue-700 inline-block border-l border-t border-r rounded-t py-2 px-4 text-white font-semibold shadow-md"
                                        href="#">3</a>
                                </li>
                                <li class="mr-1">
                                    <a class="rounded-sm bg-blue-700 inline-block border-l border-t border-r rounded-t py-2 px-4 text-white font-semibold shadow-md"
                                        href="#">4</a>
                                </li>
                                <li class="mr-1">
                                    <a class="rounded-sm bg-blue-700 inline-block border-l border-t border-r rounded-t py-2 px-4 text-white font-semibold shadow-md"
                                        href="#">5</a>
                                </li>
                                <li class="mr-1">
                                    <a class="rounded-sm bg-yellow-300 inline-block border-l border-t border-r rounded-t py-2 px-4 text-white font-semibold shadow-md"
                                        href="#">6</a>
                                </li>
                                <li class="mr-1">
                                    <a class="rounded-sm bg-blue-700 inline-block border-l border-t border-r rounded-t py-2 px-4 text-white font-semibold shadow-md"
                                        href="#">7</a>
                                </li>
                            </ul>
                        </div>
                        <br>
                        <div class="text-center mt-2">
                            <ul class="grid grid-cols-7 gap-2 place-content-center">
                                <li class="mr-1">
                                    <a class="rounded-sm bg-green-800 inline-block border-l border-t border-r rounded-t py-2 px-4 text-white font-semibold shadow-md"
                                        href="#">8</a>
                                </li>
                                <li class="mr-1">
                                    <a class="rounded-sm bg-red-600 inline-block border-l border-t border-r rounded-t py-2 px-4 text-white font-semibold shadow-md"
                                        href="#">9</a>
                                </li>
                                <li class=" mr-1">
                                    <a class="rounded-sm bg-red-600 inline-block border-l border-t border-r rounded-t py-2 px-4 text-white font-semibold shadow-md"
                                        href="#">10</a>
                                </li>
                                <li class="mr-1">
                                    <a class="rounded-sm bg-red-600 inline-block border-l border-t border-r rounded-t py-2 px-4 text-white font-semibold shadow-md"
                                        href="#">11</a>
                                </li>
                                <li class="mr-1">
                                    <a class="rounded-sm bg-red-600 inline-block border-l border-t border-r rounded-t py-2 px-4 text-white font-semibold shadow-md"
                                        href="#">12</a>
                                </li>
                                <li class="mr-1">
                                    <a class="rounded-sm bg-red-600 inline-block border-l border-t border-r rounded-t py-2 px-4 text-white font-semibold shadow-md"
                                        href="#">13</a>
                                </li>
                                <li class="mr-1">
                                    <a class="rounded-sm bg-red-600 inline-block border-l border-t border-r rounded-t py-2 px-4 text-white font-semibold shadow-md"
                                        href="#">14</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div style="margin-top: 32px; margin-bottom: 32px;">
                    <div class="row">
                        <div class="text-left mt-4">
                            <div class="font-medium text-base">
                                Keterangan :</div>
                            <div class="font-medium text-base flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-2" fill="none"
                                    stroke="red" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <rect width="18" height="18" x="3" y="3" fill="red" rx="4" />
                                </svg>
                                <span class="align-middle">Belum Diisikan (IRS dan KHS) atau tidak digunakan</span>
                            </div>
                            <div class="font-medium text-base flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-2" fill="none"
                                    stroke="blue" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <rect width="18" height="18" x="3" y="3" fill="blue" rx="4" />
                                </svg>
                                <span class="align-middle">Sudah Diisikan (IRS dan KHS)</span>
                            </div>
                            <div class="font-medium text-base flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-2" fill="none"
                                    stroke="yellow" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <rect width="18" height="18" x="3" y="3" fill="yellow" rx="4" />
                                </svg>
                                <span class="align-middle">Sudah Lulus PKL (IRS, KHS, dan PKL)</span>
                            </div>
                            <div class="font-medium text-base flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-2" fill="none"
                                    stroke="green" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <rect width="18" height="18" x="3" y="3" fill="green" rx="4" />
                                </svg>
                                <span class="align-middle">Sudah Lulus Skripsi</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

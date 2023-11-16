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
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <style>
        .box-container {
            font-size: 12px;
            width: 200px;
            height: 180px;
            padding: 5px 25px;
            /* background: ; */
            color: #222;
            border-radius: 50px;
            border-style: groove;
        }
    </style>
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
            <h5>{{ auth()->user()->name }}</h5>
        </div>
    </nav>

    <!--form-->
    <div class="me-5 ms-5">
        <br>
        <ul class="nav nav-pills justify-content-center text-dark">
            <li class="nav-item"><a href="/dashboardmahasiswa" class="nav-link text-dark"><b>Home</b></a></li>
            <li class="nav-item"><a href="/dashboardmahasiswa/profile/edit" class="nav-link text-dark"><b>Edit
                        Profil</b></a></li>
            <li class="nav-item"><a href="/dashboardmahasiswa/IsiIRSMahasiswa" class="nav-link text-dark"><b>Data
                        IRS</b></a></li>
            <li class="nav-item"><a href="/dashboardmahasiswa/IsiKHSMahasiswa" class="nav-link text-dark"><b>Data
                        KHS</b></a></li>
            <li class="nav-item"><a href="#" class="nav-link active" aria-current="page"
                    style="background-color:#101E31"><b>Data PKL</b></a></li>
            <li class="nav-item"><a href="/dashboardmahasiswa/IsiSkripsiMahasiswa" class="nav-link text-dark"><b>Data
                        Skripsi</b></a></li>
        </ul>
        <div class="container mt-4 flex justify-center items-center">
            <h2 class="text-4xl text-center">Isi Data PKL</h2>
        </div>

        <br>
        <div class="container bg-white rounded-2xl max-w-screen-sm">
            <div class="row">
                <div class="col-2 mt-4 text-right">

                </div>
                <div class="col-sm mt-5">
                    @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session()->has('gagal'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('gagal') }}
                        </div>
                    @endif
                    <form class="user" method="POST" action="/dashboardmahasiswa/IsiPKLMahasiswa"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3 row mt-1">
                            <label for="semester" class="col-sm-4 col-form-label">Semester Aktif :<sup
                                    class="text-danger">*</sup></label>
                            <div class="col-sm-6">
                                <select
                                    class="form-control mb-2 @error('semester')
                                is-invalid    
                                @enderror mb-2"
                                    name="semester" id="semester" required>
                                    <option selected disabled>Semester</option>
                                    <option value="1">Semester 1</option>
                                    <option value="2">Semester 2</option>
                                    <option value="3">Semester 3</option>
                                    <option value="4">Semester 4</option>
                                    <option value="5">Semester 5</option>
                                    <option value="6">Semester 6</option>
                                    <option value="7">Semester 7</option>
                                    <option value="8">Semester 8</option>
                                    <option value="9">Semester 9</option>
                                    <option value="10">Semester 10</option>
                                    <option value="11">Semester 11</option>
                                    <option value="12">Semester 12</option>
                                    <option value="13">Semester 13</option>
                                    <option value="14">Semester 14</option>
                                    <option value="15">Semester 15</option>
                                </select>
                                @error('semester')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3 row">
                                <label for="instansi" class="col-sm-4 col-form-label">Instansi :<sup
                                        class="text-danger">*</sup></label>
                                <div class="col-sm-6 ml-2">
                                    <input type="text"
                                        class="form-control  @error('instansi')
                                    is-invalid    
                                    @enderror"
                                        id="instansi" name="instansi" placeholder="Instansi" required
                                        value="{{ old('instansi') }}">
                                    @error('instansi')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="dosenpengampu" class="col-sm-4 col-form-label">Dosen Pengampu :<sup
                                        class="text-danger">*</sup></label>
                                <div class="col-sm-6 ml-2">
                                    <select
                                        class="form-control @error('dosenpengampu')
                is-invalid    
                @enderror mb-3"
                                        name="dosenpengampu" id="dosenpengampu" required>
                                        <option selected disabled>Dosen Pengampu</option>
                                        <option value="Aris Puji Widodo">Aris Puji Widodo</option>
                                        <option value="Beta Noranita">Beta Noranita</option>
                                        <option value="Nurdin Bahtiar">Nurdin Bahtiar</option>
                                        <option value="Sandy Kurniawan">Sandy Kurniawan</option>
                                        <option value="Adhe Setya">Adhe Setya</option>
                                        <option value="Edy Suharto">Edy Suharto</option>
                                        <option value="Dinar Mutiara">Dinar Mutiara</option>
                                    </select>
                                    @error('dosenpengampu')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div>
                                <h2>Scan KRS</h2>
                                <div class="col-sm d-flex justify-content-center">
                                    <div class="box-container">
                                        <div class="text-center d-flex justify-content-center " style="height: 70px;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="70" height="70"
                                                fill="currentColor" class="bi bi-upload" viewBox="0 0 16 16">
                                                <path
                                                    d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z" />
                                                <path
                                                    d="M7.646 1.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 2.707V11.5a.5.5 0 0 1-1 0V2.707L5.354 4.854a.5.5 0 1 1-.708-.708l3-3z" />
                                            </svg>
                                        </div>
                                        <br>
                                        <input type="file"
                                            class="form-control  @error('scanpkl')
                                    is-invalid    
                                    @enderror"
                                            id="scanpkl" name="scanpkl" placeholder="Scan PKL" required>
                                        @error('scanpkl')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <br>
                                        <button type="submit" class="btn btn-dark ps-3 pe-3 pb-1 pt-1"
                                            name="submit" style="background-color:#101E31">
                                            --Submit--
                                        </button>
                                    </div>

                                </div>
                            </div>
                    </form>

                </div>

                <br><br>
            </div>


        </div>
        {{-- <script>
            function previewImage() {
                const image = document.querySelector('#scansks');
                const imgPreview = document.querySelector('.img-preview');

                imgPreview.style.display = 'block';

                const file = fileInput.files[0];
                const objectURL = URL.createObjectURL(file);

                pdfPreview.setAttribute('data', objectURL);
            }
        </script> --}}



</body>

</html>

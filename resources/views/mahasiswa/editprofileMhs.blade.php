<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Siap Undip</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <script src="js/jquery.min.js"></script>
</head>

<body style="background-color:#bfdeeb">

    <!-- header-->  
    
            <nav class=" navbar navbar-expand-lg navbar-light text-light" style="background-color:#083c7859; box-shadow: 2px 0px rgb(69, 67, 67);">
    <!-- <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"> -->
        <svg xmlns="http://www.w3.org/2000/svg" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" width="40" height="40" fill="currentColor" class="bi bi-list ml-3" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
        </svg>
    </a>
    <ul class="dropdown-menu text-light" aria-labelledby="navbarDropdown">
        <li><a class="dropdown-item" href="">Logout</a></li>

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
            <path fill="currentColor" d="m226.53 56.41l-96-32a8 8 0 0 0-5.06 0l-96 32A8 8 0 0 0 24 64v80a8 8 0 0 0 16 0V75.1l33.59 11.19a64 64 0 0 0 20.65 88.05c-18 7.06-33.56 19.83-44.94 37.29a8 8 0 1 0 13.4 8.74C77.77 197.25 101.57 184 128 184s50.23 13.25 65.3 36.37a8 8 0 0 0 13.4-8.74c-11.38-17.46-27-30.23-44.94-37.29a64 64 0 0 0 20.65-88l44.12-14.7a8 8 0 0 0 0-15.18ZM176 120a48 48 0 1 1-86.65-28.45l36.12 12a8 8 0 0 0 5.06 0l36.12-12A47.89 47.89 0 0 1 176 120Zm-48-32.43L57.3 64L128 40.43L198.7 64Z"/>
        </svg>
        <!-- <li class="nav-item"><a href="profil-mahasiswa.php" class="nav-pills-link justify-content-center text-light"><h5>Mahasiswa</h5></a></li> -->
        <h5>Mahasiswa</h5>
    </div>
    </nav>

    <!--form-->
    <div class="me-5 ms-5">
        <br>
        <ul class="nav nav-pills justify-content-center text-dark">
            <li class="nav-item"><a href="/dashboardmahasiswa" class="nav-link text-dark"><b>Home</b></a></li>
            <li class="nav-item"><a href="/dashboardmahasiswa/profile/edit" class="nav-link active" aria-current="page" style="background-color:#101E31"><b>Edit Profil</b></a></li>
            <li class="nav-item"><a href="entry_irs.php" class="nav-link text-dark"><b>Data IRS</b></a></li>
            <li class="nav-item"><a href="entry_khs.php" class="nav-link text-dark"><b>Data KHS</b></a></li>
            <li class="nav-item"><a href="entry_pkl.php" class="nav-link text-dark"><b>Data PKL</b></a></li>
            <li class="nav-item"><a href="entry_skripsi.php" class="nav-link text-dark"><b>Data Skripsi</b></a></li>
        </ul>
        <div class="card shadow mb-4">
            <div class="card-header py-3 bg-secondary">
                <h6 class="m-0 font-weight-bold text-white">Isi Data Diri Mahasiswa</h6>
            </div>
            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            <div class="card-body">
                <form class="user" method="POST" action="/dashboardmahasiswa/profile/edit">
                    @method('put')
                    @csrf
                    <label for="name">Nama</label>
                    <div class="form-group">
                        <input type="text"
                            class="form-control 
                             @error('name')
                        is-invalid    
                        @enderror"
                            id="name" name="name" placeholder="Masukkan nama anda"
                            value="{{ old('name', auth()->user()->name) }}">
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <label for="nim">NIM</label>
                    <div class="form-group">
                        <input type="text"
                            class="form-control 
                        @error('nim')
                        is-invalid    
                        @enderror"
                            id="nim" name="nim" placeholder="Masukkan NIM anda" required
                            value="{{ old('nim', auth()->user()->nim) }}" disabled>
                        @error('nim')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <label for="jurusan">Jurusan</label>
                    <div class="form-group">
                        <input type="text"
                            class="form-control 
                        @error('jurusan')
                        is-invalid    
                        @enderror"
                            id="jurusan" name="jurusan" placeholder="Masukkan jurusan anda" required
                            value="{{ old('jurusan', auth()->user()->jurusan) }}">
                        @error('jurusan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <label for="angkatan">Angkatan</label>
                    <div class="form-group">
                        <input type="text"
                            class="form-control 
                             @error('angkatan')
                        is-invalid    
                        @enderror"
                            id="angkatan" name="angkatan" placeholder="Masukkan Angkatan anda" required
                            value="{{ old('angkatan', auth()->user()->angkatan) }}" disabled>
                        @error('angkatan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <label for="alamat">Alamat</label>
                    <div class="form-group">
                        <input type="text"
                            class="form-control 
                             @error('alamat')
                        is-invalid    
                        @enderror"
                            id="alamat" name="alamat" placeholder="Masukkan alamat anda" required
                            value="{{ old('alamat', auth()->user()->alamat) }}">
                        @error('alamat')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <label for="nomortlp">Nomor Telepon</label>
                    <div class="form-group">
                        <input type="text"
                            class="form-control 
                             @error('nomortlp')
                        is-invalid    
                        @enderror"
                            id="nomortlp" name="nomortlp" placeholder="Masukkan Nomor Telepon anda" required
                            value="{{ old('nomortlp', auth()->user()->nomortlp) }}">
                        @error('nomortlp')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
    
                    <button type="submit" class="btn btn-primary btn-user btn-block">
                        Submit
                    </button>
    
                </form>
            </div>
        </div>
    </div>



</body>


</html>
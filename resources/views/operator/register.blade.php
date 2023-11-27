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
</head>

<body style="background-color:#bfdeeb">
    <nav class=" navbar navbar-expand-lg navbar-light text-light"
        style="background-color:#083c7859; box-shadow: 2px 0px rgb(69, 67, 67);">
        <!-- <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"> -->
        <svg xmlns="http://www.w3.org/2000/svg" href="#" id="navbarDropdown" role="button"
            data-bs-toggle="dropdown" aria-expanded="false" width="40" height="40" fill="currentColor"
            class="bi bi-list ml-3" viewBox="0 0 16 16">
            <path fill-rule="evenodd"
                d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
        </svg>
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
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 36 36">
                <circle cx="14.67" cy="8.3" r="6" fill="currentColor"
                    class="clr-i-solid clr-i-solid-path-1" />
                <path fill="currentColor"
                    d="M16.44 31.82a2.15 2.15 0 0 1-.38-2.55l.53-1l-1.09-.33a2.14 2.14 0 0 1-1.5-2.1v-2.05a2.16 2.16 0 0 1 1.53-2.07l1.09-.33l-.52-1a2.17 2.17 0 0 1 .35-2.52a18.92 18.92 0 0 0-2.32-.16A15.58 15.58 0 0 0 2 23.07v7.75a1 1 0 0 0 1 1h13.44Z"
                    class="clr-i-solid clr-i-solid-path-2" />
                <path fill="currentColor"
                    d="m33.7 23.46l-2-.6a6.73 6.73 0 0 0-.58-1.42l1-1.86a.35.35 0 0 0-.07-.43l-1.45-1.46a.38.38 0 0 0-.43-.07l-1.85 1a7.74 7.74 0 0 0-1.43-.6l-.61-2a.38.38 0 0 0-.36-.25h-2.08a.38.38 0 0 0-.35.26l-.6 2a6.85 6.85 0 0 0-1.45.61l-1.81-1a.38.38 0 0 0-.44.06l-1.47 1.44a.37.37 0 0 0-.07.44l1 1.82a7.24 7.24 0 0 0-.65 1.43l-2 .61a.36.36 0 0 0-.26.35v2.05a.36.36 0 0 0 .26.35l2 .61a7.29 7.29 0 0 0 .6 1.41l-1 1.9a.37.37 0 0 0 .07.44L19.16 32a.38.38 0 0 0 .44.06l1.87-1a7.09 7.09 0 0 0 1.4.57l.6 2.05a.38.38 0 0 0 .36.26h2.05a.38.38 0 0 0 .35-.26l.6-2.05a6.68 6.68 0 0 0 1.38-.57l1.89 1a.38.38 0 0 0 .44-.06L32 30.55a.38.38 0 0 0 .06-.44l-1-1.88a6.92 6.92 0 0 0 .57-1.38l2-.61a.39.39 0 0 0 .27-.35v-2.07a.4.4 0 0 0-.2-.36Zm-8.83 4.72a3.34 3.34 0 1 1 3.33-3.34a3.34 3.34 0 0 1-3.33 3.34Z"
                    class="clr-i-solid clr-i-solid-path-3" />
                <path fill="none" d="M0 0h36v36H0z" />
            </svg>
            <!-- <li class="nav-item"><a href="profil-mahasiswa.php" class="nav-pills-link justify-content-center text-light"><h5>Mahasiswa</h5></a></li> -->
            <h5>{{ auth()->user()->operator->nama }}</h5>
        </div>
    </nav>
    <br>
    @if (session('success'))
        <div class="position-absolute top-0 start-50 translate-middle-x mt-3" style="z-index: 1050;">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif
    <ul class="nav nav-pills justify-content-center text-dark">
        <li class="nav-item"><a href="/dashboardadmin" class="nav-link text-dark"><b>Home</b></a></li>
        <li class="nav-item"><a href="#" class="nav-link active" aria-current="page"
                style="background-color:#101E31"><b>Register User</b></a></li>
        <li class="nav-item"><a href="/dashboardadmin/daftarmahasiswa" class="nav-link text-dark"><b>Daftar
                    Mahasiswa</b></a></li>
    </ul>
    <br>
    <div class="container d-flex justify-content-center">
        <div class="card rounded-2xl max-w-screen-lg" style="width: 40rem;"
            style="box-shadow: 2px 2px rgb(69, 67, 67);">
            <section class="jumbotron text-center mt-4">
                <h6 class="display-10 mt-1" style="text-size-adjust: 20px;"><b>REGISTER USER</b></h6>
            </section>
            <div class="row col-sm-15 justify-content-center my-2">
                <div class="col-md-auto" style="margin-bottom: 10px;">
                    <form action="{{ route('register.user') }}" method="POST">
                        @csrf
                        <div class="mb-1 row mt-3">
                            <label for="nama" class="col-sm-4 col-form-label">Nama <sup
                                    class="text-danger">*</sup></label>
                            <div class="form-group col-sm-8">
                                <input type="text" name="nama" autocomplete="off"
                                    class="form-control mb-2  @error('nama') is-invalid @enderror" id="nama"
                                    placeholder="Your nama" required value="{{ old('nama') }}">
                                @error('nama')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-1 row">
                            <label for="nim" class="col-sm-4 col-form-label">NIM <sup
                                    class="text-danger">*</sup>
                            </label>
                            <div class="form-group col-sm-8">
                                <input type="text" name="nim" autocomplete="username"
                                    class="form-control mb-2     @error('nim') is-invalid @enderror" id="nim"
                                    placeholder="NIM User" required value="{{ old('nim') }}">
                                @error('nim')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-1 row">
                            <label for="angkatan" class="col-sm-4 col-form-label">Angkatan <sup
                                    class="text-danger">*</sup></label>
                            <div class="form-group col-sm-8">
                                <input type="text" name="angkatan" autocomplete="off"
                                    class="form-control mb-2 @error('angkatan') is-invalid @enderror" id="angkatan"
                                    placeholder="Angkatan User" required value="{{ old('angkatan') }}">
                                @error('angkatan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-1 row">
                            <label for="dosen_wali_nama" class="col-sm-4 col-form-label">Dosen Wali<sup
                                    class="text-danger">*</sup></label>
                            <div class="form-group col-sm-8 mt-2">
                                <select
                                    class="form-control mb-2  @error('dosen_wali_nama')
                                        is-invalid    
                                        @enderror"
                                    name="dosen_wali_nama" id="dosen_wali_nama" required>
                                    <option selected disabled>Dosen Wali</option>
                                    @foreach ($dosens as $dosen)
                                        <option value="{{ $dosen->nama }}">{{ $dosen->nama }}</option>
                                    @endforeach
                                </select>
                                @error('dosen_wali_nama')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-1 row">
                            <label for="level" class="col-sm-4 col-form-label">Level User<sup
                                    class="text-danger">*</sup></label>
                            <div class="form-group col-sm-8">
                                <select class="form-control mb-2 @error('level') is-invalid @enderror" name="level"
                                    id="level" required>
                                    <option selected disabled>Level User</option>
                                    <option value="mahasiswa">Mahasiswa</option>
                                </select>
                                @error('level')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-1 row">
                            <label for="status" class="col-sm-4 col-form-label">Status<sup
                                    class="text-danger">*</sup></label>
                            <div class="form-group col-sm-8">
                                <select class="form-control mb-2 @error('status') is-invalid @enderror" name="status"
                                    id="status" required>
                                    <option selected disabled>Status</option>
                                    <option value="aktif">Aktif</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-1 row">
                            <label for="password" class="col-sm-4 col-form-label">Password<sup
                                    class="text-danger">*</sup></label>
                            <div class="form-group col-sm-8">
                                <input type="password"
                                    class="form-control mb-2 @error('password') is-invalid @enderror" id="password"
                                    name="password" placeholder="Password User" required>
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12 text-center my-3">
                            <button type="submit" name="submit"
                                class="btn btn-primary  ps-5 pe-5 pb-2 pt-2 text-center"
                                style="background-color: #101E31;">Register</button>
                        </div>
                        <h1 class="text-center my-3">OR</h1>
                    </form>
                    <form action="{{ route('user.import') }}" method="POST" enctype="multipart/form-data">
                        {{-- @method('post') --}}
                        @csrf
                        <div class="my-1 row">
                            <label for="input_excel" class="col-sm-4 col-form-label">Upload CSV File</label>
                            <div class="form-group col-sm-8">
                                <input type="file" class="form-control mb-2" id="input_excel" name="input_excel">
                                <small class="text-muted">Upload a CSV file for bulk registration.</small>
                            </div>
                        </div>
                        <div class="col-md-12 text-center my-3">
                            <button type="submit" name="submit"
                                class="btn btn-primary  ps-5 pe-5 pb-2 pt-2 text-center"
                                style="background-color: #101E31;">Register</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


</body>

</html>

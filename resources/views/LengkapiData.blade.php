<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
    <script
        src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    
</head>
<body style="background-color:#bfdeeb">
<div class="flex flex-col h-screen">

    <!-- Barra de navegación superior -->
    <div class="bg-gray-300 text-white shadow w-full p-2 flex items-center justify-between">
        <div class="flex items-center justify-center w-full">
            <div class="flex items-center"> <!-- Mostrado en todos los dispositivos -->
                <img src="https://1.bp.blogspot.com/-tThKR0i2DdQ/XrO4fFiulNI/AAAAAAAAB_s/4_UY2xeR3SsE9_5MGBdvsQtBJgNxf9e_wCLcBGAsYHQ/s1600/Logo%2BUndip%2BUniversitas%2BDiponegoro.png" alt="LogoUNDIP" class="w-16 h-16 mr-2">
                <h2 class="font-bold text-blue-500 text-xl">Sistem Monitoring Mahasiswa<br>UNDIP</h2>
            </div>
        </div>
    </div>

    <!--form-->
    <div class="me-5 ms-5">

        <br>
        <div class="container mt-4 flex justify-center items-center">
            <h2 class="text-4xl text-center">Lengkapi Profil</h2>
        </div>
        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
            </div>
        @endif
        <div class="container mx-auto px-4 mt-4 bg-white rounded-2xl max-w-screen-md">
            <div class="flex justify-center">
                <div class="row">
                    <div class="col-md-4 col-lg-2 col-sm-4 w-1/4 mt-4 text-center">
                        <img src="{{ asset('storage/photo/' . auth()->user()->mahasiswa->foto_mahasiswa) }}"
                            class="rounded-circle img-thumbnail"
                            style="height: 130px; width: 130px; position: absolute; margin: auto auto; left: 0; right: 475px">
                    </div>
                    <div class="col-md-8 col-lg-10 col-sm-8 w-3/4">
                        <form class="user" method="POST" action="{{ url('/lengkapidata') }}"
                            enctype="multipart/form-data">
                            @method('put')
                            @csrf
                            <div class="mb-3 row mt-4">
                                <label for="nama" class="col-sm-4 col-form-label">Nama :</label>
                                <div class="form-group col-sm-6">
                                    <input type="text"
                                        class="form-control 
                                        @error('nama')
                                    is-invalid    
                                    @enderror"
                                        id="nama" name="nama" autocomplete="off"
                                        value="{{ $mahasiswa->nama ?? old('nama') }}">
                                    @error('nama')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="nim" class="col-sm-4 col-form-label">NIM :</label>
                                <div class="form-group col-sm-6">
                                    <input type="text"
                                        class="form-control 
                                    @error('nim')
                                    is-invalid    
                                    @enderror"
                                        id="nim" name="nim" autocomplete="username"
                                        value="{{ $mahasiswa->nim ?? old('nim') }}" disabled>
                                    @error('nim')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="email" class="col-sm-4 col-form-label">Email :</label>
                                <div class="form-group col-sm-6">
                                    <input type="text"
                                        class="form-control 
                                    @error('email')
                                    is-invalid    
                                    @enderror"
                                        id="email" name="email" autocomplete="off" required
                                        value="{{ $mahasiswa->email ?? old('email') }}">
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="angkatan" class="col-sm-4 col-form-label">Angkatan :</label>
                                <div class="form-group col-sm-6">
                                    <input type="text"
                                        class="form-control 
                                        @error('angkatan')
                                    is-invalid    
                                    @enderror"
                                        id="angkatan" name="angkatan"
                                        value="{{ $mahasiswa->angkatan ?? old('angkatan') }}" disabled>
                                    @error('angkatan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="alamat" class="col-sm-4 col-form-label">Alamat :</label>
                                <div class="form-group col-sm-6">
                                    <input type="text"
                                        class="form-control 
                                        @error('alamat')
                                    is-invalid    
                                    @enderror"
                                        id="alamat" name="alamat" autocomplete="off" required
                                        value="{{ $mahasiswa->alamat ?? old('alamat') }}">
                                    @error('alamat')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="kab_kota" class="col-sm-4 col-form-label">Kota / Kab :</label>
                                <div class="form-group col-sm-6">
                                    <input type="text"
                                        class="form-control 
                                        @error('kab_kota')
                                    is-invalid    
                                    @enderror"
                                        id="kab_kota" name="kab_kota" autocomplete="off" required
                                        value="{{ $mahasiswa->kab_kota ?? old('kab_kota') }}">
                                    @error('kab_kota')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="propinsi" class="col-sm-4 col-form-label">Provinsi :</label>
                                <div class="form-group col-sm-6">
                                    <input type="text"
                                        class="form-control 
                                        @error('propinsi')
                                    is-invalid    
                                    @enderror"
                                        id="propinsi" name="propinsi" autocomplete="off" required
                                        value="{{ $mahasiswa->propinsi ?? old('propinsi') }}">
                                    @error('propinsi')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="handphone" class="col-sm-4 col-form-label">Nomor Telepon :</label>
                                <div class="form-group col-sm-6">
                                    <input type="text"
                                        class="form-control 
                                        @error('handphone')
                                    is-invalid    
                                    @enderror"
                                        id="handphone" name="handphone" autocomplete="off" required
                                        value="{{ $mahasiswa->handphone ?? old('handphone') }}">
                                    @error('handphone')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="jalur_masuk" class="col-sm-4 col-form-label">Jalur Masuk :</label>
                                <div class="form-group col-sm-6">
                                    <select class="form-control  @error('jalur_masuk') is-invalid @enderror"
                                        name="jalur_masuk" id="jalur_masuk" required>
                                        <option disabled>Jalur Masuk</option>
                                        <option value="SNMPTN"
                                            {{ $mahasiswa->jalur_masuk === 'SNMPTN' ? 'selected' : '' }}>SNMPTN
                                        </option>
                                        <option value="SBMPTN"
                                            {{ $mahasiswa->jalur_masuk === 'SBMPTN' ? 'selected' : '' }}>SBMPTN
                                        </option>
                                        <option value="MANDIRI"
                                            {{ $mahasiswa->jalur_masuk === 'MANDIRI' ? 'selected' : '' }}>MANDIRI
                                        </option>
                                    </select>
                                    @error('jalur_masuk')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="new_password" class="col-sm-4 col-form-label">Password Baru:</label>
                                <div class="form-group col-sm-6">
                                    <input type="password"
                                        class="form-control 
                                        @error('new_password')
                                            is-invalid    
                                        @enderror"
                                        id="new_password" name="new_password" autocomplete="off" required>
                                    @error('new_password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="confirm_password" class="col-sm-4 col-form-label">Konfirmasi Password
                                    Baru:</label>
                                <div class="form-group col-sm-6">
                                    <input type="password"
                                        class="form-control 
                                        @error('confirm_password')
                                            is-invalid    
                                        @enderror"
                                        id="confirm_password" name="confirm_password" autocomplete="off" required>
                                    @error('confirm_password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="foto_mahasiswa" class="col-sm-4 col-form-label">Input Foto Profil
                                    :</label>
                                <div class="form-group col-sm-6">
                                    <input type="file" name="foto_mahasiswa" id="foto_mahasiswa"
                                        class="form-control @error('foto_mahasiswa')
                                    is-invalid    
                                    @enderror mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                        required value="{{ $mahasiswa->foto_mahasiswa ?? old('foto_mahasiswa') }}">
                                    @error('foto_mahasiswa')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mt-4">
                                <div class="inline-block">
                                    <button type="submit" name="submit"
                                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



</body>


</html>

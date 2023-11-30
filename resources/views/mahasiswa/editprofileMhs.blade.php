@extends('layout/aplikasi')

@section('profil')
<div class="mr-5">
    <div class="inline-block relative shrink-0 cursor-pointer rounded-[.95rem]">
    <img class="w-[40px] h-[40px] shrink-0 inline-block rounded-[.95rem]" src="{{ asset('storage/photo/' . auth()->user()->mahasiswa->foto_mahasiswa) }}" alt="avatar image">
    </div>
</div>
<div class="mr-2 ">
    <a href="/dashboardmahasiswa/profile/edit/#" class="dark:hover:text-primary hover:text-primary transition-colors duration-200 ease-in-out text-[1.075rem] font-medium dark:text-neutral-400/90 text-secondary-inverse">{{ auth()->user()->mahasiswa->nama }}</a>
    <span class="text-secondary-dark dark:text-stone-500 font-medium block text-[0.85rem]">{{ auth()->user()->mahasiswa->nim }}</span>
    <span class="text-secondary-dark dark:text-stone-500 font-medium block text-[0.85rem]">{{ auth()->user()->mahasiswa->email }}</span>
    <span class="text-secondary-dark dark:text-stone-500 font-medium block text-[0.85rem]">{{ auth()->user()->mahasiswa->angkatan }}</span>
</div>
@endsection

@section('sidebar')
<a class="block text-gray-500 py-2.5 px-4 my-4 rounded transition duration-200 hover:bg-gradient-to-r hover:from-cyan-500 hover:to-cyan-500 hover:text-white" href="/dashboardmahasiswa">
    <i class="fas fa-home mr-2"></i>Home
</a>
<a class="block text-gray-500 py-2.5 px-4 my-4 rounded transition duration-200 hover:bg-gradient-to-r hover:from-cyan-500 hover:to-cyan-500 hover:text-white" href="/dashboardmahasiswa/profile/edit/">
    <i class="fas fa-user mr-2"></i>Edit Profil
</a>
<a class="block text-gray-500 py-2.5 px-4 my-4 rounded transition duration-200 hover:bg-gradient-to-r hover:from-cyan-500 hover:to-cyan-500 hover:text-white" href="/dashboardmahasiswa/IsiIRSMahasiswa">
    <i class="fas fa-file-alt mr-2"></i>Data IRS
</a>
<a class="block text-gray-500 py-2.5 px-4 my-4 rounded transition duration-200 hover:bg-gradient-to-r hover:from-cyan-500 hover:to-cyan-500 hover:text-white" href="/dashboardmahasiswa/IsiKHSMahasiswa">
    <i class="fas fa-list mr-2"></i>Data KHS
</a>
<a class="block text-gray-500 py-2.5 px-4 my-4 rounded transition duration-200 hover:bg-gradient-to-r hover:from-cyan-500 hover:to-cyan-500 hover:text-white" href="/dashboardmahasiswa/IsiPKLMahasiswa">
    <i class="fas fa-city mr-2"></i>Data PKL
</a>
<a class="block text-gray-500 py-2.5 px-4 my-4 rounded transition duration-200 hover:bg-gradient-to-r hover:from-cyan-500 hover:to-cyan-500 hover:text-white" href="/dashboardmahasiswa/IsiSkripsiMahasiswa">
    <i class="fas fa-book mr-2"></i>Data Skripsi
</a>
<a class="block text-gray-500 py-2.5 px-4 my-2 rounded transition duration-200 hover:bg-gradient-to-r hover:from-cyan-500 hover:to-cyan-500 hover:text-white mt-auto" href="{{ route('logout') }}">
    <i class="fas fa-sign-out-alt mr-2"></i>Logout
</a>
@endsection

@section('konten')
<div class="mt-2 bg-white p-2 shadow rounded-lg">
    <h2 class="text-gray-500 text-lg font-semibold pb-1">Edit Profil Mahasiswa</h2>
    <div class="my-0.5"></div> <!-- Espacio de separación -->
    <div class="bg-gradient-to-r from-cyan-300 to-cyan-500 h-px mb-2"></div>
    <div class="text-base">
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
        <div>
            <img src="{{ asset('storage/photo/' . auth()->user()->mahasiswa->foto_mahasiswa) }}"
                class="rounded-circle img-thumbnail mt-2"
                style="height: 130px; width: 130px; position: absolute; margin: auto auto; left: 0px; right: 500px;">
        </div>
        <form class="user justify-content-md-center flex-column align-items-center" method="POST" action="{{ url('/dashboardmahasiswa/profile/edit') }}"
            enctype="multipart/form-data">
            @method('put')
            @csrf
            <div class="row justify-content-md-center mb-2">
                <label for="nama" class="col-sm-2 col-form-label">Nama: </label>
                <div class="col-sm-2">
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
            <div class="row justify-content-md-center mb-2">
                <label for="nim" class="col-sm-2 col-form-label">NIM :</label>
                <div class="col-sm-2">
                    <input type="text"
                        class="form-control 
                    @error('nim')
                    is-invalid    
                    @enderror"
                        id="nim" name="nim" value="{{ $mahasiswa->nim ?? old('nim') }}"
                        disabled>
                    @error('nim')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="row justify-content-md-center mb-2">
                <label for="email" class="col-sm-2 col-form-label">Email :</label>
                <div class="col-sm-2">
                    <input type="text"
                        class="form-control 
                    @error('email')
                    is-invalid    
                    @enderror"
                        id="email" name="email" autocomplete="off"
                        value="{{ $mahasiswa->email ?? old('email') }}">
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="row justify-content-md-center mb-2">
                <label for="angkatan" class="col-sm-2 col-form-label">Angkatan :</label>
                <div class="col-sm-2">
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
            <div class="row justify-content-md-center mb-2">
                <label for="alamat" class="col-sm-2 col-form-label">Alamat :</label>
                <div class="col-sm-2">
                    <input type="text"
                        class="form-control 
                        @error('alamat')
                    is-invalid    
                    @enderror"
                        id="alamat" name="alamat" autocomplete="off"
                        value="{{ $mahasiswa->alamat ?? old('alamat') }}">
                    @error('alamat')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="row justify-content-md-center mb-2">
                <label for="kab_kota" class="col-sm-2 col-form-label">Kabupaten/ Kota :</label>
                <div class="col-sm-2">
                    <input type="text"
                        class="form-control 
                        @error('kab_kota')
                    is-invalid    
                    @enderror"
                        id="kab_kota" name="kab_kota" autocomplete="off"
                        value="{{ $mahasiswa->kab_kota ?? old('kab_kota') }}">
                    @error('kab_kota')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="row justify-content-md-center mb-2">
                <label for="propinsi" class="col-sm-2 col-form-label">Provinsi :</label>
                <div class="col-sm-2">
                    <input type="text"
                        class="form-control 
                        @error('propinsi')
                    is-invalid    
                    @enderror"
                        id="propinsi" name="propinsi" autocomplete="off"
                        value="{{ $mahasiswa->propinsi ?? old('propinsi') }}">
                    @error('propinsi')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="row justify-content-md-center mb-2">
                <label for="handphone" class="col-sm-2 col-form-label">Nomor HP :</label>
                <div class="col-sm-2">
                    <input type="text"
                        class="form-control 
                        @error('handphone')
                    is-invalid    
                    @enderror"
                        id="handphone" name="handphone" autocomplete="off"
                        value="{{ $mahasiswa->handphone ?? old('handphone') }}">
                    @error('handphone')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="row justify-content-md-center mb-2">
                <label for="foto_mahasiswa" class="col-sm-2 col-form-label">Input Foto Profil :</label>
                <div class="col-sm-2">
                    <input type="file"
                        class="form-control 
                        @error('foto_mahasiswa')
                    is-invalid    
                    @enderror"
                        id="foto_mahasiswa" name="foto_mahasiswa"
                        value="{{ $mahasiswa->foto_mahasiswa ?? old('foto_mahasiswa') }}">
                    @error('foto_mahasiswa')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="row justify-content-md-center mb-2">
                <div class="col-sm-2">
                    <button type="submit" class="btn btn-dark btn-md" name="submit" style="background-color:#101E31">
                        --Submit--
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
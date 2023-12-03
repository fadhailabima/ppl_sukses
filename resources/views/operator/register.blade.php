@extends('layout/aplikasi')

@section('profil')
<div class="mr-5">
    <div class="inline-block relative shrink-0 cursor-pointer rounded-[.95rem]">
    </div>
</div>
<div class="mr-2 ">
    <a href="/dashboardmahasiswa/profile/edit" class="dark:hover:text-primary hover:text-primary transition-colors duration-200 ease-in-out text-[1.075rem] font-medium dark:text-neutral-400/90 text-secondary-inverse">{{ auth()->user()->operator->nama }}</a>
    <span class="text-secondary-dark dark:text-stone-500 font-medium block text-[0.85rem]">{{ auth()->user()->operator->nip }}</span>
    <span class="text-secondary-dark dark:text-stone-500 font-medium block text-[0.85rem]">{{ auth()->user()->operator->email }}</span>
    <span class="text-secondary-dark dark:text-stone-500 font-medium block text-[0.85rem]">Fakultas Sains dan Matematika</span>
</div> 
@endsection

@section('sidebar')
<a class="block text-gray-500 py-2.5 px-4 my-4 rounded transition duration-200 hover:bg-gradient-to-r hover:from-cyan-500 hover:to-cyan-500 hover:text-white" href="/dashboardadmin">
    <i class="fas fa-home mr-2"></i>Home
</a>
<a class="block text-gray-500 py-2.5 px-4 my-4 rounded transition duration-200 hover:bg-gradient-to-r hover:from-cyan-500 hover:to-cyan-500 hover:text-white" href="{{ route('register.user') }}">
    <i class="fas fa-user-plus mr-2"></i>Register User
</a>
<a class="block text-gray-500 py-2.5 px-4 my-4 rounded transition duration-200 hover:bg-gradient-to-r hover:from-cyan-500 hover:to-cyan-500 hover:text-white" href="/dashboardadmin/daftarmahasiswa">
    <i class="fas fa-file-alt mr-2"></i>Data Mahasiswa
</a>
<button type="button" class="block text-gray-500 py-2.5 px-4 my-4 rounded transition duration-200 hover:bg-gradient-to-r hover:from-cyan-500 hover:to-cyan-500 hover:text-white" href="/dashboarddepartment/rekap" id="rekapDropdown">
    <i class="fas fa-users mr-2"></i>Rekap Data
    <i class="fas fa-chevron-down text-xs"></i>
</button>
<div class="hidden absolute z-5 w-40 rounded-md bg-white ring-1 ring-black ring-opacity-5 shadow-lg" id="rekapDropdownContent">
    <a href="/dashboardadmin/rekappkl" class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100">PKL</a>
    <a href="/dashboardadmin/rekapskripsi" class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100">Skripsi</a>
    <a href="/dashboardadmin/rekapstatus" class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100">Status</a>
</div>
<a class="block text-gray-500 py-2.5 px-4 my-2 rounded transition duration-200 hover:bg-gradient-to-r hover:from-cyan-500 hover:to-cyan-500 hover:text-white mt-auto" href="{{ route('logout') }}">
    <i class="fas fa-sign-out-alt mr-2"></i>Logout
</a>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Get the dropdown button and content
        var dropdownButton = document.getElementById('rekapDropdown');
        var dropdownContent = document.getElementById('rekapDropdownContent');

        // Show/hide the dropdown content when the button is clicked
        dropdownButton.addEventListener('click', function () {
            dropdownContent.classList.toggle('hidden');
        });

        // Hide the dropdown content when clicking outside of it
        document.addEventListener('click', function (event) {
            if (!dropdownButton.contains(event.target) && !dropdownContent.contains(event.target)) {
                dropdownContent.classList.add('hidden');
            }
        });
    });
</script>
@endsection

@section('konten')
<div class="mt-2 bg-white p-2 shadow rounded-lg">
    <h2 class="text-gray-500 text-lg font-semibold pb-1">Register User</h2>
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
        <form class="user justify-content-md-center flex-column align-items-center" method="POST" action="{{ route('register.user') }}"
            enctype="multipart/form-data">
            @csrf
            <div class="row justify-content-md-center mb-2">
                <label for="nama" class="col-sm-2 col-form-label">Nama <sup
                    class="text-danger">*</sup></label>
                <div class="col-sm-2">
                    <input type="text" class="form-control  @error('nama')
                    is-invalid    
                    @enderror" id="nama" name="nama" placeholder="Nama" required
                        value="{{ old('nama') }}">
                    @error('nama')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="row justify-content-md-center mb-2">
                <label for="nim" class="col-sm-2 col-form-label">NIM <sup
                    class="text-danger">*</sup></label>
                <div class="col-sm-2">
                    <input type="text" class="form-control  @error('nim')
                    is-invalid    
                    @enderror" id="nim" name="nim" placeholder="NIM User" required
                        value="{{ old('nim') }}">
                    @error('nim')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="row justify-content-md-center mb-2">
                <label for="angkatan" class="col-sm-2 col-form-label">Angkatan <sup
                        class="text-danger">*</sup></label>
                <div class="col-sm-2">
                    <input type="text" class="form-control  @error('angkatan')
                    is-invalid    
                    @enderror" id="angkatan" name="angkatan" placeholder="Angkatan User" required
                        value="{{ old('angkatan') }}">
                    @error('angkatan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="row justify-content-md-center mb-2">
                <label for="dosen_wali_nama" class="col-sm-2 col-form-label">Dosen Wali <sup
                        class="text-danger">*</sup></label>
                <div class="col-sm-2">
                    <select class="form-control @error('dosen_wali_nama') is-invalid @enderror " name="dosen_wali_nama" id="dosen_wali_nama" required>
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
            <div class="row justify-content-md-center mb-2">
                <label for="level" class="col-sm-2 col-form-label">Level User <sup
                        class="text-danger">*</sup></label>
                <div class="col-sm-2">
                    <select class="form-control @error('level') is-invalid @enderror " name="level" id="level" required>
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
            <div class="row justify-content-md-center mb-2">
                <label for="status" class="col-sm-2 col-form-label">Status <sup
                        class="text-danger">*</sup></label>
                <div class="col-sm-2">
                    <select class="form-control @error('status') is-invalid @enderror " name="status" id="status" required>
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
            <div class="row justify-content-md-center mb-2">
                <label for="password" class="col-sm-2 col-form-label">Password <sup
                        class="text-danger">*</sup></label>
                <div class="col-sm-2">
                    <input type="password" class="form-control  @error('password')
                    is-invalid    
                    @enderror" id="password" name="password" placeholder="Password User" required
                        value="{{ old('angkatan') }}">
                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="row justify-content-md-center mb-2">
                <div class="col text-center">
                    <button type="submit" class="btn btn-dark btn-md" name="submit" style="background-color:#101E31">
                        Register
                    </button>
                </div>
            </div>
            <div class="row justify-content-md-center my-2">
                <div class="col text-center">
                    <h1>OR</h1>
                </div>
            </div>
        </form>
        <form class="user justify-content-md-center flex-column align-items-center" method="POST" action="{{ route('user.import') }}"
            enctype="multipart/form-data">
            @csrf
            <div class="row justify-content-md-center mb-2">
                <label for="input_excel" class="col-sm-2 col-form-label">Upload CSV File </label>
                <div class="col-sm-2">
                    <input type="file" class="form-control" id="input_excel" name="input_excel">
                    <small class="text-muted">Upload a CSV file for bulk registration.</small>
                </div>
            </div>
            <div class="row justify-content-md-center mb-2">
                <div class="col text-center">
                    <button type="submit" class="btn btn-dark btn-md" name="submit" style="background-color:#101E31">
                        Register
                    </button>
                </div>
            </div>
        </form>  
    </div>
</div>
@endsection
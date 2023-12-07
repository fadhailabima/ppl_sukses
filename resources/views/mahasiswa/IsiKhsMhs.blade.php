@extends('layout/aplikasi')

@section('profil')
<div class="mr-5">
    <div class="inline-block relative shrink-0 cursor-pointer rounded-[.95rem]">
    <img class="w-[40px] h-[40px] shrink-0 inline-block rounded-[.95rem]" src="{{ asset('storage/photo/' . auth()->user()->mahasiswa->foto_mahasiswa) }}" alt="avatar image">
    </div>
</div>
<div class="mr-2 ">
    <a href="/dashboardmahasiswa/profile/edit" class="dark:hover:text-primary hover:text-primary transition-colors duration-200 ease-in-out text-[1.075rem] font-medium dark:text-neutral-400/90 text-secondary-inverse">{{ auth()->user()->mahasiswa->nama }}</a>
    <span class="text-secondary-dark dark:text-stone-500 font-medium block text-[0.85rem]">{{ auth()->user()->mahasiswa->nim }}</span>
    <span class="text-secondary-dark dark:text-stone-500 font-medium block text-[0.85rem]">{{ auth()->user()->mahasiswa->email }}</span>
    <span class="text-secondary-dark dark:text-stone-500 font-medium block text-[0.85rem]">{{ auth()->user()->mahasiswa->angkatan }}</span>
</div>
@endsection

@section('sidebar')
<a class="block text-gray-500 py-2.5 px-4 my-4 rounded transition duration-200 hover:bg-gradient-to-r hover:from-cyan-500 hover:to-cyan-500 hover:text-white" href="/dashboardmahasiswa">
    <i class="fas fa-home mr-2"></i>Home
</a>
<a class="block text-gray-500 py-2.5 px-4 my-4 rounded transition duration-200 hover:bg-gradient-to-r hover:from-cyan-500 hover:to-cyan-500 hover:text-white" href="/dashboardmahasiswa/profile/edit">
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
    <h2 class="text-gray-500 text-lg font-semibold pb-1">Isi Data KHS</h2>
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
        <form class="user justify-content-md-center flex-column align-items-center" method="POST" action="/dashboardmahasiswa/IsiKHSMahasiswa"
            enctype="multipart/form-data">
            @csrf
            <div class="row justify-content-md-center mb-2">
                <label for="semester" class="col-sm-2 col-form-label">Semester Aktif:<sup
                        class="text-danger">*</sup></label>
                <div class="col-sm-2">
                    <select class="form-control @error('semester') is-invalid @enderror " name="semester" id="semester" required>
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
            </div>
            <div class="row justify-content-md-center mb-2">
                <label for="skssemester" class="col-sm-2 col-form-label">SKS Semester :<sup
                        class="text-danger">*</sup></label>
                <div class="col-sm-2">
                    <input type="text" class="form-control  @error('skssemester')
                    is-invalid    
                    @enderror" id="skssemester" name="skssemester" placeholder="SKS Semester" required
                        value="{{ old('skssemester') }}">
                    @error('skssemester')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="row justify-content-md-center mb-2">
                <label for="ipsemester" class="col-sm-2 col-form-label">IP Semester :<sup
                        class="text-danger">*</sup></label>
                <div class="col-sm-2">
                    <input type="text" class="form-control  @error('ipsemester') is-invalid @enderror" id="ipsemester" name="ipsemester" placeholder="IP Semester" required
                     value="{{ old('ipsemester') }}">
                    @error('ipsemester')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="row justify-content-md-center mb-2">
                <label for="skskumulatif" class="col-sm-2 col-form-label">SKS Kumulatif :<sup
                        class="text-danger">*</sup></label>
                <div class="col-sm-2">
                    <input type="text" class="form-control  @error('skskumulatif')
                    is-invalid    
                    @enderror" id="skskumulatif" name="skskumulatif" placeholder="SKS Kumulatif" required
                        value="{{ old('skskumulatif') }}">
                    @error('skskumulatif')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="row justify-content-md-center mb-2">
                <label for="ipkumulatif" class="col-sm-2 col-form-label">IP Kumulatif :<sup
                        class="text-danger">*</sup></label>
                <div class="col-sm-2">
                    <input type="text" class="form-control  @error('ipkumulatif')
                    is-invalid    
                    @enderror" id="ipkumulatif" name="ipkumulatif" placeholder="IP Kumulatif" required
                        value="{{ old('ipkumulatif') }}">
                    @error('ipkumulatif')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="row justify-content-md-center mb-4">
                <label for="scankhs" class="col-sm-2 col-form-label">Scan KHS :<sup
                        class="text-danger">*</sup></label>
                <div class="col-sm-2">
                    <input type="file" class="form-control  @error('scankhs') is-invalid @enderror" id="scankhs" name="scankhs" placeholder="Scan KHS" required>
                    @error('scankhs')
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
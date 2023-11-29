@extends('layout/aplikasi')

@section('profil')
    <div class="mr-5">
        <div class="inline-block relative shrink-0 cursor-pointer rounded-[.95rem]">
        </div>
    </div>
    <div class="mr-2 ">
        <a href="#"
            class="dark:hover:text-primary hover:text-primary transition-colors duration-200 ease-in-out text-[1.075rem] font-medium dark:text-neutral-400/90 text-secondary-inverse">{{ auth()->user()->departemen->nama_department }}</a>
        <span
            class="text-secondary-dark dark:text-stone-500 font-medium block text-[0.85rem]">{{ auth()->user()->departemen->nip }}</span>
        <span
            class="text-secondary-dark dark:text-stone-500 font-medium block text-[0.85rem]">{{ auth()->user()->departemen->email }}</span>
        <span class="text-secondary-dark dark:text-stone-500 font-medium block text-[0.85rem]">Fakultas Sains dan
            Matematika</span>
    </div>
@endsection

@section('sidebar')
    <a class="block text-gray-500 py-2.5 px-4 my-4 rounded transition duration-200 hover:bg-gradient-to-r hover:from-cyan-500 hover:to-cyan-500 hover:text-white"
        href="/dashboarddepartment">
        <i class="fas fa-home mr-2"></i>Home
    </a>
    <a class="block text-gray-500 py-2.5 px-4 my-4 rounded transition duration-200 hover:bg-gradient-to-r hover:from-cyan-500 hover:to-cyan-500 hover:text-white"
        href="/dashboarddepartment/daftarmahasiswa">
        <i class="fas fa-file-alt mr-2"></i>Data Mahasiswa
    </a>
    <button type="button"
        class="block text-gray-500 py-2.5 px-4 my-4 rounded transition duration-200 hover:bg-gradient-to-r hover:from-cyan-500 hover:to-cyan-500 hover:text-white"
        href="/dashboarddepartment/rekap" id="rekapDropdown">
        <i class="fas fa-users mr-2"></i>Rekap Data
        <i class="fas fa-chevron-down text-xs"></i>
    </button>
    <div class="hidden absolute z-5 w-40 rounded-md bg-white ring-1 ring-black ring-opacity-5 shadow-lg"
        id="rekapDropdownContent">
        <a href="/dashboarddepartment/rekappkl" class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100">PKL</a>
        <a href="/dashboarddepartment/rekapskripsi" class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100">Skripsi</a>
        <a href="" class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100">Status</a>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get the dropdown button and content
            var dropdownButton = document.getElementById('rekapDropdown');
            var dropdownContent = document.getElementById('rekapDropdownContent');

            // Show/hide the dropdown content when the button is clicked
            dropdownButton.addEventListener('click', function() {
                dropdownContent.classList.toggle('hidden');
            });

            // Hide the dropdown content when clicking outside of it
            document.addEventListener('click', function(event) {
                if (!dropdownButton.contains(event.target) && !dropdownContent.contains(event.target)) {
                    dropdownContent.classList.add('hidden');
                }
            });
        });
    </script>
@endsection

@section('konten')
    <div class="mt-2 flex flex-wrap space-x-0 space-y-2 md:space-x-4 md:space-y-0">
        <div class="flex-1 bg-white p-2 shadow rounded-lg md:w-1/3">
            <h2 class="text-gray-500 text-lg font-semibold pb-1">Rekap Data Skripsi</h2>
            <div class="my-0.5"></div>
            <div class="bg-gradient-to-r from-cyan-300 to-cyan-500 h-px mb-3"></div>
            <div>
                <a href="{{ route('rekapSkripsi.pdf') }}"
                    class="text-white bg-blue-500 hover:bg-blue-600 font-medium text-base text-center py-2 px-4 rounded-full"
                    target="">Cetak Rekap</a>
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 mt-3">
                    <thead class="text-xs text-gray-700 bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr class="text-center">
                            <th scope="col" class="px-6 py-2 text-xl" colspan="{{ count($tahunRange) * 2 }}">Angkatan
                            </th>
                        </tr>
                        <tr class="text-center">
                            @foreach ($tahunRange as $tahunItem)
                                <th scope="col" class="px-6 py-3 text-lg" colspan="2">{{ $tahunItem }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="text-center">
                            @for ($i = 0; $i < count($tahunRange); $i++)
                                <td class="py-2 font-medium">Sudah Skripsi</td>
                                <td class="py-2 font-medium">Belum Skripsi</td>
                            @endfor
                        </tr>
                        <tr class="text-center">
                            @foreach ($tahunRange as $year)
                                <td class="py-2 text-blue-500 font-medium text-base text-center">
                                    <a
                                        href="{{ route('sudahskripsi', ['tahun' => $year]) }}">{{ $jumlahMahasiswaSkripsi[$year] }}</a>
                                </td>
                                <td class="py-2 text-blue-500 font-medium text-base text-center">
                                    <a href="{{ route('belumskripsi', ['tahun' => $year]) }}">{{ $jumlahMahasiswaBlmSkripsi[$year] }}</a>
                                </td>
                            @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

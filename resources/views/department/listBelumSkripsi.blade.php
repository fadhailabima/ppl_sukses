@extends('layout/aplikasi')

@section('profil')
    <div class="mr-5">
        <div class="inline-block relative shrink-0 cursor-pointer rounded-[.95rem]">
        </div>
    </div>
    <div class="mr-2 ">
        <a href="/dashboardmahasiswa/profile/edit"
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
        <a href="/dashboarddepartment/rekapstatus" class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100">Status</a>
    </div>
    <a class="block text-gray-500 py-2.5 px-4 my-2 rounded transition duration-200 hover:bg-gradient-to-r hover:from-cyan-500 hover:to-cyan-500 hover:text-white mt-auto" href="{{ route('logout') }}">
        <i class="fas fa-sign-out-alt mr-2"></i>Logout
    </a>
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
            <h2 class="text-gray-500 text-lg font-semibold pb-1">Daftar Mahasiswa Belum Lulus Skripsi</h2>
            <div class="my-0.5"></div>
            <div class="bg-gradient-to-r from-cyan-300 to-cyan-500 h-px mb-3"></div>
            <div>
                <a href="/dashboarddepartment/rekapskripsi"
                    class="text-white bg-blue-500 hover:bg-blue-600 font-medium text-base text-center py-2 px-4 rounded-full"
                    target="">Kembali</a>
                <a href="{{ route('listBelumSkripsi.pdf', ['tahun' => $tahun]) }}"
                    class="text-white bg-blue-500 hover:bg-blue-600 font-medium text-base text-center py-2 px-4 rounded-full"
                    target="_blank">
                    Cetak Rekap
                </a>
                <table class="min-w-full mt-3 divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-800">
                        <tr>
                            <th scope="col"
                                class="px-12 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                No
                            </th>

                            <th scope="col"
                                class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                NIM
                            </th>

                            <th scope="col"
                                class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                Nama
                            </th>

                            <th scope="col"
                                class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                Angkatan
                            </th>

                            <th scope="col"
                                class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                Dosen Wali
                            </th>
                        </tr>
                    <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">
                        @foreach ($belumSkripsi as $item)
                            <tr>
                                {{-- <td class="px-4 py-4">{{ $loop->iteration }}</td> --}}
                                <td class="px-4 py-4">{{ $item->nim }}</td>
                                <td class="px-4 py-4">{{ $item->nama }}</td>
                                <td class="px-4 py-4">{{ $item->angkatan }}</td>
                                <td class="px-4 py-4">{{ $namaDosenWali }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <script>
                var tables = document.getElementsByTagName('table');
                var table = tables[tables.length - 1];
                var rows = table.rows;
                for (var i = 1, td; i < rows.length; i++) {
                    td = document.createElement('td');
                    td.appendChild(document.createTextNode(i + 0));
                    td.classList.add("px-12", "py-4");
                    rows[i].insertBefore(td, rows[i].firstChild);
                }
            </script>
        </div>
    </div>
@endsection

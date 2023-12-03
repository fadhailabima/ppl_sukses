@extends('layout/aplikasi')

@section('profil')
<div class="mr-5">
    <div class="inline-block relative shrink-0 cursor-pointer rounded-[.95rem]">
    </div>
</div>
<div class="mr-2 ">
    <span class="dark:hover:text-primary hover:text-primary transition-colors duration-200 ease-in-out text-[1.075rem] font-medium dark:text-neutral-400/90 text-secondary-inverse">{{ auth()->user()->dosenWali->nama }}</a>
    <span class="text-secondary-dark dark:text-stone-500 font-medium block text-[0.85rem]">{{ auth()->user()->dosenWali->nip }}</span>
    <span class="text-secondary-dark dark:text-stone-500 font-medium block text-[0.85rem]">{{ auth()->user()->dosenWali->email }}</span>
    <span class="text-secondary-dark dark:text-stone-500 font-medium block text-[0.85rem]">Fakultas Sains dan Matematika</span>
</div> 
@endsection

@section('sidebar')
<a class="block text-gray-500 py-2.5 px-4 my-4 rounded transition duration-200 hover:bg-gradient-to-r hover:from-cyan-500 hover:to-cyan-500 hover:text-white" href="/dashboarddosen">
    <i class="fas fa-home mr-2"></i>Home
</a>
<a class="block text-gray-500 py-2.5 px-4 my-4 rounded transition duration-200 hover:bg-gradient-to-r hover:from-cyan-500 hover:to-cyan-500 hover:text-white" href="/dashboarddosen/irs">
    <i class="fas fa-file-alt mr-2"></i>Data IRS Mahasiswa
</a>
<a class="block text-gray-500 py-2.5 px-4 my-4 rounded transition duration-200 hover:bg-gradient-to-r hover:from-cyan-500 hover:to-cyan-500 hover:text-white" href="/dashboarddosen/khs">
    <i class="fas fa-list mr-2"></i>Data KHS Mahasiswa
</a>
<a class="block text-gray-500 py-2.5 px-4 my-4 rounded transition duration-200 hover:bg-gradient-to-r hover:from-cyan-500 hover:to-cyan-500 hover:text-white" href="/dashboarddosen/pkl">
    <i class="fas fa-city mr-2"></i>Data PKL Mahasiswa
</a>
<a class="block text-gray-500 py-2.5 px-4 my-4 rounded transition duration-200 hover:bg-gradient-to-r hover:from-cyan-500 hover:to-cyan-500 hover:text-white" href="/dashboarddosen/skripsi">
    <i class="fas fa-book mr-2"></i>Data Skripsi Mhs
</a>
<a class="block text-gray-500 py-2.5 px-4 my-4 rounded transition duration-200 hover:bg-gradient-to-r hover:from-cyan-500 hover:to-cyan-500 hover:text-white" href="/dashboarddosen/daftarmahasiswa">
    <i class="fas fa-users mr-2"></i>Data Mahasiswa
</a>
<a class="block text-gray-500 py-2.5 px-4 my-2 rounded transition duration-200 hover:bg-gradient-to-r hover:from-cyan-500 hover:to-cyan-500 hover:text-white mt-auto" href="{{ route('logout') }}">
    <i class="fas fa-sign-out-alt mr-2"></i>Logout
</a>
@endsection


@section('konten')
<div class="mt-2 flex flex-wrap space-x-0 space-y-2 md:space-x-4 md:space-y-0">
    <div class="flex-1 bg-white p-2 shadow rounded-lg md:w-1/3">
        <h2 class="text-gray-500 text-lg font-semibold pb-1">KHS Mahasiswa Perwalian</h2>
        <div class="my-0.5"></div> <!-- Espacio de separación -->
        <div class="bg-gradient-to-r from-cyan-300 to-cyan-500 h-px mb-3"></div>
        <div class="flex justify-center my-3">
            <div class="relative flex items-center md:px-6 lg:px-8">
                <span class="absolute">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor"
                        class="w-5 h-5 mx-3 mb-1 text-gray-400 dark:text-gray-600">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                    </svg>
                </span>
                <form action="/dashboarddosen/khs" method="GET">
                    <input type="search" placeholder="Cari Nama Mahasiswa" name="search" id="search"
                        class="block w-full py-1.5 pr-5 text-gray-700 bg-white border border-gray-200 rounded-lg md:w-80 placeholder-gray-400/70 pl-11 rtl:pr-11 rtl:pl-5 dark:bg-gray-900 dark:text-black-300 dark:border-gray-600 focus:border-blue-400 dark:focus:border-blue-300 focus:ring-blue-300 focus:outline-none focus:ring focus:ring-opacity-40">

            </div>
            <button class="btn btn-outline-primary w-16 h-9" type="submit">Cari</button>
            </form>
        </div>
        <div class="overflow-hidden border border-gray-200 dark:border-gray-700 md:rounded-lg mb-2">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-800">
                    <tr>
                        <th scope="col"
                            class="px-12 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            No
                        </th>

                        <th scope="col"
                            class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            Nama
                        </th>

                        <th scope="col"
                            class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            Semester
                        </th>

                        <th scope="col"
                            class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            SKS Semester
                        </th>

                        <th scope="col"
                            class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            SKS Kumulatif
                        </th>

                        <th scope="col"
                            class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            IP Semester
                        </th>

                        <th scope="col"
                            class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            IP Kumulatif
                        </th>

                        <th scope="col"
                            class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            Status
                        </th>

                        <th scope="col"
                            class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            Download
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">
                    @foreach ($datakhs as $item)
                        <tr>
                            <td class="px-4 py-4">{{ $item->nama }}</td>
                            <td class="px-4 py-4">{{ $item->semester }}</td>
                            <td class="px-4 py-4">{{ $item->skssemester }}</td>
                            <td class="px-4 py-4">{{ $item->skskumulatif }}</td>
                            <td class="px-4 py-4">{{ $item->ipsemester }}</td>
                            <td class="px-4 py-4">{{ $item->ipkumulatif }}</td>
                            {{-- <td class="px-4 py-4">{{ $item->scankhs }}</td> --}}
                            <td>
                                @if ($item->isverified == 1)
                                    <a href="/dashboarddosen/khs/unverify/{{ $item->id }}"
                                        class="btn btn-danger">Batal</a>
                                @else
                                    <a href="/dashboarddosen/khs/verify/{{ $item->id }}"
                                        class="btn btn-success">Setujui</a>
                                @endif
                            </td>
                            {{-- <!-- <td class="px-4 py-4">{{ $item->level }}</td> --}}
                            <td><a href="/dashboarddosen/khs/download/{{ $item->id }}"
                                    class="btn btn-facebook">Download</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
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

@endsection
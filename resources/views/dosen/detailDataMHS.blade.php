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
        <h2 class="text-gray-500 text-lg font-semibold pb-1">Data {{ $mahasiswa->nama }}</h2>
        <div class="my-0.5"></div> <!-- Espacio de separación -->
        <div class="bg-gradient-to-r from-cyan-300 to-cyan-500 h-px mb-3"></div>
        <div class="container mt-2" style="margin-top: 32px;">
            <a href="/dashboarddosen/daftarmahasiswa"
                    class="text-white bg-blue-500 hover:bg-blue-600 font-medium text-base text-center py-2 px-4 rounded-full"
                    target="">Kembali</a>
            <div class="row mt-3 justify-content-md-left">
                <img src="{{ asset('storage/photo/' . $mahasiswa->foto_mahasiswa) }}"
                    class="rounded-circle img-thumbnail"
                    style="height: 120px; width: 120px;">
                <div class="col-sm-2">
                    <table style="font-size: 16px;">
                        <tr>
                            <td>{{ $mahasiswa->nama }}</td>
                        </tr>
                        <tr>
                            <td>{{ $mahasiswa->nim }}</td>
                        </tr>
                        <tr>
                            <td>{{ $mahasiswa->angkatan }}</td>
                        </tr>
                        <tr>
                            <td>{{ $mahasiswa->email }}</td>
                        </tr>
                    </table>
                </div>
            </div>

        </div>
        <div style="margin-top: 32x;">
            <div class="row text-left">
                <div class="text-left mt-4">
                    <div class="font-semibold text-lg">Semester</div>
                </div>
                <div class="container text-left mt-2 ">
                    <div class="grid w-3/6 grid-cols-7 gap-2">
                        @for ($semester = 1; $semester <= 14; $semester++)
                            @php
                                $status = $semesterStatus[$semester];
                                $buttonClass = '';

                                // Menentukan kelas tambahan berdasarkan status
                                if ($status === 'blue') {
                                    $buttonClass = 'btn-primary'; // Warna biru
                                } elseif ($status === 'yellow') {
                                    $buttonClass = 'btn-warning'; // Warna kuning
                                } elseif ($status === 'green') {
                                    $buttonClass = 'btn-success'; // Warna hijau
                                } else {
                                    $buttonClass = 'btn-danger'; // Warna merah
                                }
                            @endphp

                            <div class="mr-1">
                                <button
                                    class="btn rounded-sm border-l border-t border-r rounded-t py-2 px-4 text-white font-semibold shadow-md inline-block semester-button {{ $buttonClass }}"
                                    data-bs-toggle="modal"
                                    data-bs-target="#semesterModal_{{ $semester }}">{{ $semester }}</button>
                            </div>
                        @endfor
                    </div>
                </div>
                <br>
                @for ($semester = 1; $semester <= 14; $semester++)
                    <!-- Modal for semester {{ $semester }} -->
                    <div class="modal fade" id="semesterModal_{{ $semester }}" tabindex="-1"
                        aria-labelledby="exampleModalLabel_{{ $semester }}" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <!-- Modal content here -->
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel_{{ $semester }}">
                                        Detail Semester {{ $semester }}</h5>
                                </div>
                                <div class="modal-body">
                                    @php
                                        $irsData = $mahasiswa->irs
                                            ? $mahasiswa->irs
                                                ->where('semester', $semester)
                                                ->where('isverified', true)
                                                ->first()
                                            : null;
                                        $khsData = $mahasiswa->khs
                                            ? $mahasiswa->khs
                                                ->where('semester', $semester)
                                                ->where('isverified', true)
                                                ->first()
                                            : null;
                                        $pklData = $mahasiswa->pkl
                                            ? $mahasiswa->pkl
                                                ->where('semester', $semester)
                                                ->where('isverified', true)
                                                ->first()
                                            : null;
                                        $skripsiData = $mahasiswa->skripsi
                                            ? $mahasiswa->skripsi
                                                ->where('semester', $semester)
                                                ->where('isverified', true)
                                                ->first()
                                            : null;
                                    @endphp
                                    <ul class="nav nav-tabs" id="semesterTabs">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="irsTabLink" data-bs-toggle="tab"
                                                href="#irsTab_{{ $semester }}">IRS</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="khsTabLink" data-bs-toggle="tab"
                                                href="#khsTab_{{ $semester }}">KHS</a>
                                        </li>
                                        @if ($pklData)
                                            <li class="nav-item">
                                                <a class="nav-link" id="pklTabLink" data-bs-toggle="tab"
                                                    href="#pklTab_{{ $semester }}">PKL</a>
                                            </li>
                                        @endif
                                        @if ($skripsiData)
                                            <li class="nav-item">
                                                <a class="nav-link" id="skripsiTabLink"
                                                    data-bs-toggle="tab"
                                                    href="#skripsiTab_{{ $semester }}">Skripsi</a>
                                            </li>
                                        @endif
                                    </ul>
                                    <div class="tab-content" id="semesterTabsContent">
                                        @if ($irsData && $khsData)
                                            <div class="tab-pane fade show active"
                                                id="irsTab_{{ $semester }}" role="tabpanel">
                                                <p>Semester {{ $semester }}</p>
                                                <p>{{ $irsData->jmlsks }} SKS</p>
                                            </div>
                                            <div class="tab-pane fade" id="khsTab_{{ $semester }}"
                                                role="tabpanel">
                                                <p>SKS Semester: {{ $khsData->skssemester }}</p>
                                                <p>IP Semester: {{ $khsData->ipsemester }}</p>
                                                <p>SKS Kumulatif: {{ $khsData->skskumulatif }}</p>
                                                <p>IP Kumulatif: {{ $khsData->ipkumulatif }}</p>
                                            </div>
                                        @else
                                            <p>Data tidak tersedia untuk semester ini.</p>
                                        @endif

                                        <!-- Add the PKL tab content if there is PKL data -->
                                        @if ($irsData && $khsData && $pklData)
                                            <div class="tab-pane fade show active"
                                                id="irsTab_{{ $semester }}" role="tabpanel">
                                                <p>Semester {{ $semester }}</p>
                                                <p>{{ $irsData->jmlsks }} SKS</p>
                                            </div>
                                            <div class="tab-pane fade" id="khsTab_{{ $semester }}"
                                                role="tabpanel">
                                                <p>SKS Semester: {{ $khsData->skssemester }}</p>
                                                <p>IP Semester: {{ $khsData->ipsemester }}</p>
                                                <p>SKS Kumulatif: {{ $khsData->skskumulatif }}</p>
                                                <p>IP Kumulatif: {{ $khsData->ipkumulatif }}</p>
                                            </div>
                                            <div class="tab-pane fade" id="pklTab_{{ $semester }}"
                                                role="tabpanel">
                                                <!-- Display PKL information here -->
                                                <p>Semester: {{ $pklData->semester }}</p>
                                                <p>Instansi: {{ $pklData->instansi }}</p>
                                                <p>Dosen Pengampu: {{ $pklData->dosenpengampu }}</p>
                                                <!-- Add more information related to PKL if needed -->
                                            </div>
                                        @endif

                                        <!-- Add the Skripsi tab content if there is Skripsi data -->
                                        @if ($skripsiData)
                                            <div class="tab-pane fade"
                                                id="skripsiTab_{{ $semester }}" role="tabpanel">
                                                <!-- Display Skripsi information here -->
                                                <p>Semester: {{ $skripsiData->semester }}</p>
                                                <p>Tanggal Sidang: {{ $skripsiData->tglsidang }}</p>
                                                <p>Dosen Pembimbing: {{ $skripsiData->dosenpembimbing }}
                                                </p>
                                                <!-- Add more information related to Skripsi if needed -->
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <!-- Modal footer -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger"
                                        style="color: white; background-color: #d9534f; border-color: #d9534f;"
                                        onmouseover="this.style.color='white'; this.style.backgroundColor='#c9302c'; this.style.borderColor='#ac2925';"
                                        onmouseout="this.style.color='white'; this.style.backgroundColor='#d9534f'; this.style.borderColor='#d9534f';"
                                        data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
        </div>
        <div class="my-2" >
            <div class="row">
                <div class="text-left mt-2">
                    <div class="font-medium text-base">
                        Keterangan :</div>
                    <div class="font-medium text-base flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-2" fill="none"
                            stroke="red" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2" viewBox="0 0 24 24">
                            <rect width="18" height="18" x="3" y="3" fill="red"
                                rx="4" />
                        </svg>
                        <span class="align-middle">Belum Diisikan (IRS dan KHS) atau tidak digunakan</span>
                    </div>
                    <div class="font-medium text-base flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-2" fill="none"
                            stroke="blue" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2" viewBox="0 0 24 24">
                            <rect width="18" height="18" x="3" y="3" fill="blue"
                                rx="4" />
                        </svg>
                        <span class="align-middle">Sudah Diisikan (IRS dan KHS)</span>
                    </div>
                    <div class="font-medium text-base flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-2" fill="none"
                            stroke="yellow" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2" viewBox="0 0 24 24">
                            <rect width="18" height="18" x="3" y="3" fill="yellow"
                                rx="4" />
                        </svg>
                        <span class="align-middle">Sudah Lulus PKL (IRS, KHS, dan PKL)</span>
                    </div>
                    <div class="font-medium text-base flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-2" fill="none"
                            stroke="green" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2" viewBox="0 0 24 24">
                            <rect width="18" height="18" x="3" y="3" fill="green"
                                rx="4" />
                        </svg>
                        <span class="align-middle">Sudah Lulus Skripsi</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
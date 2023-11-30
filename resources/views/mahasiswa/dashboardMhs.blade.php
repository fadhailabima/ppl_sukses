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
<div class="mt-2 flex flex-wrap space-x-0 space-y-2 md:space-x-4 md:space-y-0">
    <!-- Primer contenedor -->
    <!-- Sección 1 - Gráfica de Usuarios -->
    <div class="flex-1 bg-white p-2 shadow rounded-lg md:w-1/3">
        <h2 class="text-gray-500 text-lg font-semibold pb-1">IRS</h2>
        <div class="my-0.5"></div> <!-- Espacio de separación -->
        <div class="bg-gradient-to-r from-cyan-300 to-cyan-500 h-px mb-3"></div> <!-- Línea con gradiente -->
        @if ($irs)
            <div class="text-base">
                @if ($irs->isverified == 1)
                    <p>SKS : {{ $irs->jmlsks }}</p>
                    <p>Semester : {{ $irs->semester }}</p>
                @else
                    <p>Belum Disetujui</p>
                @endif
            </div>
        @else
            <div class="text-base">
                <p>Tidak ada data IRS terbaru</p>
            </div>
        @endif
    </div>

    <!-- Segundo contenedor -->
    <!-- Sección 2 - Gráfica de Comercios -->
    <div class="flex-1 bg-white p-2 shadow rounded-lg md:w-1/3">
        <h2 class="text-gray-500 text-lg font-semibold pb-1">KHS</h2>
        <div class="my-0.5"></div> <!-- Espacio de separación -->
        <div class="bg-gradient-to-r from-cyan-300 to-cyan-500 h-px mb-3"></div> <!-- Línea con gradiente -->
        @if ($k_h_s)
            <div class="text-base">
                @if ($k_h_s->isverified == 1)
                    <p>Semester : {{ $k_h_s->semester }}</p>
                    <p>SKS Semester : {{ $k_h_s->skssemester }}</p>
                    <p>IP Semester : {{ $k_h_s->ipsemester }}</p>
                    <p>SKS Kumulatif : {{ $k_h_s->skskumulatif }}</p>
                    <p>IP Kumulatif : {{ $k_h_s->ipkumulatif }}</p>
                @else
                    <p>Belum Disetujui</p>
                @endif
            </div>
        @else
            <div class="text-base">
                <p>Tidak ada data KHS terbaru</p>
            </div>
        @endif
    </div>
</div>

<div class="mt-6 flex flex-wrap space-x-0 space-y-2 md:space-x-4 md:space-y-0">
    <div class="flex-1 bg-white p-2 shadow rounded-lg md:w-1/3">
        <h2 class="text-gray-500 text-lg font-semibold pb-1">PKL</h2>
        <div class="my-0.5"></div> <!-- Espacio de separación -->
        <div class="bg-gradient-to-r from-cyan-300 to-cyan-500 h-px mb-3"></div> <!-- Línea con gradiente -->
        @if ($p_k_l_s->isNotEmpty())
            @foreach ($p_k_l_s as $pkl)
                <div class="text-base">
                    @if ($pkl->isverified == 1)
                        <p>Semester : {{ $pkl->semester }}</p>
                        <p>Instansi : {{ $pkl->instansi }}</p>
                        <p>Dosen Pengampu : {{ $pkl->dosenpengampu }}</p>
                    @else
                        <p>Belum Disetujui</p>
                    @endif
                </div>
            @endforeach
        @else
            <div class="text-base">
                <p>Belum Mendaftar PKL</p>
            </div>
        @endif
    </div>

    <!-- Segundo contenedor -->
    <!-- Sección 2 - Gráfica de Comercios -->
    <div class="flex-1 bg-white p-2 shadow rounded-lg md:w-1/3">
        <h2 class="text-gray-500 text-lg font-semibold pb-1">Skripsi</h2>
        <div class="my-0.5"></div> <!-- Espacio de separación -->
        <div class="bg-gradient-to-r from-cyan-300 to-cyan-500 h-px mb-3"></div> <!-- Línea con gradiente -->
        @if ($skripsis->isNotEmpty())
            @foreach ($skripsis as $skripsi)
                <div class="text-base">
                    @if ($skripsi->isverified == 1)
                        <p>Tanggal Sidang : {{ $skripsi->tglsidang }}</p>
                        <p>Dosen Pembimbing : {{ $skripsi->dosenpembimbing }}</p>
                    @else
                        <p>Belum Disetujui</p>
                    @endif
                </div>
            @endforeach
        @else
            <div class="text-base">
                <p>Belum Mendaftar Skripsi</p>
            </div>
        @endif
    </div>
</div>

<!-- Tercer contenedor debajo de los dos anteriores -->
<!-- Sección 3 - Tabla de Autorizaciones Pendientes -->
<div class="mt-6 bg-white p-2 shadow rounded-lg">
    <h2 class="text-gray-500 text-lg font-semibold pb-1">Progress Semester</h2>
    <div class="my-0.5"></div> <!-- Espacio de separación -->
    <div class="bg-gradient-to-r from-cyan-300 to-cyan-500 h-px mb-3"></div>
    <div class="text-center my-2">
        <div class="font-semibold text-base">Semester</div>
    </div>
    <div class="container w-3/6 text-center mt-2 ">
        <div class="grid grid-cols-7 gap-2">
            {{-- @foreach ($semesterStatus as $semesterStts) --}}
                {{-- @if (isset($semesterStatus)) --}}
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
            {{-- @endforeach --}}
            {{-- @endif --}}
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
                                    <a class="nav-link" id="skripsiTabLink" data-bs-toggle="tab"
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
                            @if ($pklData)
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
                                <div class="tab-pane fade" id="skripsiTab_{{ $semester }}"
                                    role="tabpanel">
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
@endsection
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
    <div class="flex-5 bg-white p-2 shadow rounded-lg md:w-1/3">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-h5">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Jumlah Mahasiswa Perwalian</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $jmlmhs }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="mt-6 flex flex-wrap space-x-0 space-y-2 md:space-x-4 md:space-y-0">
    <!-- Primer contenedor -->
    <!-- Sección 1 - Gráfica de Usuarios -->
    
    <!-- Segundo contenedor -->
    <!-- Sección 2 - Gráfica de Comercios -->
    <div class="flex-1 bg-white p-2 shadow rounded-lg md:w-1/3">
        <h2 class="text-gray-500 text-lg font-semibold pb-1">IRS Mahasiswa</h2>
        <div class="my-0.5"></div> <!-- Espacio de separación -->
        <div class="bg-gradient-to-r from-cyan-300 to-cyan-500 h-px mb-3"></div>
        <div id="piechartirs" style="width: 60%; height: 60%;">
            <!-- Your IRS content here -->
        </div>
        <div class="mt-4 mb-4 ml-4">
            <a href=""
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">IRS
                Mahasiswa</a>
        </div>
    </div>
    <div class="flex-1 bg-white p-2 shadow rounded-lg md:w-1/3">
        <h2 class="text-gray-500 text-lg font-semibold pb-1">KHS Mahasiswa</h2>
        <div class="my-0.5"></div> <!-- Espacio de separación -->
        <div class="bg-gradient-to-r from-cyan-300 to-cyan-500 h-px mb-3"></div> <!-- Línea con gradiente -->
        <div class="card" style="width: 250px; height: 250px;">
            <div id="piechartkhs" style="width: 100%; height: 100%;">
                <!-- Your IRS content here -->
            </div>
            <div class="mt-4 mb-4 ml-4">
                <a href=""
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">KHS
                    Mahasiswa</a>
            </div>
        </div>
    </div>
</div>
<div class="mt-6 flex flex-wrap space-x-0 space-y-2 md:space-x-4 md:space-y-0">
    <div class="flex-1 bg-white p-2 shadow rounded-lg md:w-1/3">
        <h2 class="text-gray-500 text-lg font-semibold pb-1">PKL Mahasiswa</h2>
        <div class="my-0.5"></div> <!-- Espacio de separación -->
        <div class="bg-gradient-to-r from-cyan-300 to-cyan-500 h-px mb-3"></div> <!-- Línea con gradiente -->
        <div class="card" style="width: 250px; height: 250px;">
            <div id="piechartpkl" style="width: 100%; height: 100%;">
                <!-- Your IRS content here -->
            </div>
            <div class="mt-4 mb-4 ml-4">
                <a href=""
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">PKL
                    Mahasiswa</a>
            </div>
        </div>
    </div>
    <div class="flex-1 bg-white p-2 shadow rounded-lg md:w-1/3">
        <h2 class="text-gray-500 text-lg font-semibold pb-1">Skripsi Mahasiswa</h2>
        <div class="my-0.5"></div> <!-- Espacio de separación -->
        <div class="bg-gradient-to-r from-cyan-300 to-cyan-500 h-px mb-3"></div> <!-- Línea con gradiente -->
        <div class="card" style="width: 250px; height: 250px;">
            <div id="piechartskripsi" style="width: 100%; height: 100%;">
                <!-- Your IRS content here -->
            </div>
            <div class="mt-4 mb-4 ml-4">
                <a href=""
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Skripsi
                    Mahasiswa</a>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChartirs);

    function drawChartirs() {

        var data = google.visualization.arrayToDataTable([
            ['Task', 'Hours per Day'],
            ['Belum Disetujui', {{ $irsCountNotVerified }}],
            ['Sudah Disetujui', {{ $irsCountVerified }}],
            ['Belum mengisi', {{ max(0, $irsbelum) }}],
        ]);

        var options = {
            title: 'Data IRS Perwalian'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechartirs'));

        chart.draw(data, options);
    }
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChartkhs);

    function drawChartkhs() {

        var data = google.visualization.arrayToDataTable([
            ['Task', 'Hours per Day'],
            ['Belum Disetujui', {{ $khsCountNotVerified }}],
            ['Sudah Disetujui', {{ $khsCountVerified }}],
            ['Belum mengisi', {{ $khsbelum }}],
        ]);

        var options = {
            title: 'Data KHS Perwalian'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechartkhs'));

        chart.draw(data, options);
    }

    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChartpkl);

    function drawChartpkl() {

        var data = google.visualization.arrayToDataTable([
            ['Task', 'Hours per Day'],
            ['Belum Disetujui', {{ $pklCountNotVerified }}],
            ['Sudah Disetujui', {{ $pklCountVerified }}],
            ['Belum mengisi', {{ $pklbelum }}],
        ]);

        var options = {
            title: 'Data PKL Perwalian'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechartpkl'));

        chart.draw(data, options);
    }

    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChartskripsi);

    function drawChartskripsi() {

        var data = google.visualization.arrayToDataTable([
            ['Task', 'Hours per Day'],
            ['Belum Disetujui', {{ $skripsicountnotverified }}],
            ['Sudah Disetujui', {{ $skripsicountverified }}],
            ['Belum mengisi', {{ $skripsibelum }}],
        ]);

        var options = {
            title: 'Data Skripsi Perwalian'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechartskripsi'));

        chart.draw(data, options);
    }
</script>

@endsection
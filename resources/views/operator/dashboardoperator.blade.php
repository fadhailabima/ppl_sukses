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
<div class="mt-2 flex flex-wrap space-x-0 space-y-2 md:space-x-4 md:space-y-0">
    <!-- Primer contenedor -->
    <!-- Sección 1 - Gráfica de Usuarios -->
    <div class="flex-1 bg-white p-2 shadow rounded-lg md:w-1/3">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Mahasiswa</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $mahasiswa }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Segundo contenedor -->
    <!-- Sección 2 - Gráfica de Comercios -->
    <div class="flex-1 bg-white p-2 shadow rounded-lg md:w-1/3">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Dosen</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $dosen }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="flex-1 bg-white p-2 shadow rounded-lg md:w-1/3">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Department</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $department }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Segundo contenedor -->
    <!-- Sección 2 - Gráfica de Comercios -->
    
</div>
<div class="mt-6 flex flex-wrap space-x-0 space-y-2 md:space-x-4 md:space-y-0">
    <div class="flex-1 bg-white p-2 shadow rounded-lg md:w-1/3">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-h5">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Mahasiswa Aktif</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $useractivecount }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Primer contenedor -->
    <!-- Sección 1 - Gráfica de Usuarios -->
    <div class="flex-1 bg-white p-2 shadow rounded-lg md:w-1/3">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Mahasiswa Mangkir</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $userMangkircount }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Segundo contenedor -->
    <!-- Sección 2 - Gráfica de Comercios -->
    <div class="flex-1 bg-white p-2 shadow rounded-lg md:w-1/3">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                            Mahasiswa Cuti</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $userCuticount }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="flex-1 bg-white p-2 shadow rounded-lg md:w-1/3">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Mahasiswa Lulus</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $userLuluscount }}
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
    <div class="flex-1 bg-white p-2 shadow rounded-lg md:w-1/3">
        <h2 class="text-gray-500 text-lg font-semibold pb-1">Status Mahasiswa</h2>
        <div class="my-0.5"></div> <!-- Espacio de separación -->
        <div class="bg-gradient-to-r from-cyan-300 to-cyan-500 h-px mb-3"></div> <!-- Línea con gradiente -->
        <div class="card" style="width: 250px; height: 250px;">
            <div id="piechart" style="width: 100%; height: 100%;">
                <!-- Your IRS content here -->
            </div>
        </div>
    </div>
    <div class="flex-1 bg-white p-2 shadow rounded-lg md:w-1/3">
        <h2 class="text-gray-500 text-lg font-semibold pb-1">User Level</h2>
        <div class="my-0.5"></div> <!-- Espacio de separación -->
        <div class="bg-gradient-to-r from-cyan-300 to-cyan-500 h-px mb-3"></div> <!-- Línea con gradiente -->
        <div class="card" style="width: 250px; height: 250px;">
            <div id="piechart1" style="width: 100%; height: 100%;">
                <!-- Your IRS content here -->
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

        var data = google.visualization.arrayToDataTable([
            ['User', 'Status'],
            ['Aktif', {{ $useractivecount }}],
            ['Mangkir', {{ $userMangkircount }}],
            ['Cuti', {{ $userCuticount }}],
            ['Lulus', {{ $userLuluscount }}],
        ]);

        var options = {
            title: 'Status Mahasiswa'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
    }

    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart1);

    function drawChart1() {

        var data = google.visualization.arrayToDataTable([
            ['User', 'Level'],
            ['Mahasiswa', {{ $mahasiswa }}],
            ['Dosen', {{ $dosen }}],
            ['Department', {{ $department }}],
            ['Operator', {{ $operator }}],
        ]);

        var options = {
            title: 'User Level'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart1'));

        chart.draw(data, options);
    }
</script>

@endsection
<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Siap Undip</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous">
    </script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    
</head>
<body style="background-color:#bfdeeb">
<div class="flex flex-col h-screen">

    <!-- Barra de navegación superior -->
    <div class="bg-gray-300 text-white shadow w-full p-2 flex items-center justify-between">
        <div class="flex items-center justify-center w-full">
            <div class="flex items-center"> <!-- Mostrado en todos los dispositivos -->
                <img src="https://1.bp.blogspot.com/-tThKR0i2DdQ/XrO4fFiulNI/AAAAAAAAB_s/4_UY2xeR3SsE9_5MGBdvsQtBJgNxf9e_wCLcBGAsYHQ/s1600/Logo%2BUndip%2BUniversitas%2BDiponegoro.png" alt="LogoUNDIP" class="w-16 h-16 mr-2">
                <h2 class="font-bold text-blue-500 text-xl">Sistem Monitoring Mahasiswa<br>UNDIP</h2>
            </div>
        </div>
    </div>

    <!-- Contenido principal -->
    <div class="flex-1 flex flex-wrap">
        <!-- Barra lateral de navegación (oculta en dispositivos pequeños) -->
        <div class="p-2 bg-white w-full md:w-60 flex flex-col md:flex hidden" id="sideNav">
            <nav>
                <div class="block text-gray-500 py-2.5 px-4 my-0.5">
                    @yield('profil')
                </div>
                <div>
                    @yield('sidebar')
                </div>
            </nav>
        </div>

        <!-- Área de contenido principal -->
        <div class="flex-1 p-4 w-full md:w-1/3">
            @yield('konten')
        </div>
    </div>
</div>
</body>
</html>
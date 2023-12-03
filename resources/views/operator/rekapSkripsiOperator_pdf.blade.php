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

<body>
    <style>
        .table-bordered {
            border: 3px solid #dee2e6;
        }

        .table-bordered th,
        .table-bordered td {
            border: 2px solid #dee2e6;
        }
    </style>
    <div class="mt-2 flex flex-wrap space-x-0 space-y-2 md:space-x-4 md:space-y-0">
        <div class="flex-1 bg-white p-2 shadow rounded-lg md:w-1/3">
            <h2 class="text-gray-500 text-lg font-semibold pb-1">Rekap Data Skripsi</h2>
            <div class="my-0.5"></div>
            <div class="bg-gradient-to-r from-cyan-300 to-cyan-500 h-px mb-3"></div>
            <div>
                {{-- <a href="{{ route('rekapSkripsi.pdf') }}"
                    class="text-white bg-blue-500 hover:bg-blue-600 font-medium text-base text-center py-2 px-4 rounded-full"
                    target="_blank">Cetak Rekap</a> --}}
                <table class='table table-bordered'>
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
                                <td class="py-2 font-medium border">Sudah Skripsi</td>
                                <td class="py-2 font-medium border">Belum Skripsi</td>
                            @endfor
                        </tr>
                        <tr class="text-center">
                            @foreach ($tahunRange as $year)
                                <td class="py-2 text-blue-500 font-medium text-base text-center border">
                                    <a href="">{{ $jumlahMahasiswaSkripsi[$year] }}</a>
                                </td>
                                <td class="py-2 text-blue-500 font-medium text-base text-center border">
                                    <a href="">{{ $jumlahMahasiswaBlmSkripsi[$year] }}</a>
                                </td>
                            @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>

</html>

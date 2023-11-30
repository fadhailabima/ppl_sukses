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
            <h2 class="text-gray-500 text-lg font-semibold pb-1">Daftar Mahasiswa Aktif</h2>
            <div class="my-0.5"></div>
            <div class="bg-gradient-to-r from-cyan-300 to-cyan-500 h-px mb-3"></div>
            <div>
                {{-- <a href="/dashboarddepartment/rekapskripsi"
                    class="text-white bg-blue-500 hover:bg-blue-600 font-medium text-base text-center py-2 px-4 rounded-full"
                    target="">Kembali</a>
                <a href="{{ route('listBelumSkripsi.pdf', ['tahun' => $tahun]) }}"
                    class="text-white bg-blue-500 hover:bg-blue-600 font-medium text-base text-center py-2 px-4 rounded-full"
                    target="_blank">
                    Cetak Rekap
                </a> --}}
                <table class='table table-bordered'>
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
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">
                        @foreach ($status as $item)
                            <tr>
                                {{-- <td class="px-4 py-4">{{ $loop->iteration }}</td> --}}
                                <td class="px-4 py-4">{{ $item->nim }}</td>
                                <td class="px-4 py-4">{{ $item->nama }}</td>
                                <td class="px-4 py-4">{{ $item->angkatan }}</td>
                                <td class="px-4 py-4">{{ $item->dosenwali }}</td>
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

</body>

</html>

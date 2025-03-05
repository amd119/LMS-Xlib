<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .center-text {
            text-align: center;
        }
        .table-center {
            margin-left: auto;
            margin-right: auto;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid black;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
    <title>Cetak Data Buku</title>
</head>
<body>
    <div class="center-text">
        <h1>LAPORAN</h1>
        <h2>Xlib</h2>
        <h3>DAFTAR BUKU</h3>
        <hr>
        <table class="table-center">
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Penulis</th>
                <th>Kategori</th>
                <th>Penerbit</th>
                <th>Tahun Terbit</th>
            </tr>
            @foreach ($data as $buku)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $buku->Judul }}</td>
                    <td>{{ $buku->Penulis }}</td>
                    <td>
                        @foreach ($buku->kategori as $kategori)
                            {{ $kategori->NamaKategori }}<br>
                        @endforeach
                    </td>
                    <td>{{ $buku->Penerbit }}</td>
                    <td>{{ $buku->TahunTerbit }}</td>
                </tr>
            @endforeach
        </table>
    </div>
</body>
</html>

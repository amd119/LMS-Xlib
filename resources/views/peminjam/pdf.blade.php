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
        <title>Cetak Data Peminjaman</title>
    </head>

    <body>
        <div class="center-text">
            <h1>LAPORAN</h1>
            <h2>Xlib</h2>
            <h3>DAFTAR PEMINJAMAN</h3>
        </div>
        <hr>
        <table class="table-center">
            <tr>
                <th>No</th>
                <th>Nama Peminjam</th>
                <th>Buku</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
                <th>Status</th>
            </tr>
            @if($laporan)
                @foreach($laporan as $lp)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $lp->user->NamaLengkap }}</td>
                    <td>{{ $lp->buku->Judul }}</td>
                    <td>{{ date('d-m-Y', strtotime($lp->TanggalPeminjaman)) }}</td>
                    @if ($lp->TanggalPengembalian==null)
                        <td>Belum</td>
                        <td>{{ $lp->StatusPeminjaman }}</td>
                    @else
                        <td>{{ date('d-m-Y', strtotime($lp->TanggalPengembalian)) }}</td>
                        <td>{{ $lp->StatusPeminjaman }}</td>
                    @endif
                </tr>
                @endforeach
            @endif
        </table>
    </body>
</html>

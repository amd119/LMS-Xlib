@include('templates.header')
<title>Data Peminjam</title>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('peminjam.cetaklaporan', $sekarang) }}" class="btn btn-warning float-left" target="_blank"><i class="fas fa-print"> Cetak Laporan</a></i>
                </div>
                <table class="table table-bordered">
                    <table class="table table-bordered" id="example">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nama Peminjam</th>
                                <th>Alamat Peminjam</th>
                                <th>Buku Yang di Pinjam</th>
                                <th>Tanggal di Pinjam</th>
                                <th>Tanggal di Kembalikan</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($laporan) > 0)
                                @foreach ($laporan as $peminjam)
                                <tr>
                                    <td>{{ $peminjam->PeminjamanID }}</td>
                                    <td>{{ $peminjam->user->NamaLengkap }}</td>
                                    <td>{{ $peminjam->user->Alamat }}</td>
                                    <td>{{ $peminjam->buku->Judul }}</td>
                                    <td>{{ date('d-m-Y', strtotime($peminjam->TanggalPeminjaman)) }}</td>
                                    <td>{{ $peminjam->TanggalPengembalian ? date('d-m-Y', strtotime($peminjam->TanggalPengembalian)) : 'Belum' }}</td>
                                    <td>{{ $peminjam->StatusPeminjaman }}</td>
                                </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="7" class="text-center">Tidak ada data peminjaman untuk saat ini.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>

                </table>
            </div>
        </div>
    </div>
</div>


@include('templates.footer')



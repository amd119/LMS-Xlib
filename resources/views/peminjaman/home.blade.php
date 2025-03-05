@include('templates.header')
<title>Peminjaman Buku</title>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul Buku</th>
                                <th>Tanggal Peminjaman</th>
                                <th>Tanggal di Kembalikan</th>
                                <th>Status</th>
                                <th>Tindakan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $buku)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $buku->Judul }}</td>
                                    <td>{{ date('d-m-Y', strtotime($buku->TanggalPeminjaman)) }}</td>
                                    <td>{{ $buku->TanggalPengembalian ? date('d-m-Y', strtotime($buku->TanggalPengembalian)) : 'Belum' }}</td>
                                    <td>{{ $buku->StatusPeminjaman }}</td>
                                <td>
                                    @if($buku->StatusPeminjaman === 'Belum di Kembalikan')
                                    <form action="{{ route('peminjaman.kembalikan', $buku->PeminjamanID) }}" method="POST">
                                    @csrf
                                        <input type="hidden" name="TanggalPengembalian" value="{{ now()->format('d-m-Y') }}">
                                        <input type="hidden" name="StatusPeminjaman" value="Sudah di Kembalikan">
                                        <button class="btn btn-info">Kembalikan</button>
                                    </form>
                                    @elseif($buku->StatusPeminjaman === 'Sudah di Kembalikan')
                                            <span class="badge badge-success">Dikembalikan</span>
                                    @endif
                                </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@include('templates.footer')

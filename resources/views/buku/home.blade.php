@include('templates.header')
<title>Data Buku</title>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('buku.cetaklaporan') }}" target="_blank" class="btn btn-success float-left"><i class="fas fa-print"> Cetak Laporan </i></a>
                    <a href="{{ route('buku.create') }}" class="btn btn-primary float-right">Tambah Data</a>
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Cover</th>
                                <th>Judul</th>
                                <th>Penulis</th>
                                <th>Penerbit</th>
                                <th>Tahun Terbit</th>
                                <th>Kategori</th>
                                <th>Tindakan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($data) > 0)
                                @foreach ($data as $buku)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td class="border px-4 py-2 w-20">
                                            <img src="{{ asset('storage/uploads/'.$buku->Cover) }}" style="width: 64px; height: 64px;" />
                                        </td>
                                        <td>{{ $buku->Judul }}</td>
                                        <td>{{ $buku->Penulis }}</td>
                                        <td>{{ $buku->Penerbit }}</td>
                                        <td>{{ $buku->TahunTerbit }}</td>
                                        <td>
                                            @if ($buku->kategori->count() > 0)
                                                @foreach ($buku->kategori as $kategori)
                                                    <span class="badge badge-primary">{{ $kategori->NamaKategori }}</span>
                                                @endforeach
                                            @else
                                                ?
                                            @endif
                                        </td>

                                        <td>
                                            <a href="{{ route('buku.edit', $buku->BukuID) }}" class="btn btn-warning">Edit</a>

                                            <a href="{{ route('buku.delete', $buku->BukuID) }}" class="btn btn-danger" onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this item?')) document.getElementById('delete-buku-form-{{ $buku->BukuID }}').submit();">
                                                Delete
                                            </a>
                                            <form id="delete-buku-form-{{ $buku->BukuID }}" action="{{ route('buku.delete', $buku->BukuID) }}" method="POST" style="display: none;">
                                                @csrf
                                                @method('delete')
                                            </form>

                                            <a href="{{ route('buku.ulasan', $buku->BukuID) }}" class="btn btn-info">Lihat Ulasan</a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="7" class="text-center">Tidak ada data buku untuk saat ini.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@include('templates.footer')

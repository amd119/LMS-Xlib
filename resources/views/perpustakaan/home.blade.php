@include('templates.header')
<title>Buku</title>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul</th>
                                <th>Penulis</th>
                                <th>Penerbit</th>
                                <th>Tahun Terbit</th>
                                <th>Kategori</th>
                                <th>Tindakan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $buku)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $buku->Judul }}</td>
                                    <td>{{ $buku->Penulis }}</td>
                                    <td>{{ $buku->Penerbit }}</td>
                                    <td>{{ $buku->TahunTerbit }}</td>
                                    <td>
                                        @if (is_array($buku->NamaKategori) && count($buku->NamaKategori) > 0)
                                            @foreach ($buku->NamaKategori as $kategori)
                                                <span class="badge badge-primary">{{ $kategori }}</span>
                                            @endforeach
                                        @else
                                            ?
                                        @endif
                                    </td>
                                    <td>

                                        <a href="{{ route('perpustakaan.detailbuku', $buku->BukuID) }}" class="btn btn-info">
                                            Detail
                                        </a>

                                        <a href="{{ route('peminjaman.store') }}" class="btn btn-primary" onclick="event.preventDefault(); document.getElementById('pinjam-form-{{ $buku->BukuID }}').submit();">Pinjam</a>
                                        <form id="pinjam-form-{{ $buku->BukuID }}" action="{{ route('peminjaman.store') }}" method="POST" style="display: none;">
                                            @csrf
                                            <input type="hidden" name="BukuID" value="{{ $buku->BukuID }}">
                                        </form>

                                        <a href="{{ route('koleksi.store') }}" class="btn btn-success" onclick="event.preventDefault(); document.getElementById('koleksi-form-{{ $buku->BukuID }}').submit();">Masukan ke koleksi pribadi</a>
                                        <form id="koleksi-form-{{ $buku->BukuID }}" action="{{ route('koleksi.store') }}" method="POST" style="display: none;">
                                            @csrf
                                            <input type="hidden" name="BukuID" value="{{ $buku->BukuID }}">
                                            <input type="hidden" name="UserID" value="{{ auth()->user()->UserID }}">
                                        </form>

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

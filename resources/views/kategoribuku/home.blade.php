@include('templates.header')
<title>Data Kategori Buku</title>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('kategoribuku.create') }}" class="btn btn-primary float-right">
                    Tambah Kategori
                    </a>
                </div>
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Kategori</th>
                            <th>Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                    @if(count($data) > 0)
                        @foreach ($data as $k)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $k->NamaKategori }}</td>
                                <td>
                                    <a href="{{ route('kategoribuku.edit', $k->KategoriID) }}" class="btn btn-warning">
                                    Edit
                                    </a>
                                    <a href="javascript:void(0)" class="btn btn-danger" onclick="deleteKategori({{ $k->KategoriID }})">
                                        Delete
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="7" class="text-center">Tidak ada data kategori buku untuk saat ini.</td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@include('templates.footer')


<script>
    function deleteKategori(kategoriId) {
        if (confirm('Apakah Anda yakin ingin menghapus kategori ini?')) {
            var url = '{{ route('kategoribuku.delete', ['id' => ':id']) }}';
            url = url.replace(':id', kategoriId);

            fetch(url, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                },
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Kategori berhasil dihapus.');
                    window.location.reload();
                } else {
                    alert('Gagal menghapus kategori.');
                }
            })
        }
    }
</script>

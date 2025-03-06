@include('templates.header')
<title>Data Kategori Buku</title>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('kategoribuku.create') }}" class="btn btn-primary float-right">Tambah Kategori</a>
                </div>
                <div class="card-body">
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
                                <td colspan="7" class="text-center">Kategori buku belum ditambahkan.</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- confirm delete kategori -->
<script>
    function deleteKategori(kategoriId) {
        Swal.fire({
            title: "Apakah Anda yakin?",
            text: "Kategori akan dihapus secara permanen!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, hapus!"
        }).then((result) => {
            if (result.isConfirmed) {
                var url = '{{ route('kategoribuku.delete', ['id' => ':id']) }}'.replace(':id', kategoriId);

                fetch(url, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data); // Debugging
                    if (data.success) {
                        Swal.fire("Deleted!", "Kategori berhasil dihapus.", "success").then(() => {
                            window.location.reload();
                        });
                    } else {
                        Swal.fire("Error!", "Gagal menghapus kategori.", "error");
                    }
                })
                .catch(error => console.error('Error:', error));
            }
        });
    }
</script>

@include('templates.footer')

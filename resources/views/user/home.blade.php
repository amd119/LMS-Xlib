@include('templates.header')
<title>Data User</title>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('user.create') }}" class="btn btn-primary float-right">Tambah Data Petugas</a>
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Lengkap</th>
                                <th>Email</th>
                                <th>Alamat</th>
                                <th>Role</th>
                                <th>Tindakan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $user)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $user['NamaLengkap'] }}</td>
                                    <td>{{ $user['email'] }}</td>
                                    <td>{{ $user['Alamat'] }}</td>
                                    <td>{{ $user['Role'] }}</td>
                                    <td>
                                        @if($user['Role'] === 'Petugas')
                                            <a href="{{ route('user.edit', $user['UserID']) }}" class="btn btn-warning">
                                                Edit
                                            </a>
                                        @endif

                                        @if($user['Role'] !== 'Administrator')
                                            <a href="javascript:void(0)" class="btn btn-danger" onclick="deleteUser({{ $user['UserID'] }})">
                                                Delete
                                            </a>
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


<!-- confirm delete user -->
<script>
    function deleteUser(userId) {
        Swal.fire({
            title: "Apakah Anda yakin?",
            text: "User akan dihapus secara permanen!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, hapus!"
        }).then((result) => {
            if (result.isConfirmed) {
                var url = '{{ route('user.delete', ['id' => ':id']) }}'.replace(':id', userId);

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
                        Swal.fire("Deleted!", "User berhasil dihapus.", "success").then(() => {
                            window.location.reload();
                        });
                    } else {
                        Swal.fire("Error!", "Gagal menghapus user.", "error");
                    }
                })
                .catch(error => console.error('Error:', error));
            }
        });
    }
</script>

@include('templates.footer')

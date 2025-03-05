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
                                            <a href="{{ route('user.delete', $user['UserID']) }}" class="btn btn-danger" onclick="event.preventDefault(); document.getElementById('delete-user-form-{{ $user->id }}').submit();">
                                                Delete
                                            </a>

                                            <form id="delete-user-form-{{ $user->id }}" action="{{ route('user.delete', $user['UserID']) }}" method="POST" style="display: none;">
                                                @csrf
                                                @method('delete')
                                            </form>
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

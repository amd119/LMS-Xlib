@include('templates.header')
<title>Koleksi Buku</title>

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
                                <th>Penulis</th>
                                <th>Penerbit</th>
                                <th>Tindakan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $koleksi)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $koleksi->buku->Judul }}</td>
                                <td>{{ $koleksi->buku->Penulis }}</td>
                                <td>{{ $koleksi->buku->Penerbit }}</td>
                                <td>
                                    <a href="{{ route('koleksi.delete', $koleksi->KoleksiID) }}" class="btn btn-danger" onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this item?')) document.getElementById('delete-koleksi-form-{{ $koleksi->KoleksiID }}').submit();">
                                        Delete
                                    </a>
                                    <form id="delete-koleksi-form-{{ $koleksi->KoleksiID }}" action="{{ route('koleksi.delete', $koleksi->KoleksiID) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('delete')
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

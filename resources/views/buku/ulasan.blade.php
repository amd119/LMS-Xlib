@include('templates.header')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <h3 class="profile-username text-center">{{ $buku->Judul }}</h3>
                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b>Penulis</b>
                            <label class="badge badge-info float-right">{{ $buku->Penulis }}</label>
                        </li>
                        <li class="list-group-item">
                            <b>Penerbit</b>
                            <label class="badge badge-info float-right">{{ $buku->Penerbit }}</label>
                        </li>
                        <li class="list-group-item">
                            <b>TahunTerbit</b>
                            <label class="badge badge-info float-right">{{ $buku->TahunTerbit }}</label>
                        </li>
                        <a href="{{ route('buku.home') }}" class="btn btn-outline-danger btn-block">
                            <b>Kembali</b>
                        </a>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h4>Ulasan</h4>
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Ulasan</th>
                                <th>Rating</th>
                                <th>Pemberi Ulasan</th>
                                <th>Tindakan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ulasan as $review)
                                <tr>
                                    <td>{{ $review->Ulasan }}</td>
                                    <td>{{ $review->Rating }}</td>
                                    <td>{{ $review->user->NamaLengkap }}</td>
                                    <td>
                                        <a href="#" class="btn btn-danger btn-sm" onclick="event.preventDefault(); document.getElementById('delete-ulasan-form-{{ $review->UlasanID }}').submit();">
                                            Hapus
                                        </a>
                                        <form id="delete-ulasan-form-{{ $review->UlasanID }}" action="{{ route('buku.ulasandelete', $review->UlasanID) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
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

@include('templates.header')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            <div class="card card-primary">
                <div class="card-body">
                    <form action="{{ route('perpustakaan.ulasanstore') }}" method="post">
                        @csrf
                        <input type="hidden" name="UserID" value="{{ auth()->user()->UserID }}">
                        @if (isset($data['buku']) && $data['buku'] != null)
                            <input type="hidden" name="BukuID" value="{{ $data['buku']->BukuID }}">
                        @endif
                        <div class="form-group">
                            <label for="Judul">Judul Buku</label>
                            <input type="text" id="Judul" class="form-control" value="{{ $data['buku']->Judul }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="Penulis">Penulis</label>
                            <input type="text" id="Penulis" class="form-control" value="{{ $data['buku']->Penulis }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="Ulasan">Ulasan</label>
                            <input type="text" id="Ulasan" name="Ulasan" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="Rating">Rating</label>
                            <select name="Rating" id="Rating" class="form-control">
                                <option value="5">5</option>
                                <option value="4">4</option>
                                <option value="3">3</option>
                                <option value="2">2</option>
                                <option value="1">1</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <a href="{{ route('perpustakaan.detailbuku', $data['buku']->BukuID) }}" class="btn btn-danger">Batal</a>
                            <button type="submit" class="btn btn-primary float-right">Tambah Ulasan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@include('templates.footer')

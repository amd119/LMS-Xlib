<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/simpan.css') }}">
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.js"></script>
</head>

<body>
@include('templates.header')
    <div class="col-md-6">
        <div class="card card-primary">
            <div class="ui container">
                <form action="{{ route('buku.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="Cover">Tambahkan Cover</label>
                        <input type="file" name="Cover" id="Cover" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="KategoriID">Kategori</label>
                        <select id="KategoriID" name="KategoriID[]" class="ui fluid search dropdown" multiple="" required>
                            <option value="">Pilih Kategori</option>
                            @foreach ($data as $k)
                                <option value="{{ $k->KategoriID }}">{{ $k->NamaKategori }}</option>
                            @endforeach
                        </select>
                        <small class="form-text text-muted">Pilih maksimal 4 kategori</small>
                    </div>
                    <div class="form-group">
                        <label for="Judul">Judul</label>
                        <input type="text" id="Judul" name="Judul" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="Deskripsi">Deskripsi</label>
                        <input type="text" id="Deskripsi" name="Deskripsi" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="Penulis">Penulis</label>
                        <input type="text" id="Penulis" name="Penulis" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="Penerbit">Penerbit</label>
                        <input type="text" id="Penerbit" name="Penerbit" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="TahunTerbit">TahunTerbit</label>
                        <input type="number" id="TahunTerbit" name="TahunTerbit" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <a href="{{ route('buku.home') }}" class="btn btn-outline-danger">Batal</a>
                        <button type="submit" class="btn btn-outline-primary float-right">Tambah Data</button>
                    </div>
                </form>
            </div>
            <script>
                $('.ui.dropdown').dropdown();
            </script>
        </div>
    </div>
</body>

</html>

@include('templates.footer')

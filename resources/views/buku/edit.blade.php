<!DOCTYPE html>
<html lang="en">
<head>
    <link href=
"https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css"
          rel="stylesheet" />
    <script src=
"https://code.jquery.com/jquery-3.1.1.min.js">
    </script>
    <script src=
"https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.js">
    </script>
</head>
<body>
@include('templates.header')
    <div class="col-md-6">
        <div class="card card-primary">
            <div class="ui container">
                @if(isset($buku))
                    <form action="{{ route('buku.update', $buku->BukuID) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                            <div class="form-group">
                                <label for="Cover">Edit Cover</label>
                                <img src="{{ asset('storage/uploads/' . $buku->Cover) }}" alt="Cover" class="img-thumbnail mb-2">
                                <input type="file" name="Cover" id="Cover" class="form-control">
                                {{-- <small class="form-text text-muted">Biarkan tidak terganti.</small> --}}
                            </div>
                            <div class="form-group">
                                <label for="KategoriID">Kategori</label>
                                <select id="KategoriID" name="KategoriID[]" class="ui fluid search dropdown" multiple required>
                                    @foreach($data as $kategori)
                                        <option value="{{ $kategori->KategoriID }}" @if(in_array($kategori->KategoriID, $buku->kategori->pluck('KategoriID')->toArray())) selected @endif>
                                            {{ $kategori->NamaKategori }}
                                        </option>
                                    @endforeach
                                </select>
                                <small class="form-text text-muted">Pilih kategori buku</small>
                            </div>
                            <div class="form-group">
                                <label for="Judul">Judul</label>
                                <input type="text" id="Judul" name="Judul" class="form-control" value="{{ old('Judul', $buku['Judul']) }}" required>
                            </div>
                            <div class="form-group">
                                <label for="Deskripsi">Deskripsi</label>
                                <input type="text" id="Deskripsi" name="Deskripsi" class="form-control" value="{{ old('Deskripsi', $buku['Deskripsi']) }}" required>
                            </div>
                            <div class="form-group">
                                <label for="Penulis">Penulis</label>
                                <input type="text" id="Penulis" name="Penulis" class="form-control" value="{{ old('Penulis', $buku['Penulis']) }}" required>
                            </div>
                            <div class="form-group">
                                <label for="Penerbit">Penerbit</label>
                                <input type="text" id="Penerbit" name="Penerbit" class="form-control" value="{{ old('Penerbit', $buku['Penerbit']) }}" required>
                            </div>
                            <div class="form-group">
                                <label for="TahunTerbit">Tahun Terbit</label>
                                <input type="number" id="TahunTerbit" name="TahunTerbit" class="form-control" value="{{ old('TahunTerbit', $buku['TahunTerbit']) }}" required>
                            </div>
                            <div class="form-group">
                                <a href="{{ route('buku.home') }}" class="btn btn-outline-danger">Batal</a>
                                <button type="submit" class="btn btn-outline-primary float-right">Edit Data</button>
                            </div>
                    </form>
                @else
                    <p>Data not available.</p>
                @endif
            </div>
            <script>
                $('.ui.dropdown').dropdown();
            </script>
        </div>
    </div>
</body>
</html>

@include('templates.footer')

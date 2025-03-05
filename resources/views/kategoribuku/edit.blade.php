@include('templates.header')

<div class="col-md-6">
    <div class="card card-primary">
        <div class="card-body">
            @if(isset($data))
            <form action="{{ route('kategoribuku.update', $data->KategoriID) }}" method="POST">
                @csrf
                @method('PUT')
                    <div class="form-group">
                        <label for="NamaKategori">Nama Kategori</label>
                        <input type="text" id="NamaKategori" name="NamaKategori" class="form-control" value="{{ old('NamaKategori', $data['NamaKategori']) }}" required>
                    </div>

                    <div class="form-group">
                        <a href="{{ route('kategoribuku.home') }}" class="btn btn-outline-danger">Batal</a>
                        <button type="submit" class="btn btn-outline-primary float-right">Edit Data</button>
                    </div>
            </form>
            @else
                <p>Data not available.</p>
            @endif
        </div>
    </div>
</div>

@include('templates.footer')

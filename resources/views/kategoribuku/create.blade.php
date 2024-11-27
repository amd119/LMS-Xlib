@include('templates.header')
<div class="col-md-6">
  <div class="card card-primary">
    <div class="card-body">
      <form action="{{ route('kategoribuku.store') }}" method="POST">
        @csrf
        <div class="form-group">
          <label for="NamaKategori">Nama Kategori</label>
          <input type="text" id="NamaKategori" name="NamaKategori" class="form-control" required>
        </div>

        <div class="form-group">
          <a href="{{ route('kategoribuku.home') }}" class="btn btn-outline-danger">Batal</a>
          <button type="submit" class="btn btn-outline-primary float-right">Tambah Data</button>
        </div>
      </form>
    </div>
  </div>
</div>
@include('templates.footer')

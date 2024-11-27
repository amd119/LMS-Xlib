@include('templates.header')

<title>Edit User</title>
<div class="col-md-6">
    <div class="card card-primary">
        <div class="card-body">
            @if(isset($user))
                <form action="{{ route('user.update', $user->UserID) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" class="form-control" value="{{ old('username', $user->username) }}">
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="NamaLengkap">Nama Lengkap</label>
                        <input type="text" id="NamaLengkap" name="NamaLengkap" class="form-control" value="{{ old('NamaLengkap', $user->NamaLengkap) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="Alamat">Alamat</label>
                        <input type="text" id="Alamat" name="Alamat" class="form-control" value="{{ old('Alamat', $user->Alamat) }}" required>
                    </div>

                    <div class="form-group">
                        <a href="{{ route('user.home') }}" class="btn btn-outline-danger">Batal</a>
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

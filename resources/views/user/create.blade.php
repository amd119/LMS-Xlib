@include('templates.header')

<div class="col-md-6">
  <div class="card card-primary">
    <div class="card-body">
      <form action="{{ route('user.store') }}" method="POST">
        @csrf
        <div>
            <x-input-label for="username" :value="__('Username')" />
            <x-text-input id="username" class="block mt-1 w-full" type="text" name="username" :value="old('username')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('username')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="NamaLengkap" :value="__('Nama Lengkap')" />
            <x-text-input id="NamaLengkap" class="block mt-1 w-full" type="text" name="NamaLengkap" :value="old('NamaLengkap')" required autofocus autocomplete="Username" />
            <x-input-error :messages="$errors->get('NamaLengkap')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="Alamat" :value="__('Alamat')" />
            <x-text-input id="Alamat" class="block mt-1 w-full" type="text" name="Alamat" :value="old('Alamat')" required autocomplete="Username" />
            <x-input-error :messages="$errors->get('Alamat')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="form-group mt-3">
          <a href="{{ route('user.home') }}" class="btn btn-outline-danger">Batal</a>
          <button type="submit" class="btn btn-outline-primary float-right">Tambah Data</button>
        </div>
      </form>
    </div>
  </div>
</div>
@include ('templates.footer')

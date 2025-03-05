<title>Register</title>
<x-guest-layout>
    <div class="flex flex-col sm:justify-center items-center bg-gray-10">
        <a href="/">
            <x-b-book class=" text-neutral-700" alt="PerpusLogo" class="w-20 h-20 fill-current text-gray-500" style="opacity: .8" svg="blue-book"/>
        </a>
    </div>
    <title>Register</title>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Username -->
        <div>
            <x-input-label for="username" :value="__('Username')" />
            <x-text-input id="username" class="block mt-1 w-full" type="text" name="username" :value="old('username')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('username')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Nama Lengkap -->
        <div>
            <x-input-label for="NamaLengkap" :value="__('Nama Lengkap')" />
            <x-text-input id="NamaLengkap" class="block mt-1 w-full" type="text" name="NamaLengkap" :value="old('NamaLengkap')" required autofocus autocomplete="Username" />
            <x-input-error :messages="$errors->get('NamaLengkap')" class="mt-2" />
        </div>

        <!-- Alamat -->
        <div class="mt-4">
            <x-input-label for="Alamat" :value="__('Alamat')" />
            <x-text-input id="Alamat" class="block mt-1 w-full" type="text" name="Alamat" :value="old('Alamat')" required autocomplete="Username" />
            <x-input-error :messages="$errors->get('Alamat')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>

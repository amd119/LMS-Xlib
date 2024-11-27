<title>Koleksi Buku</title>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Koleksi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-4 md:gap-8 md:grid-cols-2 xl:grid-cols-3">
                @if (count($koleksiPribadi) === 0)
                    <p class="text-gray-500">Data Koleksi tidak Tersedia</p>
                @else
                    @foreach ($koleksiPribadi as $koleksi)
                        <div class="bg-white dark:bg-gray-800 shadow px-5 py-6 rounded-lg cursor-pointer relative">
                            <a>
                                <img class="object-cover object-center w-full h-64 rounded-lg lg:h-70" src="{{ asset('storage/uploads/' . $koleksi->buku->Cover) }}" alt="{{ $koleksi->buku->Judul }}">
                            </a>
                            <div class="mt-8">
                                <h3 class="mt-2 text-xl font-semibold text-gray-800 dark:text-gray-200">
                                    {{ $koleksi->buku->Judul }}
                                </h3>
                                <p class="text-gray-500 dark:text-gray-200">{{ $koleksi->buku->Penulis }}</p>
                                <p class="mt-2 text-gray-500 dark:text-gray-300 truncate">
                                    <span class="text-gray-400 font-semibold">Book Description<br></span>
                                    {{ $koleksi->buku->Deskripsi }}
                                </p>
                                <form action="{{ route('koleksihapus', $koleksi->KoleksiID) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" title="Hapus Koleksi" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ulasan Buku') }}
        </h2>
    </x-slot>

    <div class="grid grid-cols-1 gap-4 md:gap-8 md:grid-cols-1 xl:grid-cols-1">
        @if (!is_null($data) && count($data) > 0)
            @foreach ($data as $ulasan)
                <a href="{{ route('detail', $ulasan->buku->BukuID) }}" class="bg-white dark:bg-gray-800 shadow px-5 py-6 rounded-lg cursor-pointer relative">
                    <span class="absolute bg-blue-200 top-3 px-2 text-blue-600 rounded-lg">Tap to see details</span>
                    <img class="object-cover object-center w-full h-64 rounded-lg lg:h-70" src="{{ isset($ulasan->buku->Cover) ? asset('storage/uploads/' . $ulasan->buku->Cover) : 'default-image-path' }}" alt="{{ $ulasan->buku->Judul }}">
                    <div class="mt-8">
                        @foreach ($ulasan->buku->NamaKategori as $kategori)
                            <div class="center relative inline-block select-none whitespace-nowrap rounded-lg bg-yellow-600 py-2 px-3.5 align-baseline font-sans text-xs font-bold uppercase leading-none text-white">
                                <div class="mt-px">{{ $kategori }}</div>
                            </div>
                        @endforeach
                        <h3 class="mt-2 text-xl font-semibold text-gray-800 dark:text-gray-200">{{ $ulasan->buku->Judul }}</h3>
                        <p class="text-gray-500 dark:text-gray-200">{{ $ulasan->buku->Penulis }}</p>
                        <p class="mt-2 text-gray-500 dark:text-gray-300 truncate">
                            <span class="text-gray-400 font-semibold">Rating Buku<br></span>
                            {{ $ulasan->Rating }}
                        </p>
                        <p class="mt-2 text-gray-500 dark:text-gray-300 truncate">
                            <span class="text-gray-400 font-semibold">Ulasan<br></span>
                            {{ $ulasan->Ulasan }}
                        </p>
                    </div>
                </a>
            @endforeach
        @else
            <p class="text-gray-500">Belum ada ulasan yang ditambahkan.</p>
        @endif
    </div>
</x-app-layout>

<title>Cari Buku</title>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Cari Buku') }}
        </h2>
    </x-slot>

    <div class="px-6 py-10 mx-auto max-w-screen-xl">
        <form action="{{ route('perpustakaan.search') }}" method="GET">
            <div class="flex justify-between mb-4 flex-col md:flex-row gap-3">
                <div class="relative">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                    </div>
                    <div class="wrap">
                        <input type="text" name="searchTerm" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Cari Buku" value="{{ request('searchTerm') }}" required />
                        <button type="submit" class="text-white absolute end-2.5 bottom-2.5 bg-blue-500 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-500 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
                    </div>
                </div>
            </div>
        </form>

        <div class="grid grid-cols-1 gap-4 md:gap-8 md:grid-cols-2 xl:grid-cols-3">
            @if (count($data) === 0)
                <p class="text-gray-500">Data Buku tidak Tersedia</p>
            @else
                @foreach ($data as $book)
                    <a href="{{ route('detail', $book->BukuID) }}" class="bg-white dark:bg-gray-800 shadow px-5 py-6 rounded-lg cursor-pointer relative">
                        <span class="absolute bg-blue-200 top-3 px-2 text-blue-600 rounded-lg">Tap untuk melihat detail buku</span>
                        <img class="object-cover object-center w-full h-64 rounded-lg lg:h-70" src="{{ isset($book->Cover) ? asset('storage/uploads/'.$book->Cover) : 'default-image-path' }}" alt="{{ $book->Judul }}">
                        <div class="mt-8">
                            @foreach ($book->NamaKategori as $kategori)
                                <div class="center relative inline-block select-none whitespace-nowrap rounded-lg bg-yellow-600 mb-1 py-2 px-3.5 align-baseline font-sans text-xs font-bold uppercase leading-none text-white">
                                    <div class="mt-px">{{ $kategori }}</div>
                                </div>
                            @endforeach
                            <h3 class="mt-2 text-xl font-semibold text-gray-800 dark:text-gray-200">{{ $book->Judul }}</h3>
                            <p class="text-gray-500 dark:text-gray-200">{{ $book->Penulis }}</p>
                            <p class="mt-2 text-gray-500 dark:text-gray-300 truncate">
                                <span class="text-gray-400 font-semibold">Book Description<br></span>
                                {{ $book->Deskripsi }}
                            </p>
                        </div>
                    </a>
                @endforeach
            @endif
        </div>
</x-app-layout>

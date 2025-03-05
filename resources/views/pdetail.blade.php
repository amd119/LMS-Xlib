<title>Detail Buku Pinjaman</title>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detail Pinjaman Buku') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <nav class="flex mb-4" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('pinjaman') }}" class="text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                            {{ __('Pinjaman') }}
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400">
                                {{ __('Detail Pinjaman Buku') }}
                            </span>
                        </div>
                    </li>
                </ol>
            </nav>

            <div class="grid grid-cols-1 sm:grid-cols-12 gap-5 bg-white dark:bg-gray-800 p-4 shadow rounded-md">
                <div class="relative sm:col-span-4">
                    <img class="rounded-lg shadow w-full" src="{{ isset($book->Cover) ? asset('storage/uploads/'.$book->Cover) : 'default-image-path' }}" alt="{{ $book->Judul }}">
                </div>
                <div class="justify-center sm:col-span-7">
                    @foreach ($book->kategori as $kategori)
                        <div class="center relative inline-block select-none whitespace-nowrap mb-1 rounded-lg bg-yellow-600 py-2 px-3.5 align-baseline font-sans text-xs font-bold uppercase leading-none text-white">
                            <div class="mt-px">{{ $kategori->NamaKategori }}</div>
                        </div>
                    @endforeach
                    <h2 class="text-3xl mt-3 font-semibold text-gray-800 dark:text-gray-200">
                        {{ $book->Judul }}
                    </h2>
                    <p class="text-gray-500 dark:text-gray-400 mb-2">
                        {{ $book->Penulis }}
                    </p>
                    <p class="text-gray-700 dark:text-gray-300 mb-36 text-justify">
                        {{ $book->Deskripsi }}
                    </p>
                    <div>
                        @if ($peminjaman)
                        <span class="text-sm inline-flex font-normal bg-gray-400 py-2 px-5 rounded-lg text-white">Dipinjam pada {{ $peminjaman->TanggalPeminjaman }}</span>
                            @if ($peminjaman->TanggalPengembalian == null)
                                <form action="{{ route('kembalikan', $peminjaman->PeminjamanID) }}" method="POST">
                                    @csrf
                                    <button type="submit" title="Kembalikan Buku" class="bg-blue-500 hover:bg-blue-400 text-white font-bold py-3 px-5 mb-1 mt-2 rounded">
                                        {{ __('Kembalikan') }}
                                    </button>
                                </form>
                            @else
                                <span class="text-sm inline-flex font-normal bg-green-600 py-2 px-5 rounded-lg text-white">Dikembalikan pada {{ $peminjaman->TanggalPengembalian }}</span>
                            @endif
                        @else
                            <span class="text-sm font-normal bg-yellow-400 py-1 px-3 rounded-lg text-white">Buku belum dipinjam</span>
                        @endif
                        <input type="hidden" name="BukuID" value="{{ $book->BukuID }}">
                        <div x-data="{ openCreateModal: false, openEditModal: false, openDeleteModal: false }">
                            <div>
                                @php
                                    $userUlasan = $book->ulasan->where('UserID', Auth::user()->UserID)->first();
                                @endphp
                                @if (!$userUlasan)
                                    <button @click.prevent="openCreateModal = true" title="Berikan Ulasan" class="block text-white bg-orange-600 hover:bg-orange-500 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-3 mt-4 text-center dark:bg-orange-600 dark:hover:bg-orange-700 dark:focus:ring-orange-800" type="button">
                                        {{ __('Ulasan') }}
                                    </button>
                                @else
                                    <div class="gap-3 py-6 sm:flex sm:items-start" data-rating="{{ $userUlasan->Rating }}">
                                        <x-optionsdd width="40">
                                            <x-slot name="trigger">
                                                <div class="text-gray-500 hover:text-gray-700 focus:outline-none">
                                                    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"></path>
                                                    </svg>
                                                </div>
                                            </x-slot>
                                            <x-slot name="content">
                                                <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="options-dropdown">
                                                    <li>
                                                        <a class="block cursor-pointer py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" @click.prevent="openEditModal = true">{{ __('Edit') }}</a>
                                                    </li>
                                                    <li>
                                                        <a class="block cursor-pointer py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" @click.prevent="openDeleteModal = true">{{ __('Hapus') }}</a>
                                                    </li>
                                                </ul>
                                            </x-slot>
                                        </x-optionsdd>
                                        <div class="shrink-0 space-y-2 sm:w-48 md:w-72">
                                            <div class="flex items-center gap-0.5">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    @if ($i <= $userUlasan->Rating)
                                                        <svg class="h-4 w-4 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                                            <path d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z" />
                                                        </svg>
                                                    @else
                                                        <svg class="h-4 w-4 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                                            <path d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z" />
                                                        </svg>
                                                    @endif
                                                @endfor
                                            </div>
                                            <div class="space-y-0.5">
                                                <p class="text-base font-semibold text-gray-900 dark:text-white">{{ $userUlasan->user->username }}</p>
                                                <p class="text-sm font-normal text-gray-500 dark:text-gray-400">{{ $userUlasan->created_at->format('F j, Y') }}</p>
                                            </div>
                                        </div>
                                        <div class="mt-4 min-w-0 flex-1 space-y-4 sm:mt-0">
                                            <p class="text-base font-normal text-gray-500 dark:text-gray-400">{{ $userUlasan->Ulasan }}</p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <!-- Edit Ulasan Modal -->
                            <div x-cloak x-show="openEditModal" aria-modal="true" role="dialog" aria-hidden="true" aria-labelledby="modal-title" class="fixed inset-0 z-50 overflow-y-auto">
                                <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                                    <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                                    <div x-cloak @click.away="openEditModal = false" x-show="openEditModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="inline-block px-4 pt-5 pb-4 overflow-hidden text-left align-bottom transition-all transform bg-gray-300 dark:bg-gray-600 rounded-lg shadow-xl sm:my-8 sm:align-middle sm:max-w-md sm:w-full sm:p-6" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                                        <!-- Modal content -->
                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                            <!-- Modal header -->
                                            <div class="flex justify-between items-start p-4 rounded-t border-b border-gray-300 dark:border-gray-600">
                                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                    Edit Ulasan
                                                </h3>
                                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" @click.prevent="openEditModal = false">
                                                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                                    <span class="sr-only">Close modal</span>
                                                </button>
                                            </div>
                                            <!-- Modal body -->
                                            <div class="p-6 space-y-8">
                                                @if ($userUlasan)
                                                <form action="{{ route('ulasan.update', $userUlasan->UlasanID) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="BukuID" value="{{ $book->BukuID }}">
                                                    <span class="ml-3 text-sm text-indigo-500">Rating</span>
                                                    <div class="col-span-1 ml-2 mb-8 sm:col-span-1">
                                                        <div class="flex flex-row-reverse justify-end items-center">
                                                            @foreach(range(5, 1) as $rating)
                                                                <input id="rating-{{ $rating }}" type="radio" name="Rating" value="{{ $rating }}" {{ old('Rating') == $rating ? 'checked' : '' }} class="peer -ms-5 size-5 bg-transparent border-0 text-transparent cursor-pointer appearance-none checked:bg-none focus:bg-none focus:ring-0 focus:ring-offset-0">
                                                                <label for="rating-{{ $rating }}" class="peer-checked:text-yellow-400 text-gray-300 pointer-events-none dark:peer-checked:text-yellow-500 dark:text-neutral-400">
                                                                    <svg class="flex-shrink-0 size-5" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                                                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"></path>
                                                                    </svg>
                                                                </label>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                    <div class="relative mb-3 col-span-2">
                                                        <textarea id="Ulasan" name="Ulasan" class="peer h-32 w-full resize-none rounded border border-gray-400 bg-gray-500 dark:border-gray-700 dark:bg-gray-800 bg-opacity-40 py-1 px-3 text-base leading-6 text-gray-700 focus:text-gray-100 placeholder-transparent outline-none transition-colors duration-200 ease-in-out focus:border-indigo-500 dark:focus:bg-gray-700 focus:bg-gray-400 focus:ring-2 focus:ring-indigo-900" placeholder="Ulasan" required>{{ $userUlasan?->Ulasan ?? 'Tidak ada ulasan' }}</textarea>
                                                        <label for="Ulasan" class="absolute left-3 -top-6 bg-transparent text-sm leading-7 text-indigo-500 transition-all peer-placeholder-shown:left-3 peer-placeholder-shown:top-2 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-500 peer-focus:left-3 peer-focus:-top-6 peer-focus:text-sm peer-focus:text-indigo-500">Ulasan</label>
                                                    </div>
                                                    <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                                        Simpan Perubahan
                                                    </button>
                                                </form>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Delete Ulasan Modal -->
                            <div x-cloak x-show="openDeleteModal" aria-modal="true" role="dialog" aria-hidden="true" aria-labelledby="modal-title" class="fixed inset-0 z-50 overflow-y-auto">
                                <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                                    <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                                    <div x-cloak @click.away="openDeleteModal = false" x-show="openDeleteModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="inline-block px-4 pt-5 pb-4 overflow-hidden text-left align-bottom transition-all transform bg-gray-300 dark:bg-gray-600 rounded-lg shadow-xl sm:my-8 sm:align-middle sm:max-w-md sm:w-full sm:p-6" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                                        <!-- Modal content -->
                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                            <!-- Modal header -->
                                            <div class="flex justify-between items-start p-4 rounded-t border-b dark:border-gray-600">
                                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                    Hapus Ulasan
                                                </h3>
                                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" @click="openDeleteModal = false">
                                                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                                    <span class="sr-only">Close modal</span>
                                                </button>
                                            </div>
                                            <!-- Modal body -->
                                            <div class="p-6 space-y-6">
                                                <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                                                    Apakah Anda yakin ingin menghapus ulasan ini?
                                                </p>
                                                @if ($userUlasan)
                                                    <form action="{{ route('ulasan.delete', $userUlasan->UlasanID) }}" method="POST">
                                                @endif
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                                                        Ya, Hapus
                                                    </button>
                                                    <button @click.prevent="openDeleteModal = false" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Batal</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Create Ulasan Modal -->
                            <div x-show="openCreateModal" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                                <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                                    <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                                    <div x-cloak @click.away="openCreateModal = false" x-show="openCreateModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="inline-block px-4 pt-5 pb-4 overflow-hidden text-left align-bottom transition-all transform bg-white dark:bg-gray-600 rounded-lg shadow-xl sm:my-8 sm:align-middle sm:max-w-md sm:w-full sm:p-6" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                                        <!-- Modal content -->
                                        <div>
                                            <div class="mt-3 text-center sm:mt-2">
                                                <!-- Modal header -->
                                                <div class="flex items-center justify-between p-4 md:p-2 border-b rounded-t dark:border-gray-600">
                                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                        Ulasan
                                                    </h3>
                                                    <button @click="openCreateModal = false" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="crud-modal">
                                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                        </svg>
                                                        <span class="sr-only">Close modal</span>
                                                    </button>
                                                </div>
                                                <!-- Modal body -->
                                                <div class="mt-11">
                                                    <form action="{{ route('ulasan.store') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="BukuID" value="{{ $book->BukuID }}">
                                                        <div class="relative col-span-2 sm:col-span-1 mb-6">
                                                            <input type="text" id="Judul" name="Judul" class="peer w-full rounded border border-gray-700 bg-gray-500 bg-opacity-40 py-1 px-3 text-base leading-8 text-gray-700 placeholder-transparent outline-none transition-colors duration-200 ease-in-out focus:border-indigo-500 focus:bg-gray-400 focus:ring-2 focus:ring-indigo-900" placeholder="Judul Buku" value="{{ $book->Judul }}" readonly />
                                                            <label for="Judul" class="absolute left-3 -top-6 bg-transparent text-sm leading-7 text-indigo-500 transition-all peer-placeholder-shown:left-3 peer-placeholder-shown:top-2 peer-placeholder-shown:bg-gray-900 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-500 peer-focus:left-3 peer-focus:-top-6 peer-focus:text-sm peer-focus:text-indigo-500">Judul Buku</label>
                                                        </div>
                                                        <div class="relative col-span-2 sm:col-span-1 mb-4">
                                                            <input type="text" id="Penulis" name="Penulis" class="peer w-full rounded border border-gray-700 bg-gray-500 bg-opacity-40 py-1 px-3 text-base leading-8 text-gray-700 placeholder-transparent outline-none transition-colors duration-200 ease-in-out focus:border-indigo-500 focus:bg-gray-400 focus:ring-2 focus:ring-indigo-900" placeholder="Penulis Buku" value="{{ $book->Penulis }}" readonly />
                                                            <label for="Penulis" class="absolute left-3 -top-6 bg-transparent text-sm leading-7 text-indigo-500 transition-all peer-placeholder-shown:left-3 peer-placeholder-shown:top-2 peer-placeholder-shown:bg-gray-900 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-500 peer-focus:left-3 peer-focus:-top-6 peer-focus:text-sm peer-focus:text-indigo-500">Penulis Buku</label>
                                                        </div>
                                                        <div class="col-span-1 sm:col-span-1 mb-8">
                                                            <div class="flex flex-row-reverse justify-end items-center">
                                                                @foreach(range(5, 1) as $rating)
                                                                    <input id="rating-{{ $rating }}" type="radio" name="Rating" value="{{ $rating }}" {{ old('Rating') == $rating ? 'checked' : '' }} class="peer -ms-5 size-5 bg-transparent border-0 text-transparent cursor-pointer appearance-none checked:bg-none focus:bg-none focus:ring-0 focus:ring-offset-0">
                                                                    <label for="rating-{{ $rating }}" class="peer-checked:text-yellow-400 text-gray-300 pointer-events-none dark:peer-checked:text-yellow-500 dark:text-neutral-400">
                                                                        <svg class="flex-shrink-0 size-5" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                                                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"></path>
                                                                        </svg>
                                                                    </label>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                        <div class="relative col-span-2">
                                                            <textarea id="Ulasan" name="Ulasan" class="peer h-32 w-full resize-none rounded border border-gray-700 bg-gray-500 bg-opacity-40 py-1 px-3 text-base leading-6 text-gray-800 placeholder-transparent outline-none transition-colors duration-200 ease-in-out focus:border-indigo-500 focus:bg-gray-400 dark:focus:bg-gray-600 focus:ring-2 focus:ring-indigo-900" placeholder="Ulasan" required>{{ old('Ulasan') }}</textarea>
                                                            <label for="Ulasan" class="absolute left-3 -top-6 bg-transparent text-sm leading-7 text-indigo-500 transition-all peer-placeholder-shown:left-3 peer-placeholder-shown:top-2 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-focus:left-3 peer-focus:-top-6 peer-focus:text-sm peer-focus:text-indigo-500">Ulasan</label>
                                                        </div>
                                                        <button type="submit" class="inline-flex justify-center w-full px-4 py-2 mt-6 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                                            Kirim Ulasan
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-3 sm:mt-4">
                                            <button @click="openCreateModal = false" type="button" class="inline-flex justify-center w-full px-4 py-2 text-sm font-medium text-gray-700 bg-gray-200 border border-transparent rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                                                Tutup
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

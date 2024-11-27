<title>Buku Pinjaman</title>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Pinjaman') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-4 md:gap-8 md:grid-cols-2 xl:grid-cols-3">
                @if (count($bukuDipinjam) === 0)
                    <p class="text-gray-500">Tidak ada Data Pinjaman</p>
                @else
                    @foreach ($bukuDipinjam as $pinjaman)
                        <div class="bg-white dark:bg-gray-800 shadow px-5 py-6 rounded-lg cursor-pointer relative">
                            <span class="absolute bg-blue-200 top-3 px-2 text-blue-600 rounded-lg">Tap untuk melihat detail pinjaman buku</span>
                            <a href="{{ route('pdetail', ['bid' => $pinjaman->buku->BukuID, 'pid' => $pinjaman->PeminjamanID]) }}">
                                <img class="object-cover object-center w-full h-64 rounded-lg lg:h-70" src="{{ asset('storage/uploads/' . $pinjaman->buku->Cover) }}" alt="{{ $pinjaman->buku->Judul }}">
                            </a>
                            <div class="mt-8">
                                <h3 class="mt-2 text-xl font-semibold text-gray-800 dark:text-gray-200">
                                    {{ $pinjaman->buku->Judul }}
                                </h3>
                                <p class="text-gray-500 dark:text-gray-200">{{ $pinjaman->buku->Penulis }}</p>
                                @if ($pinjaman->TanggalPengembalian === null)
                                    <p class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 mt-2">
                                        {{ __('On-going') }}
                                    </p>
                                @else
                                    <p class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 mt-2">
                                        {{ __('Dikembalikan') }}
                                    </p>
                                @endif
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>

    <script>
        function filterBooks(isReturn) {
            if (selectedStatus === '0') {
                return isReturn === 0;
            } else if (selectedStatus === '1') {
                return isReturn === 1;
            } else if (selectedStatus === '2') {
                return isReturn === 2;
            } else {
                return true;
            }
        }
    </script>
</x-app-layout>

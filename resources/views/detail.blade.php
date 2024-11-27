<title>Detail Buku</title>
@php
    $totalRating = 0;
    $ratingCount = array_fill(0, 5, 0);

    foreach ($book->ulasan as $ulasan) {
        $rating = $ulasan->Rating;
        $totalRating += $rating;
        $ratingCount[$rating - 1]++;
    }

    $averageRating = $book->ulasan->count() > 0 ? $totalRating / $book->ulasan->count() : 0;
@endphp
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detail Buku') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <nav class="flex mb-4" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('caribuku') }}" class="text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                            {{ __('Cari Buku') }}
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400">
                                {{ __('Detail Buku') }}
                            </span>
                        </div>
                    </li>
                </ol>
            </nav>

            <div class="grid grid-cols-1 sm:grid-cols-12 gap-5 bg-white dark:bg-gray-800 p-4 shadow rounded-md">
                <div class="relative sm:col-span-4">
                    <span class="bg-sky-100 py-1 px-2 absolute text-blue-500" x-show="isRequested">{{ __('Already requested') }}</span>
                    <img class="rounded-lg shadow w-full" src="{{ isset($book->Cover) ? asset('storage/uploads/'.$book->Cover) : 'default-image-path' }}" alt="{{ $book->Judul }}">
                </div>
                <div class="justify-center sm:col-span-7">
                    @foreach ($book->kategori as $kategori)
                        <div class="center relative inline-block select-none whitespace-nowrap rounded-lg mb-2 bg-yellow-600 py-2 px-3.5 align-baseline font-sans text-xs font-bold uppercase leading-none text-white">
                            <div class="mt-px">{{ $kategori->NamaKategori }}</div>
                        </div>
                    @endforeach
                    <h2 class="text-3xl font-semibold text-gray-800 dark:text-gray-200">
                        {{ $book->Judul }}
                    </h2>
                    <p class="text-gray-500 dark:text-gray-400 mb-2">
                        {{ $book->Penulis }}
                    </p>
                    <p class="text-gray-700 dark:text-gray-300 mb-10 text-justify">
                        {{ $book->Deskripsi }}
                    </p>
                    <div class="flex flex-col">
                        @if ($bukuDipinjam)
                            <p class="bg-yellow-500 w-28 hover:bg-yellow-400 text-gray-900 center relative inline-block select-none whitespace-nowrap rounded-lg py-3 px-5 mb-3 align-baseline font-sans font-bold leading-none">{{ __('On-going') }}</p>
                        @else
                            <form action="{{ route('pinjam.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="BukuID" value="{{ $book->BukuID }}">
                                <button type="submit" title="Pinjam Sekarang" class="bg-blue-500 hover:bg-blue-400 text-white font-bold py-3 px-5 mb-4 rounded">{{ __('Pinjam Buku') }}</button>
                            </form>
                        @endif

                        @if ($book->diKoleksi())
                            <a href="{{ route('koleksi') }}" title="Lihat Koleksi" class="cursor-pointer w-36 inline-flex items-center fill-lime-400 bg-lime-950 hover:bg-lime-900 active:border active:border-lime-400 rounded-md duration-100 p-2">
                                <svg viewBox="0 -0.5 25 25" height="20px" width="20px" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linejoin="round" stroke-linecap="round" stroke-width="1.5" d="M18.507 19.853V6.034C18.5116 5.49905 18.3034 4.98422 17.9283 4.60277C17.5532 4.22131 17.042 4.00449 16.507 4H8.50705C7.9721 4.00449 7.46085 4.22131 7.08577 4.60277C6.7107 4.98422 6.50252 5.49905 6.50705 6.034V19.853C6.45951 20.252 6.65541 20.6407 7.00441 20.8399C7.35342 21.039 7.78773 21.0099 8.10705 20.766L11.907 17.485C12.2496 17.1758 12.7705 17.1758 13.113 17.485L16.9071 20.767C17.2265 21.0111 17.6611 21.0402 18.0102 20.8407C18.3593 20.6413 18.5551 20.2522 18.507 19.853Z" clip-rule="evenodd" fill-rule="evenodd"></path>
                                </svg>
                                <span class="text-sm text-lime-400 font-bold pr-1">Lihat Koleksi</span>
                            </a>
                        @else
                            <form action="{{ route('kolekstore') }}" method="POST">
                                @csrf
                                <input type="hidden" name="BukuID" value="{{ $book->BukuID }}">
                                <button type="submit" title="Masukkan koleksi" class="cursor-pointer flex items-center fill-lime-400 bg-lime-950 hover:bg-lime-900 active:border active:border-lime-400 rounded-md duration-100 p-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="20" zoomAndPan="magnify" viewBox="0 0 375 374.999991" height="20" preserveAspectRatio="xMidYMid meet" version="1.0">
                                        <defs>
                                            <clipPath id="426496664e">
                                                <path d="M 63 18.75 L 311.933594 18.75 L 311.933594 356 L 63 356 Z M 63 18.75 " clip-rule="nonzero" />
                                            </clipPath>
                                        </defs>
                                        <g clip-path="url(#426496664e)">
                                            <path fill="#ffffff"
                                                d="M 187.496094 206.203125 C 190.609375 206.203125 193.636719 207.574219 195.832031 209.972656 L 288.289062 311.535156 L 288.289062 44.25 L 86.730469 44.25 L 86.730469 311.5625 L 179.1875 210 C 181.355469 207.574219 184.355469 206.203125 187.496094 206.203125 M 74.996094 355.308594 C 73.484375 355.308594 71.96875 354.992188 70.542969 354.335938 C 66.144531 352.367188 63.289062 347.710938 63.289062 342.542969 L 63.289062 31.484375 C 63.289062 24.460938 68.542969 18.75 74.996094 18.75 L 299.996094 18.75 C 306.476562 18.75 311.703125 24.460938 311.703125 31.484375 L 311.703125 342.542969 C 311.703125 347.710938 308.847656 352.367188 304.449219 354.335938 C 300.054688 356.308594 295 355.195312 291.660156 351.511719 L 187.496094 237.070312 L 83.332031 351.511719 C 81.078125 353.996094 78.078125 355.308594 74.996094 355.308594 "
                                                fill-opacity="1" fill-rule="nonzero" />
                                        </g>
                                    </svg>
                                    <span class="text-sm text-lime-400 font-bold pr-1">Koleksi</span>
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="bg-white py-8 antialiased dark:bg-gray-900 md:py-16">
        <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
            <div class="flex items-center gap-2">
                <h2 class="text-2xl font-semibold text-gray-900 dark:text-white">Ulasan</h2>

                <div class="flex items-center gap-0.5">
                    @for ($i = 1; $i <= 5; $i++)
                        @if ($i <= ceil($averageRating))
                            <svg class="h-4 w-4 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z" />
                            </svg>
                        @else
                            <svg class="h-4 w-4 text-gray-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z" />
                            </svg>
                        @endif
                    @endfor
                </div>
                <a href="#" class="text-sm font-medium leading-none text-gray-500 hover:underline dark:text-gray-400">({{ $book->ulasan->count() }} Ulasan)</a>
            </div>

            <div class="my-6 gap-8 sm:flex sm:items-start md:my-8">
                <div class="shrink-0 mt-12 space-y-4">
                    <p class="text-2xl font-semibold leading-none text-gray-900 dark:text-white">{{ number_format($averageRating, 1) }} dari 5</p>
                </div>

                <div class="mt-6 min-w-0 flex-1 space-y-3 sm:mt-0">
                    @for ($rating = 5; $rating >= 1; $rating--)
                        <div class="flex items-center gap-2">
                            <p class="w-2 shrink-0 text-start text-sm font-medium leading-none text-gray-900 dark:text-white">{{ $rating }}</p>
                            <svg class="h-4 w-4 shrink-0 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z" />
                            </svg>
                            <div class="h-1.5 w-80 rounded-full bg-gray-200 dark:bg-gray-700">
                                <div class="h-1.5 rounded-full bg-yellow-300" style="width: {{ $book->ulasan->count() > 0 ? ($ratingCount[$rating - 1] / $book->ulasan->count()) * 100 : 0 }}%"></div>
                            </div>
                            <a href="#" class="w-8 shrink-0 text-right text-sm font-medium leading-none text-primary-700 hover:underline dark:text-primary-500 sm:w-auto sm:text-left" data-rating="{{ $rating }}">{{ $ratingCount[$rating - 1] }} <span class="hidden sm:inline">ulasan</span></a>
                        </div>
                    @endfor
                </div>
            </div>

            <div class="mt-6 divide-y divide-gray-200 dark:divide-gray-700">
                @if ($book->ulasan->count() > 0)
                    @php
                        $ulasanChunks = $book->ulasan->chunk(5);
                        $currentChunk = 0;
                    @endphp

                    @foreach ($ulasanChunks[$currentChunk] as $ulasan)
                        <div class="gap-3 py-6 sm:flex sm:items-start" data-rating="{{ $ulasan->Rating }}">
                            <div class="shrink-0 space-y-2 sm:w-48 md:w-72">
                                <div class="flex items-center gap-0.5">
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= $ulasan->Rating)
                                            <svg class="h-4 w-4 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z" />
                                            </svg>
                                        @else
                                            <svg class="h-4 w-4 text-gray-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z" />
                                            </svg>
                                        @endif
                                    @endfor
                                </div>

                                <div class="space-y-0.5">
                                    <p class="text-base font-semibold text-gray-900 dark:text-white">{{ $ulasan->user->username }}</p>
                                    <p class="text-sm font-normal text-gray-500 dark:text-gray-400">{{ $ulasan->created_at->format('F j, Y') }}</p>
                                </div>
                            </div>

                            <div class="mt-4 min-w-0 flex-1 space-y-4 sm:mt-0">
                                <p class="text-base font-normal text-gray-500 dark:text-gray-400">{{ $ulasan->Ulasan }}</p>
                            </div>
                        </div>
                    @endforeach

                    @if ($ulasanChunks->count() > 1)
                        <div class="mt-6 text-center">
                            <button id="viewMoreReviews" class="mb-2 me-2 rounded-lg border border-gray-200 bg-white px-5 py-2.5 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700">
                                View more reviews
                            </button>
                        </div>
                    @endif
                @else
                    <p class="text-gray-500">Belum ada ulasan yang ditambahkan.</p>
                @endif
            </div>
        </div>
    </section>
</x-app-layout>

<script>

    // function showAllReviews() {
    //     const reviewContainers = document.querySelectorAll('.gap-3.py-6.sm\\:flex.sm\\:items-start');
    //     reviewContainers.forEach(function(container) {
    //         container.style.display = 'flex';
    //     });
    // }

    document.querySelectorAll('.mt-6 .flex a').forEach(function(link) {
        link.addEventListener('click', function(event) {
            event.preventDefault();
            const rating = parseInt(this.dataset.rating);
            filterReviews(rating);
        });
    });

    function filterReviews(rating) {
        const reviewContainers = document.querySelectorAll('.gap-3.py-6.sm\\:flex.sm\\:items-start');
        reviewContainers.forEach(function(container) {
            const reviewRating = parseInt(container.dataset.rating);
            if (rating === 0 || reviewRating === rating) {
                container.style.display = 'flex';
            } else {
                container.style.display = 'none';
            }
        });
    }

    document.addEventListener('alpine:init', () => {
        Alpine.data('detailBuku', () => ({
            diKoleksi: '{{ $book->diKoleksi() ? 'true' : 'false' }}' === 'true',
        }))
    })


    document.getElementById('viewMoreReviews').addEventListener('click', function() {
        currentChunk++;

        if (currentChunk < ulasanChunks.length) {
            const ulasanContainer = document.querySelector('.divide-y.divide-gray-200.dark\\:divide-gray-700');
            const ulasanHTML = ulasanChunks[currentChunk].map(ulasan => `

            `).join('');

            ulasanContainer.insertAdjacentHTML('beforeend', ulasanHTML);

            if (currentChunk === ulasanChunks.length - 1) {
                this.style.display = 'none';
            }
        }
    });
</script>

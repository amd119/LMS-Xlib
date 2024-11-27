<title>Dashboard</title>
<link rel="shortcut icon" href="images/logo1.png" type="image/x-icon">
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 lg:h-screen">

            <div class="grid grid-cols-1 mb-4 px-4">
                <div class="dark:bg-gray-800 bg-white px-4 py-5 h-full border-l-4 border-sky-500 shadow text-gray-600 dark:text-gray-100 text-xl">
                    Selamat datang di XLib, <span class="font-bold">{{ Auth::user()->NamaLengkap }}</span> 👋
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-10 px-4">
                <a href="{{ route('caribuku') }}">
                    <div class="bg-white dark:bg-gray-800 px-4 py-5 border-l-4 border-blue-500 shadow relative hover:border-blue-400">
                        <h2 class="text-xl font-semibold dark:text-gray-100 text-gray-600 mb-3 flex gap-2 items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                            </svg>
                            <span>Buku</span>
                        </h2>
                        <p class="text-green-500 mb-1">
                            Total Buku: <span class="text-gray-600 dark:text-gray-100">{{ App\Helpers\LibraryHelpers::hitung('buku') }}</span>
                        </p>
                    </div>
                </a>
                <a href="{{ route('koleksi') }}">
                    <div class="bg-white dark:bg-gray-800  px-4 py-5 border-l-4 border-purple-500 shadow relative hover:border-purple-400">
                        <h2 class="text-xl font-semibold dark:text-gray-100 text-gray-600 mb-3 flex gap-2 items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 12h16.5m-16.5 3.75h16.5M3.75 19.5h16.5M5.625 4.5h12.75a1.875 1.875 0 010 3.75H5.625a1.875 1.875 0 010-3.75z" />
                            </svg>
                            <span>Koleksi Saya</span>
                        </h2>
                        <p class="text-green-500 mb-1">
                            Total Koleksi: <span class="text-gray-600 dark:text-gray-100">{{ App\Helpers\LibraryHelpers::totalKoleksi('koleksipribadi', Auth::user()->UserID) }}</span>
                        </p>
                    </div>
                </a>
                <a href="{{ route('pinjaman') }}">
                    <div class="bg-white dark:bg-gray-800  px-4 py-5 border-l-4 border-green-500 shadow relative hover:border-green-400">
                        <h2 class="text-xl font-semibold dark:text-gray-100 text-gray-600 mb-3 flex gap-2 items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 3.75V16.5L12 14.25 7.5 16.5V3.75m9 0H18A2.25 2.25 0 0120.25 6v12A2.25 2.25 0 0118 20.25H6A2.25 2.25 0 013.75 18V6A2.25 2.25 0 016 3.75h1.5m9 0h-9" />
                            </svg>
                            <span>Pinjaman Saya</span>
                        </h2>
                        <p class="text-green-500 mb-1">
                            Total Dikembalikan: <span class="text-gray-600 dark:text-gray-100">{{ App\Helpers\LibraryHelpers::totalPinjamanDikembalikan('peminjaman', Auth::user()->UserID) }}</span>
                        </p>
                    </div>
                </a>
                <a >
                    <div class="bg-white dark:bg-gray-800 px-4 py-5 border-l-4 border-yellow-500 shadow relative hover:border-yellow-400">
                        <h2 class="text-xl font-semibold dark:text-gray-100 text-gray-600 mb-3 flex gap-2 items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18pt" height="18pt" viewBox="0 0 301.000000 301.000000" preserveAspectRatio="xMidYMid meet">
                                <g transform="translate(0.000000,301.000000) scale(0.100000,-0.100000)">
                                    <path fill="currentColor" d="M1579 2781 c-81 -51 -79 -36 -79 -637 0 -420 3 -531 14 -557 17 -42 66 -83 114 -97 21 -5 145 -10 284 -10 l248 0 2 -182 c3 -174 4 -183 23 -186 14 -2 72 49 205 183 l185 185 85 0 c91 0 148 18 183 58 45 50 46 70 46 612 1 480 -1 518 -18 555 -21 46 -54 79 -94 94 -19 7 -217 11 -591 11 l-562 0 -45 -29z m1206 -65 l30 -24 3 -536 3 -535 -30 -33 c-29 -33 -30 -33 -133 -36 l-103 -3 -162 -162 -163 -162 0 151 c0 103 -4 154 -12 162 -9 9 -87 12 -290 12 -296 0 -323 4 -348 49 -6 13 -10 206 -10 551 l0 532 29 29 29 29 564 0 563 0 30 -24z" />
                                    <path fill="currentColor" d="M1826 2415 c-20 -21 -5 -55 25 -55 24 0 36 27 22 48 -14 23 -29 25 -47 7z" />
                                    <path fill="currentColor" d="M2106 2414 c-19 -19 -20 -26 -4 -42 9 -9 76 -12 240 -12 214 0 228 1 238 19 7 15 6 23 -6 35 -23 24 -445 24 -468 0z" />
                                    <path fill="currentColor" d="M1821 2163 c-13 -26 1 -45 30 -41 18 2 24 9 24 28 0 32 -39 41 -54 13z" />
                                    <path fill="currentColor" d="M2101 2166 c-6 -7 -9 -21 -5 -30 5 -14 33 -16 239 -16 243 0 264 4 249 44 -5 14 -33 16 -239 16 -185 0 -235 -3 -244 -14z" />
                                    <path fill="currentColor" d="M1821 1921 c-13 -24 9 -57 33 -48 23 9 31 34 16 52 -17 20 -37 19 -49 -4z" />
                                    <path fill="currentColor" d="M2101 1926 c-9 -11 -10 -20 -1 -35 10 -20 19 -21 240 -21 221 0 230 1 240 21 9 15 8 24 -1 35 -9 11 -53 14 -239 14 -186 0 -230 -3 -239 -14z" />
                                    <path fill="currentColor" d="M439 2416 c-89 -32 -145 -83 -186 -171 l-28 -60 -3 -815 c-2 -448 0 -834 3 -856 7 -53 46 -112 93 -144 33 -22 50 -25 157 -30 l120 -5 5 -115 c6 -141 11 -144 113 -68 40 30 78 58 85 62 8 5 40 -13 88 -49 88 -66 99 -71 119 -55 12 10 15 47 15 206 l0 194 310 0 c246 0 310 -3 310 -13 0 -7 9 -30 20 -52 11 -22 20 -40 20 -42 0 -1 -129 -4 -287 -5 l-288 -3 0 -25 0 -25 360 0 360 0 3 21 c2 17 -7 28 -39 45 -62 35 -83 68 -83 133 -1 65 21 100 80 132 l39 20 0 339 c0 315 -1 339 -18 349 -15 9 -21 7 -33 -8 -11 -16 -14 -75 -14 -323 l0 -303 -688 0 -689 0 -46 -24 -47 -23 2 736 3 736 28 57 c29 59 59 88 121 113 l36 15 0 -750 c0 -703 1 -750 18 -758 43 -23 42 -38 42 754 l0 754 426 2 c380 3 428 5 437 19 6 9 7 24 4 33 -6 14 -50 16 -469 16 -352 -1 -472 -4 -499 -14z m1220 -1773 c-10 -21 -19 -43 -19 -50 0 -10 -111 -13 -569 -13 -606 0 -598 1 -589 -47 3 -14 15 -19 61 -21 l58 -3 -3 -52 -3 -52 -85 -3 c-101 -3 -159 15 -191 59 -46 65 -30 157 34 198 31 20 47 21 678 21 l647 0 -19 -37z m-709 -283 c0 -82 -3 -150 -6 -150 -3 0 -32 20 -64 45 -32 25 -64 45 -71 45 -7 0 -27 -11 -46 -25 -18 -14 -49 -37 -68 -51 l-35 -26 0 156 0 156 145 0 145 0 0 -150z" />
                                </g>
                            </svg>
                            <span>Kategori Buku</span>
                        </h2>
                        <p class="text-green-500 mb-1">
                            Total Kategori: <span class="text-gray-600 dark:text-gray-100">{{ App\Helpers\LibraryHelpers::hitung('kategoribuku') }}</span>
                        </p>
                    </div>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>


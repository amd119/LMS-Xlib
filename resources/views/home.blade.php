@extends('templates.app')

@section('title')
    Selamat Datang
@endsection

@section('css')
    <link rel="stylesheet" href="/css/style.css">
@endsection

<body>
    <header id="header" class="header-transparent">
        <div class="container">

            <div id="logo" class="pull-left">
                <a href="/">
                    <h2>Xlib</h2>
                </a>
            </div>
        </div>
    </header>

    <div id="hero">
        <div class="hero-container" data-aos="zoom-in" data-aos-delay="100">
            <h1>Selamat Datang</h1>
            <h2>Kami hadir untuk memudahkan Anda dalam meminjam buku</h2>
            @if (Route::has('login'))
                <nav class="-mx-3 flex flex-1 justify-end">
                    @auth
                        @if (Auth::user()?->Role === 'Peminjam')
                            <a href="{{ url('/flash') }}" class="btn-get-started">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ url('/dashboard') }}" class="btn-get-started">
                                Dashboard
                            </a>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="btn-get-started">
                            Log in
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn-get-started">
                                Register
                            </a>
                        @endif
                    @endauth
                </nav>
            @endif
        </div>
    </div>
    @include('sweetalert::alert')
</body>

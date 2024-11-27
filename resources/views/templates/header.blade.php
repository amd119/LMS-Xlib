<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        $helper = new \App\Helpers\HelpersFunctions();
        $url = isset($url) ? $url : [];
        $title = $helper->getTitle($url);
    ?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ asset('/adminlte/plugins/fontawesome-free/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('/adminlte/css/adminlte.css') }}">
    <link rel="stylesheet" href="{{ asset('/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/adminlte/plugins/sweetalert2/sweetalert2.css') }}">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="hold-transition sidebar-mini layout-fixed">

    <div class="wrapper">
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">

            <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="{{ url('/') }}" role="button"><i class="fas fa-bars"></i></a>
            </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li>@include('layouts.navigation')</li>
            </ul>
        </nav>

        <aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: teal" >
            <a href="{{ route('home') }}" class="brand-link">
                <img src="/images/blueobook.png" alt="Perpus Logo" class="brand-image img-circle elevation-" style="opacity: .8">
                <span class="brand-text font-light"><em>Xlib</em></span>
            </a>

            <div class="sidebar">
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        @if (Auth::user()?->Role === 'Administrator' || Auth::user()?->Role === 'Petugas')
                            <li class="nav-item">
                                <a href="{{ route('dashboard') }}" class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-university"></i>
                                    <p>Home</p>
                                </a>
                            </li>
                            <li class="nav-item has-treeview {{ request()->is('user', 'kategoribuku', 'buku', 'peminjam') ? 'menu-open' : '' }}">
                                <a href="#" class="nav-link {{ request()->is('user', 'kategoribuku', 'buku', 'peminjam') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-save"></i>
                                    <p>Data
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    @if (Auth::user()?->Role === 'Administrator')
                                        <li class="nav-item">
                                            <a href="{{ route('user.home') }}" class="nav-link {{ request()->is('user') ? 'active' : '' }}">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>User</p>
                                            </a>
                                        </li>
                                    @endif
                                    <li class="nav-item">
                                        <a href="{{ route('kategoribuku.home') }}" class="nav-link {{ request()->is('kategoribuku') ? 'active' : '' }}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Kategori Buku</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('buku.home') }}" class="nav-link {{ request()->is('buku') ? 'active' : '' }}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Buku</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('peminjam.home') }}" class="nav-link {{ request()->is('peminjam') ? 'active' : '' }}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Peminjam</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endif

                        {{-- @if (Auth::user()?->Role === 'Peminjam')
                            <li class="nav-item has-treeview {{ request()->is('perpustakaan', 'peminjaman', 'koleksi') ? 'menu-open' : '' }}">
                                <a href="#" class="nav-link {{ request()->is('perpustakaan', 'peminjaman', 'koleksi') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-save"></i>
                                    <p>Perpustakaan<i class="right fas fa-angle-left"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('perpustakaan.home') }}" class="nav-link {{ request()->is('perpustakaan') ? 'active' : '' }}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Daftar Buku</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('peminjaman.home') }}" class="nav-link {{ request()->is('peminjaman') ? 'active' : '' }}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Buku Pinjaman</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('koleksi.home') }}" class="nav-link {{ request()->is('koleksi') ? 'active' : '' }}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Koleksi Pribadi</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endif --}}

                        <li class="nav-item">
                            <a href="{{ route('logout') }}" class="nav-link"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <p>Logout</p>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">{{ $title }}</h1>
                        </div>
                    </div>
                </div>
            </div>

    <section class="content">

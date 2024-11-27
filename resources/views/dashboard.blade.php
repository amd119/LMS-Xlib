@include('templates.header')

<title>Home</title>

<div class="container-fluid">
    <div class="row">
        {{-- Buku --}}
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <p>Buku</p>
                    <h3>{{ App\Helpers\LibraryHelpers::hitung('buku') }}</h3>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
            </div>
        </div>

        {{-- Kategori Buku --}}
        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <p>Kategori Buku</p>
                    <h3>{{ App\Helpers\LibraryHelpers::hitung('kategoribuku') }}</h3>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
            </div>
        </div>

        {{-- Buku Yang Dipinjam --}}
        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <p>Buku Yang Dipinjam</p>
                    <h3>{{ App\Helpers\LibraryHelpers::hitung('peminjaman') }}</h3>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
            </div>
        </div>

        {{-- User --}}
        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <p>User</p>
                    <h3>{{ App\Helpers\LibraryHelpers::hitung('users') }}</h3>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Include the footer --}}
@include('templates.footer')


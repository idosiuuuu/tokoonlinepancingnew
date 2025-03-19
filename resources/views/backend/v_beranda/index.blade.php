@extends('backend.v_layouts.app')
@section('content')
    <!-- contentAwal -->

    <p>
        Selamat Datang,
        <b>
            {{ Auth::user()->nama }}
        </b>
        pada aplikasi Toko Online dengan hak akses yang anda miliki sebagai
        <b>
            @if (Auth::user()->role == 1)
                Super Admin
            @elseif(Auth::user()->role == 0)
                Admin
            @endif
        </b>
        ini adalah halaman utama dari aplikasi ini.
    </p>
    <div class="row">
        <div class="col-md-6 col-lg-2 col-xlg-3">
            <div class="card card-hover">
                <div class="box bg-success text-center">
                    <h1 class="font-light text-white"><i class="mdi mdi-account"></i></h1>
                    <h6 class="text-white">{{ $user }} User</h6>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-2 col-xlg-3">
            <div class="card card-hover">
                <div class="box bg-primary text-center">
                    <h1 class="font-light text-white"><i class="mdi mdi-account-outline"></i></h1>
                    <h6 class="text-white">{{ $customer }} Customer</h6>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-2 col-xlg-3">
            <div class="card card-hover">
                <div class="box bg-warning text-center">
                    <h1 class="font-light text-white"><i class="mdi mdi-cart"></i></h1>
                    <h6 class="text-white">{{ $produk }} Produk</h6>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-2 col-xlg-3">
            <div class="card card-hover">
                <div class="box bg-danger text-center">
                    <h1 class="font-light text-white"><i class="mdi mdi-clipboard"></i></h1>
                    <h6 class="text-white">{{ $kategori }} Kategori</h6>
                </div>
            </div>
        </div>
    </div>






    <!-- contentAkhir -->
@endsection

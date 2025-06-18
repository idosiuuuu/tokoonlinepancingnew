@extends('frontend.v_layouts.app')
@section('content')
    <!-- template -->

    <div class="row">
        <div class="col-md-12">
            <div class="billing-details">
                <p> {{ $judul }} </p>
                <div class="section-title">
                    <h3 class="title">{{ $subJudul }} </h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">

                    <img src="{{ asset('images/logo_niknok.png') }}" alt="" width="100%">

                </div>
                <div class="col-md-8">
                    <div class="aside">
                        <h3 class="aside-title">1. Login atau Daftar Akun</h3>
                        <ul class="list-links">
                            <li class="active"><i class="fa fa-angle-right"></i>
                                Jika Anda sudah memiliki akun, masuklah dengan memasukkan username dan password Anda.
                            </li>
                            <li class="active"><i class="fa fa-angle-right"></i>
                                Jika Anda belum memiliki akun, pilih menu <b>Daftar</b> dan ikuti langkah-langkah untuk
                                membuat akun baru. Masukkan informasi yang diperlukan seperti nama, email, dan password.
                            </li>
                        </ul>
                    </div>

                    <div class="aside">
                        <h3 class="aside-title">2. Pilih Produk</h3>
                        <ul class="list-links">
                            <li class="active"><i class="fa fa-angle-right"></i>
                                Jelajahi katalog produk yang tersedia
                            </li>
                            <li class="active"><i class="fa fa-angle-right"></i>
                                Pilih produk yang Anda inginkan dengan mengklik produk tersebut.
                            </li>
                            <li class="active"><i class="fa fa-angle-right"></i>
                                Untuk memesan, klik tombol <b>Pesan</b>. Jika ingin melihat detail produk lebih lanjut, klik
                                tombol <b>Selengkapnya</b>
                            </li>
                        </ul>
                    </div>

                    <div class="aside">
                        <h3 class="aside-title">3. Lakukan Pemesanan</h3>
                        <ul class="list-links">
                            <li class="active"><i class="fa fa-angle-right"></i>
                                Setelah memilih produk, klik tombol <b>Berikut</b> untuk melanjutkan ke proses pembayaran.
                            </li>
                        </ul>
                    </div>

                    <div class="aside">
                        <h3 class="aside-title">4. Pilih Metode Pembayaran</h3>
                        <ul class="list-links">
                            <li class="active"><i class="fa fa-angle-right"></i>
                                Di menu pembayaran, Anda akan melihat berbagai metode pembayaran yang tersedia.
                            </li>
                            <li class="active"><i class="fa fa-angle-right"></i>
                                Pilih metode pembayaran yang Anda inginkan, seperti transfer bank, kartu kredit, atau metode
                                lainnya yang tersedia.
                            </li>
                        </ul>
                    </div>

                    <div class="aside">
                        <h3 class="aside-title">5. Lihat Pesanan di Keranjang</h3>
                        <ul class="list-links">
                            <li class="active"><i class="fa fa-angle-right"></i>
                                Pesanan Anda dapat dilihat di menu <b>Keranjang</b>
                            </li>
                            <li class="active"><i class="fa fa-angle-right"></i>
                                Pilih metode pembayaran yang Anda inginkan, seperti transfer bank, kartu kredit, atau metode
                                lainnya yang tersedia.
                            </li>
                        </ul>
                    </div>

                    <div class="aside">
                        <h3 class="aside-title">Pesan Melalui Whatsapp</h3>
                        Pesan melalui WhatsApp merupakan alternatif pemesanan selain dari website ini
                        <ul class="list-links">
                            <li class="active"><i class="fa fa-angle-right"></i>
                                Silakan kirimkan detail produk yang Anda inginkan melalui fitur <b>Hubungi Kami</b>
                            </li>
                            <li class="active"><i class="fa fa-angle-right"></i>
                                Lalu kirimkan bukti pembayaran Anda
                            </li>
                        </ul>
                    </div>
                </div>


            </div>
        </div>
    </div>
    </div>

    <!-- end template-->
@endsection

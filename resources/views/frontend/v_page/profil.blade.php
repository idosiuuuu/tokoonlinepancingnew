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
                    <p>Singkong merupakan sumber bahan pangan lokal yang kaya serat dan gluten free. Tanaman Singkong mudah
                        dijumpai keberadaannya di kota Depok. Kemudahannya dalam menanam dan minim perawatan membuat tanaman
                        singkong bisa tumbuh di berbagai kondisi tanah. Selain mudah ditanam singkong juga mudah diolah
                        menjadi berbagai macam camilan dan masakan.</p>

                    <p>Peluang inilah yang kemudian ditangkap oleh pasangan suami istri Ahmad Afandi, S.Pd dan Nikmah
                        Mahmudah, STP dalam mengembangkan produk olahan singkong. Dengan konsep usaha Rumah Singkong NikNok,
                        berbagai eksperimen yang telah dilakukan membuahkan hasil, singkong yang tadinya hanya diolah
                        menjadi makanan tradisional kini menjadi makanan kekinian yang bisa dinikmati di berbagai kalangan.
                        Bahkan bukan hanya umbinya, daun tanaman singkong pun berhasil diolah menjadi minuman.</p>

                    <p>Beberapa produk yang dihasilkan antara lain adalah Wingko Singkong NikNok, Comro Frozen (isi oncom
                        dan ikan cakalang), Mochi Singkong, dan Dawet daun singkong pelan – pelan mulai digemari masyarakat.
                        Bahkan produk Wingko Singkong NikNok saat ini dikenal masyarakat sebagai oleh – oleh khas dari kota
                        Depok.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- end template-->
@endsection

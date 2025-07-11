<!DOCTYPE html>
<html lang="en">
@php
    use Illuminate\Support\Facades\DB;
    use App\Models\Produk;
    use App\Models\Kategori;
@endphp

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('image/icon_univ_bsi.png') }}">
    <title>tokoonline</title>

    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css?family=Hind:400,700" rel="stylesheet">

    <!-- Bootstrap -->
    <link type="text/css" rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}">

    <!-- Slick -->
    <link type="text/css" rel="stylesheet" href="{{ asset('frontend/css/slick.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('frontend/css/slick-theme.css') }}">

    <!-- nouislider -->
    <link type="text/css" rel="stylesheet" href="{{ asset('frontend/css/nouislider.min.css') }}">

    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="{{ asset('frontend/css/font-awesome.min.css') }}">

    <!-- Custom stlylesheet -->
    <link type="text/css" rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->


</head>

<body>
    <!-- HEADER -->
    <header>
        <!-- top Header -->
        <div id="top-header">
            <div class="container">
                <div class="pull-left">
                    <span>Selamat datang di toko online</span>
                </div>
            </div>
        </div>
        <!-- /top Header -->

        <!-- header -->
        <div id="header">
            <div class="container">
                <div class="pull-left">
                    <!-- Logo -->
                    <div class="header-logo">
                        <a class="logo" href="{{ route('beranda') }}">
                            <img src="{{ asset('image/logo.png') }}" alt="">
                        </a>
                    </div>
                    <!-- /Logo -->

                    <!-- Search -->

                    <!-- /Search -->
                </div>
                <div class="pull-right">
                    <ul class="header-btns">
                        @if (Auth::check())
                            <!-- /Cart -->
                            <!-- Cart -->
                            <li class="header-cart dropdown default-dropdown">
                                <a href="{{ route('order.cart') }}">
                                    <div class="header-btns-icon">
                                        <i class="fa fa-shopping-cart"></i>
                                        <!-- <span class="qty">3</span> -->
                                    </div>
                                    <strong class="text-uppercase">Keranjang</strong>

                                </a>
                            </li>
                            <!-- /Cart -->
                        @else
                            <!-- Cart (Guest) -->
                            <li class="header-cart dropdown default-dropdown">
                                <div class="dropdown-toggle" role="button" data-toggle="dropdown" aria-expanded="true">
                                    <div class="header-btns-icon">
                                        <i class="fa fa-shopping-cart"></i>
                                    </div>
                                    <strong class="text-uppercase">Keranjang <i class="fa fa-caret-down"></i></strong>
                                </div>
                                {{-- <a href="{{ route('auth.redirect') }}" class="text-uppercase">Login untuk melihat</a> --}}
                            </li>
                        @endif


                        @if (Auth::check())
                            <!-- Account -->
                            <li class="header-account dropdown default-dropdown">
                                <div class="dropdown-toggle" role="button" data-toggle="dropdown" aria-expanded="true">
                                    <div class="header-btns-icon">
                                        <i class="fa fa-user-o"></i>
                                    </div>
                                    <strong class="text-uppercase">{{ Auth::user()->nama }}<i
                                            class="fa fa-caret-down"></i></strong>
                                </div>
                                <ul class="custom-menu">
                                    <li><a href="{{ route('customer.akun', ['id' => Auth::user()->id]) }}"><i
                                                class="fa fa-user-o"></i> Akun Saya</a></li>
                                    <li><a href="{{ route('order.history') }}"><i class="fa fa-check"></i> History</a>
                                    </li>
                                    <li>
                                        <a href="#"
                                            onclick="event.preventDefault(); document.getElementById('keluar-app').submit();"><i
                                                class="fa fa-power-off"></i> Keluar
                                        </a>
                                        <!-- form keluar app -->
                                        <form id="keluar-app" action="{{ route('logout') }}" method="POST"
                                            class="d-none">
                                            @csrf
                                        </form>
                                        <!-- form keluar app end -->
                                    </li>
                                </ul>
                            </li>
                        @else
                            <li class="header-account dropdown default-dropdown">
                                <div class="dropdown-toggle" role="button" data-toggle="dropdown" aria-expanded="true">
                                    <div class="header-btns-icon">
                                        <i class="fa fa-user-o"></i>
                                    </div>
                                    <strong class="text-uppercase">Akun Saya<i class="fa fa-caret-down"></i></strong>
                                </div>
                                <a href="{{ route('frontend.login') }}" class="text-uppercase">Login</a>
                            </li>

                            <!-- /Account -->
                        @endif

                        <!-- Mobile nav toggle-->
                        <li class="nav-toggle">
                            <button class="nav-toggle-btn main-btn icon-btn"><i class="fa fa-bars"></i></button>
                        </li>
                        <!-- / Mobile nav toggle -->
                    </ul>
                </div>
            </div>
            <!-- header -->
        </div>
        <!-- container -->
    </header>
    <!-- /HEADER -->

    <!-- NAVIGATION -->
    <div id="navigation">
        <!-- container -->
        <div class="container">
            <div id="responsive-nav">
                @php
                    $kategori = DB::table('kategori')->orderBy('nama_kategori', 'asc')->get();
                @endphp
                @if (request()->segment(1) == '' || request()->segment(1) == 'beranda')

                    <!-- category nav -->
                    <div class="category-nav">
                        <span class="category-header">Kategori <i class="fa fa-list"></i></span>
                        <ul class="category-list">
                            @foreach ($kategori as $row)
                                <li><a href="{{ route('produk.kategori', $row->id) }}">{{ $row->nama_kategori }}</a>
                                </li>
                            @endforeach
                        </ul>

                        <ul class="category-list">
                    </div>
                @else
                    <div class="category-nav show-on-click">
                        <span class="category-header">Kategori <i class="fa fa-list"></i></span>
                        <ul class="category-list">
                            @foreach ($kategori as $row)
                                <li><a href="{{ route('produk.kategori', $row->id) }}">{{ $row->nama_kategori }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <!-- /category nav -->
                @endif
                <!-- menu nav -->
                <div class="menu-nav">
                    <span class="menu-header">Menu <i class="fa fa-bars"></i></span>
                    <ul class="menu-list">
                        <li><a href="{{ route('beranda') }}">Beranda</a></li>
                        <li><a href="{{ route('produk.all') }}">Produk</a></li>
                        <li><a href="{{ route('frontend.lokasi') }}">Lokasi</a></li>
                        <li><a href="https://wa.me/6281936747553?text=Mas%20Dika%20saya%20mau%20pesan">Hubungi
                                Kami</a></li>
                    </ul>
                </div>

                <!-- menu nav -->
            </div>
        </div>
        <!-- /container -->
    </div>
    <!-- /NAVIGATION -->

    @if (request()->segment(1) == '' || request()->segment(1) == 'beranda')
        <!-- HOME -->
        <div id="home">
            <!-- container -->
            <div class="container">
                <!-- home wrap -->
                <div class="home-wrap">
                    <!-- home slick -->
                    <div id="home-slick">
                        <!-- banner -->
                        <div class="banner banner-1">
                            <img src="{{ asset('frontend/banner/banner05.jpg') }}" alt="">
                            <div class="banner-caption">
                                <h1 class="primary-color">TOKO PANCING<br><span class="white-color font-weak">DIKA
                                        FISHING</span></h1>
                                <button class="primary-btn">Belanja Sekarang</button>
                            </div>
                        </div>
                        <!-- /banner -->

                        <!-- banner -->
                        <div class="banner banner-1">
                            <img src="{{ asset('frontend/banner/banner02.jpg') }}" alt="">
                            <div class="banner-caption">
                                <h1 class="primary-color">TOKO PANCING<br><span class="white-color font-weak">DIKA
                                        FISHING</span></h1>
                                <button class="primary-btn">Belanja Sekarang</button>
                            </div>
                        </div>
                        <!-- /banner -->

                        <!-- banner -->
                        <div class="banner banner-1">
                            <img src="{{ asset('frontend/banner/banner04.jpg') }}" alt="">
                            <div class="banner-caption">
                                <h1 class="primary-color">TOKO PANCING<br><span class="white-color font-weak">DIKA
                                        FISHING</span></h1>
                                <button class="primary-btn">Belanja Sekarang</button>
                            </div>
                        </div>
                        <!-- /banner -->
                    </div>
                    <!-- /home slick -->
                </div>
                <!-- /home wrap -->
            </div>
            <!-- /container -->
        </div>
        <!-- /HOME -->
    @endif

    <!-- section -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- ASIDE -->
                <div id="aside" class="col-md-3">
                    <!-- aside widget -->
                    <div class="aside">
                        <h3 class="aside-title">Kategori</h3>
                        @php
                            $kategori = DB::table('kategori')->orderBy('nama_kategori', 'asc')->get();
                        @endphp
                        <ul class="list-links">
                            @foreach ($kategori as $row)
                                <li><a href="{{ route('produk.kategori', $row->id) }}">{{ $row->nama_kategori }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <!-- /aside widget -->
                    <!-- aside widget -->
                    @php
                        // Query untuk mendapatkan produk terlaris
                        $produkTerlaris = DB::table('order_item')
                            ->select('produk_id', DB::raw('SUM(quantity) as total_quantity'))
                            ->groupBy('produk_id')
                            ->orderBy('total_quantity', 'desc')
                            ->take(5) // Ambil 5 produk terlaris
                            ->get();

                        // Mengambil detail produk
                        $produkTerlaris = $produkTerlaris->map(function ($item) {
                            $produk = Produk::find($item->produk_id);
                            $item->produk = $produk;
                            return $item;
                        });
                    @endphp

                    <div class="aside">
                        <h3 class="aside-title">Produk Terlaris</h3>
                        <!-- widget product -->
                        @foreach ($produkTerlaris as $item)
                            <div class="product product-widget">


                                <div class="product-thumb">
                                    <img src="{{ asset('storage/img-produk/thumb_md_' . $item->produk->foto) }}"
                                        alt="">
                                </div>
                                <div class="product-body">
                                    <h2 class="product-name"><a href="#">{{ $item->produk->nama_produk }}</a>
                                    </h2>
                                    <h3 class="product-price">Rp.
                                        {{ number_format($item->produk->harga, 0, ',', '.') }}
                                    </h3>

                                </div>

                            </div>
                        @endforeach
                        <!-- /widget product -->
                    </div>
                    <!-- /aside widget -->
                </div>
                <!-- /ASIDE -->

                <!-- MAIN -->
                <div id="main" class="col-md-9">
                    <!-- STORE -->


                    <!-- isi template -->
                    @yield('content')
                    <!-- end isi template -->


                    <!-- /STORE -->

                </div>
                <!-- /MAIN -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /section -->

    <!-- FOOTER -->
    <footer id="footer" class="section section-grey">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- footer widget -->
                <div class="col-md-3 col-sm-6 col-xs-6">
                    <div class="footer">
                        <!-- footer logo -->
                        <div class="footer-logo">
                            <a class="logo" href="#">
                                <img src="frontend/image/logo03.png" alt="">
                            </a>
                        </div>
                        <!-- /footer logo -->

                        <p>Toko Pancing Dika Fishing</p>

                        <!-- footer social -->
                        <ul class="footer-social">
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                        </ul>
                        <!-- /footer social -->
                    </div>
                </div>
                <!-- /footer widget -->

                <!-- footer widget -->
                <div class="col-md-3 col-sm-6 col-xs-6">
                    <div class="footer">
                        <h3 class="footer-header">Akun Saya</h3>
                        <ul class="list-links">
                            <li><a href="#">Akun Saya</a></li>
                            <li><a href="{{ route('order.cart') }}">Keranjang Saya</a></li>
                        </ul>
                    </div>
                </div>
                <!-- /footer widget -->

                <div class="clearfix visible-sm visible-xs"></div>

                <!-- footer widget -->
                <div class="col-md-3 col-sm-6 col-xs-6">
                    <div class="footer">
                        <h3 class="footer-header">Layanan Pelanggan</h3>
                        <ul class="list-links">
                            <li><a href="{{ route('frontend.profil') }}">Tentang Kami</a></li>
                            <li><a href="{{ route('frontend.carapesan') }}">Cara Pemesanan</a></li>
                        </ul>
                    </div>
                </div>
                <!-- /footer widget -->

                <!-- footer subscribe -->
                <div class="col-md-3 col-sm-6 col-xs-6">
                    <div class="footer">
                        <h3 class="footer-header">Lokasi</h3>
                        <p>Alamat: Rancawiru, Kec. Pangkah, Kabupaten Tegal, Jawa Tengah 52471.</p>
                        <a class="logo" href="#" target="_blank">
                            <img src="{{ asset('frontend/image/whatsapp.png') }}" alt="" width="100%"
                                style="float: left;">
                        </a>
                    </div>
                </div>
                <!-- /footer subscribe -->
            </div>
            <!-- /row -->
            <hr>
            <!-- row -->
            <div class="row">
                <div class="col-md-8 col-md-offset-2 text-center">
                    <!-- footer copyright -->
                    <div class="footer-copyright">
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        Copyright &copy;
                        <script>
                            document.write(new Date().getFullYear());
                        </script> Toko Dika Fishing <i class="#" aria-hidden="true"></i> by
                        <a href="#" target="_blank">ANDIKA AND FIRDAUS</a>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    </div>
                    <!-- /footer copyright -->
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </footer>
    <!-- /FOOTER -->

    <!-- jQuery Plugins -->
    <script src="{{ asset('frontend/js/jquery.min.js') }}"></script>
    <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontend/js/slick.min.js') }}"></script>
    <script src="{{ asset('frontend/js/nouislider.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.zoom.min.js') }}"></script>
    <script src="{{ asset('frontend/js/main.js') }}"></script>
    <!-- Raja Ongkir -->
    @stack('scripts')

    <!-- Midstran -->
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('midtrans.client_key') }}"></script>



    <script>
        // previewFoto
        function previewFoto() {
            const foto = document.querySelector('input[name="foto"]');
            const fotoPreview = document.querySelector('.foto-preview');
            fotoPreview.style.display = 'block';
            const fotoReader = new FileReader();
            fotoReader.readAsDataURL(foto.files[0]);
            fotoReader.onload = function(fotoEvent) {
                fotoPreview.src = fotoEvent.target.result;
                fotoPreview.style.width = '100%';
            }
        }
    </script>

</body>

</html>

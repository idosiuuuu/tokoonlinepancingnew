<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PageFrontend;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\RajaOngkirController;
use App\Http\Controllers\RajaOngkirControllerV2;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RegisterController;
use App\Models\User;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Http;

Route::get('/', function () {
    // return view('welcome');
    return redirect()->route('beranda');
});

Route::get('backend/beranda', [BerandaController::class, 'berandaBackend'])->name('backend.beranda')->middleware('auth');

Route::get('backend/login', [LoginController::class, 'loginBackend'])->name('backend.login');
Route::post('backend/login', [LoginController::class, 'authenticateBackend'])->name('backend.login');
Route::post('backend/logout', [LoginController::class, 'logoutBackend'])->name('backend.logout');
// Route untuk User 
// Route::resource('backend/user', UserController::class)->middleware('auth');
Route::resource('backend/user', UserController::class, ['as' => 'backend'])->middleware('auth');
// Route untuk Kategori
Route::resource('backend/kategori', KategoriController::class, ['as' => 'backend'])->middleware('auth');
// Route untuk Produk 
Route::resource('backend/produk', ProdukController::class, ['as' => 'backend'])->middleware('auth');


// Route untuk customer
Route::resource('backend/customer', CustomerController::class, ['as' => 'backend'])->middleware('auth');

// Route untuk login frontend
Route::get('frontend/login', [LoginController::class, 'loginFrontend'])->name('frontend.login');
Route::post('frontend/login', [LoginController::class, 'authenticateFrontend'])->name('frontend.login');
// Route::get('frontend/register', [RegisterController::class, 'registerFrontend'])->name('frontend.register');
// Route::post('frontend/register', [RegisterController::class, 'storeFrontend'])->name('frontend.register');

Route::get('detail/{id}', [CustomerController::class, 'detail'])->name('frontend.detailcustomer')->middleware('auth');
// Group route untuk customer
Route::middleware('is.customer')->group(function () {
    // Route untuk menampilkan halaman akun customer
    Route::get('/customer/akun/{id}', [CustomerController::class, 'akun'])
        ->name('customer.akun');

    // Route untuk mengupdate data akun customer
    Route::put('/customer/updateakun/{id}', [CustomerController::class, 'updateAkun'])
        ->name('customer.updateakun');
        
    // Route untuk menambahkan produk ke keranjang
    Route::post('add-to-cart/{id}', [OrderController::class, 'addToCart'])->name('order.addToCart');
    Route::get('cart', [OrderController::class, 'viewCart'])->name('order.cart');
    Route::post('cart/update/{id}', [OrderController::class, 'updateCart'])->name('order.updateCart');
    Route::post('remove/{id}', [OrderController::class, 'removeFromCart'])->name('order.remove');

    // Ongkir
    Route::post('select-shipping', [OrderController::class, 'selectShipping'])->name('order.selectShipping');
    Route::get('provinces', [OrderController::class, 'getProvinces']);
    Route::get('cities', [OrderController::class, 'getCities']);
    Route::post('cost', [OrderController::class, 'getCost']);
    Route::post('updateongkir', [OrderController::class, 'updateongkir'])->name('order.updateongkir');

    //midtrans
    Route::get('select-payment', [OrderController::class, 'selectPayment'])->name('order.selectpayment');
    // Rute untuk halaman checkout
    Route::get('/order/complete', [OrderController::class, 'complete'])->name('order.complete');

    // Route history
    Route::get('history', [OrderController::class, 'orderHistory'])->name('order.history');
    Route::get('order/invoice/{id}', [OrderController::class, 'invoiceFrontend'])->name('order.invoice');




});



// Route untuk laporan user 
Route::get('backend/laporan/formuser', [UserController::class, 'formUser'])->name('backend.laporan.formuser')->middleware('auth');
Route::post('backend/laporan/cetakuser', [UserController::class, 'cetakUser'])->name('backend.laporan.cetakuser')->middleware('auth');
// Route untuk laporan produk
Route::get('backend/laporan/formproduk', [ProdukController::class, 'formProduk'])->name('backend.laporan.formproduk')->middleware('auth');
Route::post('backend/laporan/cetakproduk', [ProdukController::class, 'cetakProduk'])->name('backend.laporan.cetakproduk')->middleware('auth');
// Route untuk laporan order
Route::get('backend/laporan/formorderproses', [OrderController::class, 'formOrderProses'])->name('backend.laporan.formorderproses')->middleware('auth');
Route::post('backend/laporan/cetakorderproses', [OrderController::class, 'cetakOrderProses'])->name('backend.laporan.cetakorderproses')->middleware('auth');
Route::get('backend/laporan/formorderselesai', [OrderController::class, 'formOrderSelesai'])->name('backend.laporan.formorderselesai')->middleware('auth');
Route::post('backend/laporan/cetakorderselesai', [OrderController::class, 'cetakOrderSelesai'])->name('backend.laporan.cetakorderselesai')->middleware('auth');
// Route untuk data pesanan
Route::get('pesanan/proses', [OrderController::class, 'statusProses'])->name('pesanan.proses')->middleware('auth');
Route::get('pesanan/selesai', [OrderController::class, 'statusSelesai'])->name('pesanan.selesai')->middleware('auth');
Route::get('pesanan/detail/{id}', [OrderController::class, 'statusDetail'])->name('pesanan.detail')->middleware('auth');
Route::put('pesanan/update/{id}', [OrderController::class, 'statusUpdate'])->name('pesanan.update')->middleware('auth');
Route::get('pesanan/invoice/{id}', [OrderController::class, 'invoiceBackend'])->name('pesanan.invoice')->middleware('auth');
// Route untuk menambahkan foto 
Route::post('foto-produk/store', [ProdukController::class, 'storeFoto'])->name('backend.foto_produk.store')->middleware('auth');
// Route untuk menghapus foto 
Route::delete('foto-produk/{id}', [ProdukController::class, 'destroyFoto'])->name('backend.foto_produk.destroy')->middleware('auth');
// Route untuk detail customer
// Route::get('backend/customer/detail', [CustomerController::class, 'detail'])->name('backend.customer.detail')->middleware('auth');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Frontend
Route::get('/beranda', [BerandaController::class, 'index'])->name('beranda');
Route::get('/produk/detail/{id}', [ProdukController::class, 'detail'])->name('produk.detail');
Route::get('/produk/kategori/{id}', [ProdukController::class, 'filterKategori'])->name('produk.kategori');
Route::get('/produk/all', [ProdukController::class, 'produkAll'])->name('produk.all');
Route::get('/profil', [PageFrontend::class, 'profil'])->name('frontend.profil');
Route::get('/carapesan', [PageFrontend::class, 'carapesan'])->name('frontend.carapesan');
Route::get('/lokasi', [PageFrontend::class, 'lokasi'])->name('frontend.lokasi');

//API Google
Route::get('/auth/redirect', [CustomerController::class, 'redirect'])->name('auth.redirect');
Route::get('/auth/google/callback', [CustomerController::class, 'callback'])->name('auth.callback');

// Logout
Route::post('/logout', [CustomerController::class, 'logout'])->name('logout');

Route::get('/list-ongkir', function () {
    $response = Http::withHeaders([
        'key' => 'LyUjjMfTa79ac68feb60f880wURK3uFo' // Ganti dengan API key asli
    ])->get('https://api.rajaongkir.com/starter/city');
    
    return $response->json();
});

Route::get('/cek-ongkir', function () {
    return view('frontend/ongkir');
});

Route::get('/provinces', [RajaOngkirController::class, 'getProvinces']);
Route::get('/cities', [RajaOngkirController::class, 'getCities']);
Route::post('/cost', [RajaOngkirController::class, 'getCost']);


Route::get('/test-biteship', function() {
    $response = Http::withHeaders([
        'Authorization' => 'Bearer biteship_live.eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJuYW1lIjoiVGVzdCBhcGkgdjIiLCJ1c2VySWQiOiI2ODA3Y2JmYmJjMDdkOTAwMTFjY2ViNTQiLCJpYXQiOjE3NDUzNDIwNTR9.wiN_QbxKlPoYSqXMOq2P0_eIRKL8u_LI3n8Dr1GD1wY',
        'Content-Type' => 'application/json'
    ])->get('https://api.biteship.com/v1/couriers');
    
    dd($response->json());
});

Route::get('/list-ongkir2', function () {
    $response = Http::withHeaders([
        'key' => 'LyUjjMfTa79ac68feb60f880wURK3uFo' // Ganti dengan API key asli
    ])->get('https://rajaongkir.komerce.id/api/v1/destination/domestic-destination');
    
    return $response->json(); // Lebih baik return daripada dd() untuk produksi
});

Route::get('/cek-api-key', function () {
    $response = Http::withHeaders([
        'accept' => 'application/json',
        'key' => ('LyUjjMfTa79ac68feb60f880wURK3uFo'),
    ])->get('https://rajaongkir.komerce.id/api/v1/destination/domestic-destination');

    dd($response->json());

});

// cek_raja_ongkir_v2
Route::get('/cek_raja_ongkir_v2', function () {
    return view('frontend/ongkir_v2');
});
Route::get('/ongkir/get-destination', [RajaOngkirControllerV2::class, 'getDestination']);
Route::post('/ongkir/calculate', [RajaOngkirControllerV2::class, 'calculateOngkir']);

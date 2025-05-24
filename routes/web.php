<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\RajaOngkirController;
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
// Route::prefix('backend')->middleware('auth')->group(function () {
//     Route::get('customer', [UserController::class, 'customer'])->name('backend.customer');
//     Route::get('createcustomer', [UserController::class, 'createcustomer'])->name('backend.createcustomer');
//     Route::post('storecustomer', [UserController::class, 'storecustomer'])->name('backend.storecustomer');
//     Route::get('editcustomer/{id}', [UserController::class, 'editcustomer'])->name('backend.editcustomer');
//     Route::put('updatecustomer/{id}', [UserController::class, 'updatecustomer'])->name('backend.updatecustomer');
// });

// Route untuk customer
Route::resource('backend/customer', CustomerController::class, ['as' => 'backend'])->middleware('auth');


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



});



// Route untuk laporan user 
Route::get('backend/laporan/formuser', [UserController::class, 'formUser'])->name('backend.laporan.formuser')->middleware('auth');
Route::post('backend/laporan/cetakuser', [UserController::class, 'cetakUser'])->name('backend.laporan.cetakuser')->middleware('auth');
// Route untuk laporan produk
Route::get('backend/laporan/formproduk', [ProdukController::class, 'formProduk'])->name('backend.laporan.formproduk')->middleware('auth');
Route::post('backend/laporan/cetakproduk', [ProdukController::class, 'cetakProduk'])->name('backend.laporan.cetakproduk')->middleware('auth');
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

//API Google
Route::get('/auth/redirect', [CustomerController::class, 'redirect'])->name('auth.redirect');
Route::get('/auth/google/callback', [CustomerController::class, 'callback'])->name('auth.callback');

// Logout
Route::post('/logout', [CustomerController::class, 'logout'])->name('logout');

Route::get('/list-ongkir', function () {
    $response = Http::withHeaders([
        'key' => '794a5d197b9cb469ae958ed043ccf921' // Ganti dengan API key asli
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
        'key' => env('RAJAONGKIR_API_KEY'),
    ])->get('https://rajaongkir.komerce.id/api/v1/destination/domestic-destination');

    dd($response->json());

    });


<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Produk;
use App\Models\User;
use Illuminate\Http\Request;
use stdClass;

class BerandaController extends Controller
{
    public function berandaBackend()
    {
        $produk = Produk::all()->count();
        $user = User::all()->count();
        $kategori = Kategori::all()->count();
        $customer = User::where('role','2')->count();


        return view('backend.v_beranda.index', [
            'judul' => 'Beranda',
            'sub' => 'Halaman Beranda',
            'produk' => $produk,
            'user' => $user,
            'kategori' => $kategori,
            'customer' => $customer,

        ]);
    }
    public function index()
    {
        $produk = Produk::where('status', 1)->orderBy('updated_at', 'desc')->paginate(6);
        return view('frontend.v_beranda.index', [
            'judul' => 'Halan Beranda',
            'produk' => $produk,
        ]);
    }

}

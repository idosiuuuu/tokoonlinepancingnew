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
        $user = User::where('role', '!=', '2')->count();
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
}

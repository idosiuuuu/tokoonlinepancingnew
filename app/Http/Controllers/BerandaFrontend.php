<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;

class BerandaFrontend extends Controller
{
    public function berandaBackend()
    {
        return view('frontend.v_beranda.index', [
            'judul' => 'Beranda',
            'sub' => 'Halaman Beranda'
        ]);
    }

    public function index()
    {
        $produk = Produk::where('status', 1)->orderBy('updated_at', 'desc')->paginate(6);
        return view('frontend.v_beranda.index', [
            'judul' => 'Halaman Beranda',
            'produk' => $produk,
        ]);
    }
}

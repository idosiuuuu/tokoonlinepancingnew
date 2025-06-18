<?php

namespace App\Http\Controllers;


class PageFrontend extends Controller
{
    public function profil()
    {
        return view('frontend.v_page.profil', [
            'judul' => 'PROFIL',
            'subJudul' => 'dika fishing',
        ]);
    }

    public function carapesan()
    {
        return view('frontend.v_page.carapesan', [
            'judul' => 'CARA PESAN',
            'subJudul' => 'dika fishing',
        ]);
    }

    public function lokasi()
    {
        return view('frontend.v_page.lokasi', [
            'judul' => 'LOKASI',
            'subJudul' => 'dika fishing',
        ]);
    }
}

<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Kategori;
use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'nama' => 'Administrator',
            'email' => 'admin@gmail.com',
            'role' => '1',
            'status' => 1,
            'hp' => '0812345678901',
            'password' => bcrypt('P@55word'),
        ]);
        User::create([
            'nama' => 'Andika  Srigati',
            'email' => 'andika@gmail.com',
            'role' => '0',
            'status' => 1,
            'hp' => '0812345678901',
            'password' => bcrypt('P@55word'),
        ]);
        User::create([
            'nama' => 'Firdaus',
            'email' => 'firdaus@gmail.com',
            'role' => '0',
            'status' => 0,
            'hp' => '0812345678901',
            'password' => bcrypt('P@55word'),
        ]);
        #data kategori 
        Kategori::create([
            'nama_kategori' => 'Alat Pancing',
        ]);
        Kategori::create([
            'nama_kategori' => 'Umpan',
        ]);
        Kategori::create([
            'nama_kategori' => 'Aksesori',
        ]);
        Kategori::create([
            'nama_kategori' => 'Pakaian',
        ]);
        Kategori::create([
            'nama_kategori' => 'Perlengkapan Tambahan',
        ]);
    }
}

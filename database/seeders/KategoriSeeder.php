<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kategoris')->insert([
            [
                'nama' => 'Sastra',
                'deskripsi' => 'Buku-buku sastra',
            ], [
                'nama' => 'Komik',
                'deskripsi' => 'Buku-buku komik yang lihai seperti ayam bertelur',
            ], [
                'nama' => 'Novel',
                'deskripsi' => 'Cerita yang panjang dan menguras waktu',
            ], [
                'nama' => 'Doa-Doa',
                'deskripsi' => 'Buku-buku doa yang mengajarkan kita untuk berdoa',
            ], [
                'nama' => 'Dongeng',
                'deskripsi' => 'Dongeng anak sebelum tidur, agar bermimpi indah',
            ]
        ]);
    }
}

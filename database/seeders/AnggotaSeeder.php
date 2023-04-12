<?php

namespace Database\Seeders;

use App\Models\Anggota;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AnggotaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 20; $i++) {
            Anggota::create([
                'nama' => fake()->name,
                'alamat' => fake()->address,
                'no_telp' => fake()->phoneNumber,
            ]);
        }
    }
}

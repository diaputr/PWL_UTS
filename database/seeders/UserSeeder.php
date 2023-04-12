<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Diah Putri Nofianti',
            'email' => 'diahputrinofianti@gmail.com',
            'password' => Hash::make('666666'),
        ]);
        User::create([
            'name' => 'Agus Prayogi',
            'email' => 'agus21apy@gmail.com',
            'password' => Hash::make('123456'),
        ]);
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Buku>
 */
class BukuFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'kode' => 'BK' . rand(1, 9999),
            'kategori_id' => rand(1, 5),
            'judul' => fake()->sentence(2),
            'penulis' => fake()->firstName(),
            'penerbit' => fake()->company(),
            'th_terbit' => fake()->year(),
        ];
    }
}

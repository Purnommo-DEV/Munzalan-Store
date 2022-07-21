<?php

namespace Database\Factories;

use App\Models\Produk;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProdukFactory extends Factory
{
    protected $model = Produk::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */

    
    public function definition()
    {
        $nama_produk = $this->faker->unique()->words($nb=4, $asText=true);
        $slug = Str::slug($nama_produk);
        return [
            'name' => $nama_produk,
            'slug' => $slug,
            'deskripsi_singkat' => $this->faker->text(200),
            'deskripsi_lengkap' => $this->faker->text(200),
            'harga' => $this->faker->numberBetween(10000,120000),
            'diskon' => $this->faker->numberBetween(0,80),
            'kategori_id' => $this->faker->numberBetween(1,20)
        ];
    }
}

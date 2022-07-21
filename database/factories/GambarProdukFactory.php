<?php

namespace Database\Factories;

use App\Models\GambarProduk;
use Illuminate\Database\Eloquent\Factories\Factory;

class GambarProdukFactory extends Factory
{
    protected $model = GambarProduk::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'produk_id' => $this->faker->unique()->numberBetween(1,20),
            'gambar1' => 'digital_'. $this->faker->numberBetween(1,18).'.jpg',
            'gambar2' => 'digital_'. $this->faker->numberBetween(2,19).'.jpg',
            'gambar3' => 'digital_'. $this->faker->numberBetween(3,20).'.jpg',
            'gambar4' => 'digital_'. $this->faker->numberBetween(4,21).'.jpg',
            'gambar5' => 'digital_'. $this->faker->numberBetween(5,22).'.jpg',
        ];
    }
}

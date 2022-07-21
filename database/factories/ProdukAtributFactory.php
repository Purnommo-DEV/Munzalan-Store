<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\ProdukAtribut;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProdukAtributFactory extends Factory
{
    protected $model = ProdukAtribut::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */

    
    public function definition()
    {
        $produk_atribut = $this->faker->unique()->words($nb=4, $asText=true);
        $slug = Str::slug($produk_atribut);
        return [
            'produk_id' => $this->faker->numberBetween(1,20),
            'ukuran' => $this->faker->randomElement(['M','L','X','XL','XXL','XXX']),
            'stok' => $this->faker->numberBetween(2,28)
        ];
    }
}

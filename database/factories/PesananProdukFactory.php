<?php

namespace Database\Factories;

use App\Models\PesananProduk;
use Illuminate\Database\Eloquent\Factories\Factory;

class PesananProdukFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = PesananProduk::class;
    public function definition()
    {
        return [
            'pesanan_id'=>$this->faker->numberBetween(35,131),
            'produk_id'=>$this->faker->numberBetween(1,5),
            'user_id'=>$this->faker->numberBetween(32,59),
            'nama_produk'=>$this->faker->randomElement(['ut qui laborum ratione','fuga laborum eos sed','magnam voluptatem sit tenetur',
                'voluptatem et expedita explicabo','eum perferendis perspiciatis dolor']),
            'ukuran_produk'=>$this->faker->randomElement(['M','L','X','XL','XXL','XXX']),
            'harga_produk'=>$this->faker->numberBetween(100000,300000),
            'kuantitas'=>$this->faker->numberBetween(1,10),
            'status_penilaian'=>$this->faker->randomElement(['0','1']),
        ];
    }
}

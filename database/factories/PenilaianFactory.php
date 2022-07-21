<?php

namespace Database\Factories;

use App\Models\Penilaian;
use Illuminate\Database\Eloquent\Factories\Factory;

class PenilaianFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Penilaian::class;
    public function definition()
    {
        return [
            'user_id'=>$this->faker->numberBetween(32,59),
            'produk_id'=>$this->faker->numberBetween(1,5),
            'bintang'=>$this->faker->numberBetween(1,5),
            'gambar'=>$this->faker->text(),
            'komentar'=>$this->faker->text(),
            'created_at' => $this->faker->randomElement(['2022-05-30 01:21:04', '2022-05-29 01:21:04', '2022-05-12 01:21:04', '2022-05-10 01:21:04']),
            'updated_at' => $this->faker->randomElement(['2022-05-30 01:21:04', '2022-05-29 01:21:04', '2022-05-12 01:21:04', '2022-05-10 01:21:04'])
        ];
    }
}

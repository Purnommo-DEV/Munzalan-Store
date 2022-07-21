<?php

namespace Database\Factories;

use App\Models\Kategori;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class KategoriFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Kategori::class;

    public function definition()
    {
            $nama_kategori = $this->faker->unique()->words($nb=2, $asText=true);
            $slug = Str::slug($nama_kategori);
            return [
                'name' => $nama_kategori,
                'slug' => $slug
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\AlamatPengiriman;
use Illuminate\Database\Eloquent\Factories\Factory;

class AlamatPengirimanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = AlamatPengiriman::class;

    public function definition()
    {
        return [
            'user_id'=>$this->faker->numberBetween(112,59),
            'alamat'=>'Jl.User',
            'kota_id'=>$this->faker->numberBetween(1,25),
            'negara'=>'Indonesia',
            'provinsi_id'=>$this->faker->numberBetween(1,21),
            'kode_pos'=>'12122',
            'nomor_hp'=>$this->faker->phoneNumber(),
            'alamat_utama'=>'1',
            'status'=>'1'
        ];
    }
}

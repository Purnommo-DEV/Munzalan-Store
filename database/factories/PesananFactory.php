<?php

namespace Database\Factories;

use App\Models\Pesanan;
use Illuminate\Database\Eloquent\Factories\Factory;

class PesananFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Pesanan::class;
    public function definition()
    {
        return [
            'user_id'=>$this->faker->numberBetween(32,59),
            'alamat_id'=>$this->faker->numberBetween(16,37),
            'total_bayar'=>$this->faker->unique()->numberBetween(100000,300000),
            'metode_pembayaran'=>'TF',
            'total_berat'=>$this->faker->numberBetween(100,500),
            'status_pesanan'=>$this->faker->randomElement(['Pending','Dikemas', 'Dikirim', 'Pesanan Di Terima']),
            'ongkos_kirim'=>$this->faker->numberBetween(12000,52000),
            'pengiriman'=>$this->faker->randomElement(['jasaKirimOKE','jasaKirimREG']),
            'resi'=>$this->faker->numberBetween(10000000000, 20000000000),
        ];
    }
}

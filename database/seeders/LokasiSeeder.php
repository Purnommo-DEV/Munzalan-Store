<?php

namespace Database\Seeders;

use App\Models\Kota;
use App\Models\Provinsi;
use Illuminate\Database\Seeder;
use Kavist\RajaOngkir\Facades\RajaOngkir;

class LokasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $daftarProvinsi = RajaOngkir::provinsi()->all();
        foreach ($daftarProvinsi as $provinsiRow) {
            Provinsi::create([
                'id' => $provinsiRow['province_id'],
                'name'        => $provinsiRow['province'],
            ]);
            $daftarKota = RajaOngkir::kota()->dariProvinsi($provinsiRow['province_id'])->get();
            foreach ($daftarKota as $kotaRow) {
                Kota::create([
                    'provinsi_id'   => $provinsiRow['province_id'],
                    'id'       => $kotaRow['city_id'],
                    'name'          => $kotaRow['city_name'],
                ]);
            }
        }

    }
}

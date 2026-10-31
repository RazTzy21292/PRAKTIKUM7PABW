<?php

namespace Database\Seeders;

use App\Models\Laporan;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class LaporanSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        $kecamatan = [
            'Dayeuhkolot', 'Baleendah', 'Bojongsoang', 'Rancaekek', 'Majalaya',
            'Banjaran', 'Pameungpeuk', 'Katapang', 'Cileunyi', 'Ciparay',
        ];

        for ($i = 0; $i < 20; $i++) {
            Laporan::create([
                'nama_pelapor' => $faker->name(),
                'no_hp' => $faker->phoneNumber(),
                'lokasi' => $faker->streetAddress(),
                'kecamatan' => $faker->randomElement($kecamatan),
                'tinggi_air' => $faker->numberBetween(10, 150),
                'keterangan' => $faker->sentence(),
                'foto' => '',
                'status' => $faker->randomElement(['Menunggu', 'Diproses', 'Selesai']),
            ]);
        }
    }
}
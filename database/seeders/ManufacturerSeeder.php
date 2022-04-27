<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ManufacturerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $manufacturers = ['Audi', 'Bmw', 'Skoda', 'Opel', 'Renault', 'Fiat', 'Volkswagen'];
        foreach ($manufacturers as $manufacturer) {
            DB::table('manufacturers')->insert([
                'name' => $manufacturer,
            ]);
        }
    }
}

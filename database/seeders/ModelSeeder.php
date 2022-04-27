<?php

namespace Database\Seeders;

use App\Models\Manufacturer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $models = [
            'Audi' => ['A8', 'A7', 'A6', 'A4', 'A3', 'A2', 'Q7', 'Q5', 'Q3'],
            'Bmw' => ['3 series', '7 series', '5 series', 'X6', 'X5', 'X3', 'X2', 'X1'],
            'Skoda' => ['Fabia', 'Octavia', 'Superb'],
            'Opel' => ['Astra', 'Vectra', 'Zafira', 'Omega'],
            'Renault' => ['Laguna', 'Megane', 'Talisman'],
            'Fiat' => ['Multipla'],
            'Volkswagen' => ['Passat', 'Golf', 'Polo', 'Tiguan', 'Tuareg', 'Bora']
        ];
        $manufacturers = Manufacturer::all();

        foreach ($manufacturers as $manufacturer) {
            if(array_key_exists($manufacturer->name, $models)) {
                foreach ($models[$manufacturer->name] as $model) {
                    DB::table('models')->insert([
                        'name' => $model,
                        'manufacturer_id' => $manufacturer->id
                    ]);
                }
            }
        }
    }
}

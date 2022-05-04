<?php

namespace Database\Factories;

use App\Models\Manufacturer;
use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ad>
 */
class AdFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $adTitle = $this->faker->text(40);
        //$manufacturerId = rand(1, 7);
        //$modelId = Manufacturer::find($manufacturerId)->models()->inRandomOrder()->first()->id;

        $modelId = rand(1,34);
        $manufacturerId = Model::find($modelId)->manufacturer_id;

        return [
            'title' => $adTitle,
            'content' => $this->faker->text(150),
            'image' => $this->faker->imageUrl(),
            'user_id' => rand(1,3),
            'slug' => Str::slug($adTitle),
            'views' => rand(0,90),
            'category_id' => 1,
            'active' => 1,
            'vin' => strtoupper(Str::random(11)).rand(10000, 99999),
            'price' => $this->faker->randomFloat(0, 100, 10000),
            'manufacturer_id' => $manufacturerId,
            'model_id' => $modelId,
            'year' => rand(1990, 2022),
            'type_id' => rand(1, 7),
            'color_id' => rand(1, 13),
        ];
    }
}

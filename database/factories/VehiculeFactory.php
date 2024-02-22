<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehicule>
 */
class VehiculeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'immatriculation'=>$this->faker->swiftBicNumber,
            'marque'=>$this->faker->company,
            'Desc'=>$this->faker->realText($maxNbChars = 300, $indexSize = 2),
            'permis'=>'A,B,ABCD',
        ];
    }
}

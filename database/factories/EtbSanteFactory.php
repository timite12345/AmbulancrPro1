<?php

namespace Database\Factories;

use App\Models\TypeEtb;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EtbSante>
 */
class EtbSanteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nom'=>$this->faker->name(),
            'adresse'=>$this->faker->address(),
            'tel'=>$this->faker->phoneNumber(),
            'email'=>fake()->unique()->companyEmail(),
            'typeEtb'=>TypeEtb::all()->random()->id,
            
        ];
    }
}

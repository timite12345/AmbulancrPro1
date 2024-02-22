<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Chauffeur>
 */
class ChauffeurFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nom'=>$this->faker->firstName(),
            'Prenom'=>$this->faker->lastName(),
            'tel'=> $this->faker->phoneNumber(),
            'email'=> fake()->unique()->safeEmail(),
            'adresse'=>$this->faker->address(),
            'permis'=>'A,B,ABCD',
        ];
    }
}

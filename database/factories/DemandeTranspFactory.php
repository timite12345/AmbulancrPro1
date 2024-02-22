<?php

namespace Database\Factories;

use App\Models\EtbSante;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DemandeTransp>
 */
class DemandeTranspFactory extends Factory
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
            'dateN'=>$this->faker->dateTimeThisYear(),
            'conditionTransp'=>$this->faker->realText($maxNbChars = 300, $indexSize = 2),
            'adresseDep'=>$this->faker->address(),
            'adresseArriv'=>$this->faker->address(),
            'etbSante' => EtbSante::all()->random()->id,
            'estUrgent'=>$this->faker->randomElement($array=array(0,1)),

            
        ];
    }
}

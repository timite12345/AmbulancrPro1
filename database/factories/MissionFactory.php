<?php

namespace Database\Factories;

use App\Models\Chauffeur;
use App\Models\DemandeTransp;
use App\Models\Vehicule;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Mission>
 */
class MissionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'heureDeb'=>$this->faker->date(),
            'heureFin'=>$this->faker->date,
            'commentaire'=>$this->faker->realText($maxNbChars = 300, $indexSize = 2),
            'chauffeurP'=>Chauffeur::all()->random()->id,
            'chauffeurS'=>Chauffeur::all()->random()->id,
            'vehicule' => Vehicule::all()->random()->id,
            'demande'=>DemandeTransp::all()->random()->id,
            
        ];
    }
}

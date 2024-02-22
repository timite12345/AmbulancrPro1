<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Chauffeur;
use App\Models\DemandeTransp;
use App\Models\EtbSante;
use App\Models\Mission;
use App\Models\Vehicule;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('type_users')->insert([
            'name' => 'Operateur',
        ]);

         DB::table('type_users')->insert([
            'name' => 'Planning',
        ]);

         DB::table('type_users')->insert([
            'name' => 'Facturation',
        ]);


        DB::table('type_etbs')->insert([
            'name' => 'Hopital',
        ]);

         DB::table('type_etbs')->insert([
            'name' => 'Clinique',
        ]);

         DB::table('type_etbs')->insert([
            'name' => 'Dispensaire',
        ]);

        DB::table('type_etbs')->insert([
            'name' => 'CHR',
        ]);
        DB::table('type_etbs')->insert([
            'name' => 'CHU',
        ]);

        Vehicule::factory(20)->create();
        Chauffeur::factory(20)->create();
        // EtbSante::factory(20)->create();
        // DemandeTransp::factory(20)->create();
        // Mission::factory(20)->create();
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}

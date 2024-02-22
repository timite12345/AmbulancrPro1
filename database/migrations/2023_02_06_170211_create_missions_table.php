<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('missions', function (Blueprint $table) {
            $table->id(); 
            $table->dateTime('heureDeb')->nullable()->default(null);
            $table->dateTime('heureFin')->nullable()->default(null);
            $table->text('commentaire')->nullable();
            $table->foreignId('chauffeurP')->constrained('chauffeurs');
            $table->foreignId('chauffeurS')->constrained('chauffeurs')->nullable();;
            $table->foreignId('vehicule')->constrained('vehicules');
            $table->foreignId('demande')->constrained('demande_transps');
            $table->boolean('estFacturer')->default(false);
            $table->float('prix');
            //mamoud
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('missions');
    }
};

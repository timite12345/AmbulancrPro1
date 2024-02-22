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
        Schema::create('demande_transps', function (Blueprint $table) {
            $table->id();
            $table->string('nom')->nullable();
            $table->string('prenom')->nullable();
            $table->string('adresse')->nullable();
            $table->string('tel')->nullable();
            $table->string('email')->unique();
            $table->text('conditionTransp')->nullable();
            $table->string('adresseDep')->nullable();
            $table->string('adresseArriv')->nullable();
            $table->boolean('estUrgent')->default(false);
            $table->boolean('estTraiter')->default(false);
            $table->foreignId('etbSante')->constrained('etb_santes');
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
        Schema::dropIfExists('demande_transps');
    }
};

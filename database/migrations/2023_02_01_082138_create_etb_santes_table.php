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
        Schema::create('etb_santes', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('adresse')->nullable();
            $table->string('tel')->nullable();
            $table->string('email')->unique();
            $table->boolean('estValide')->default(1);
            $table->foreignId('typeEtb')->references('id')->on('type_etbs');
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
        Schema::dropIfExists('etb_santes');
    }
};

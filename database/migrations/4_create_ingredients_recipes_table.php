<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ingredient_recipe', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("id_ingredient");
            $table->bigInteger("id_recipe");
            $table->foreign('id_recipe') // reference id de l'autre table
                ->references('id') // reference a l'id du secteur 
                ->on('recipe');
            $table->foreign('id_ingredient') // reference id de l'autre table
                ->references('id') // reference a l'id du secteur 
                ->on('ingredient');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};

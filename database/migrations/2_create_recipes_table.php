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
        Schema::create('recipes', function (Blueprint $table) {
            $table->id("id_recipe");
            $table->bigInteger("id");
            $table->string('name_recipe');
            $table->text('description');
            $table->string('picture')->nullable();
            $table->foreign('id') // reference id de l'autre table
                ->references('id') // reference a l'id dans la table
                ->on('users'); // table
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recipes');
    }
};

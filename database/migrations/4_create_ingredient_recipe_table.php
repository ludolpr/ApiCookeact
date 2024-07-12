<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('make', function (Blueprint $table) {
            $table->id();
            $table->foreignId('recipe_id')->constrained()->onDelete('cascade');
            $table->foreignId('ingredient_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('make');
    }
};

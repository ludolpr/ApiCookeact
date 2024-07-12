<?php

use App\Models\Ingredient;
use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource("ingredient", Ingredient::class);
Route::apiResource("recipe", Recipe::class);

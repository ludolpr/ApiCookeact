<?php

use App\Http\Controllers\API\IngredientController;
use App\Http\Controllers\API\RecipeController;
use App\Http\Controllers\API\UserController;
use App\Models\User;
use App\Models\Recipe;
use App\Models\Ingredient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource("ingredient", IngredientController::class);
Route::apiResource("recipe", RecipeController::class);

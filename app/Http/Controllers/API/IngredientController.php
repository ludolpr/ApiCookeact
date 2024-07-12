<?php

namespace App\Http\Controllers\API;

use App\Models\Ingredient;
use Illuminate\Http\Request;

class IngredientController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ingredient = Ingredient::with(["ingredient"])->get();
        return response()->json($ingredient);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "name_ingredient" => "required|max:50",
        ]);
        $ingredient = Ingredient::create(array_merge($request->all()));
        return response()->json([
            "status" => "Success",
            "data" => $ingredient,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Ingredient $ingredient)
    {
        return response()->json($ingredient);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ingredient $ingredient)
    {
        $this->validate($request, [
            "name_ingredient" => "required|max:50",
        ]);

        $ingredient->update($request->all());

        return response()->json([
            "status" => "Mise à jour avec succèss"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ingredient $ingredient)
    {
        $ingredient->delete();

        return response()->json([
            "status" => "Supprimerr avec succèss"
        ]);
    }
}

<?php

namespace App\Http\Controllers\API;

use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class RecipeController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $recipe = Recipe::wit(["recipe"])->get();
        return response()->json($recipe);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "name_recipe" => "required|max:50",
            "descripton" => "required|max:500",
            "picture" => "required|max:255",
        ]);

        $filename = "";
        if ($request->hasFile('picture')) {
            $filenameWithExt = $request->file('picture')->getClientOriginalName();
            $filenameWithoutExt = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('picture')->getClientOriginalExtension();
            $filename = $filenameWithoutExt . '_' . time() . '.' . $extension;
            $path = $request->file('picture')->storeAs('public/uploads', $filename);
        } else {
            $filename = Null;
        }
        $recipe = Recipe::create(array_merge($request->all(), ["picture" => $filename]));
        return response()->json([
            "status" => "Success",
            "data" => $recipe,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Recipe $recipe)
    {
        return response()->json($recipe);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Recipe $recipe)
    {
        $this->validate($request, [
            "name_recipe" => "required|max:50",
            "descripton" => "required|max:500",
            "picture" => "required|max:255",
        ]);

        $recipe->update($request->all());

        return response()->json([
            "status" => "Mise à jour avec succèss"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Recipe $recipe)
    {
        return response()->json([
            "status" => "Supprimer avec succèss"
        ]);
    }
}

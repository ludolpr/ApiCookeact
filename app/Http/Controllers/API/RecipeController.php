<?php

namespace App\Http\Controllers\API;

use App\Models\Recipe;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Récupère toutes les recettes avec leurs ingrédients associés
        $recipes = Recipe::all();
        return response()->json($recipes);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);

        // Valide les données de la requête
        $request->validate([
            'name_recipe' => 'required|max:50', 'id' => "required|integer",
            'description' => 'required|max:500', 'picture' => 'required|image|max:5024', // Assure que le fichier est une image et ne dépasse pas 1MB
        ]);

        // Traite l'upload de l'image
        $filename = "";
        if ($request->hasFile('picture')) {
            $filenameWithExt = $request->file('picture')->getClientOriginalName();
            $filenameWithoutExt = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('picture')->getClientOriginalExtension();
            $filename = $filenameWithoutExt . '_' . time() . '.' . $extension;
            $path = $request->file('picture')->storeAs('public/uploads', $filename);
        } else {
            $filename = null;
        }

        // Crée une nouvelle recette avec les données validées
        $recipe = Recipe::create(array_merge(
            $request->except('picture'), // Exclut le champ 'picture' des données de la requête
            ['picture' => $filename] // Ajoute le nom de fichier de l'image
        ));

        return response()->json([
            'status' => 'Success',
            'data' => $recipe,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Recipe $recipe)
    {
        // Récupère une recette spécifique avec ses ingrédients associés
        $recipe->load('ingredients');
        return response()->json($recipe);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Recipe $recipe)
    {
        // Valide les données de la requête
        $request->validate(['name_recipe' => 'required|max:50', 'description' => 'required|max:500', 'picture' => 'image|max:1024',
            'id' => "required|integer"
             // Assure que le fichier est une image et ne dépasse pas 1MB
        ]);

        // Traite l'upload de l'image si elle est présente
        if ($request->hasFile('picture')) {
            $filenameWithExt = $request->file('picture')->getClientOriginalName();
            $filenameWithoutExt = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('picture')->getClientOriginalExtension();
            $filename = $filenameWithoutExt . '_' . time() . '.' . $extension;
            $path = $request->file('picture')->storeAs('public/uploads', $filename);
            $recipe->picture = $filename;
        }

        // Met à jour les données de la recette
        $recipe->update($request->except('picture'));

        return response()->json([
            'status' => 'Mise à jour avec succès'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Recipe $recipe)
    {
        // dd($recipe);
        // Supprime une recette
        $recipe->delete();

        return response()->json([
            'status' => 'Supprimé avec succès'
        ]);
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;
    protected $fillable = ['name_recipe', 'description', 'picture', 'id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class);
    }
}
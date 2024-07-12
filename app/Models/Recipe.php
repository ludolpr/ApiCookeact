<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_recipe', 'description', 'picture',
    ];
    public function users()
    {
        return $this->belongsToMany(User::class, 'build')->withTimestamps();
    }

    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class, 'make')->withTimestamps();
    }
}

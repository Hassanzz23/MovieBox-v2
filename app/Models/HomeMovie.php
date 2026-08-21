<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Movie;

class HomeMovie extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function movies()
    {
        return $this->hasMany(Movie::class, 'home_movie_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}

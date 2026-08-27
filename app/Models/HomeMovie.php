<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Movie;

class HomeMovie extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'image',
        'year',
        'genre',
        'description',
        'category_id',
        'sort_order',
    ];

    public function movies()
    {
        return $this->hasMany(Movie::class, 'home_movie_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}

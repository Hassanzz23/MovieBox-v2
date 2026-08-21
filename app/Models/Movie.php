<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Models\HomeMovie;

class Movie extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'imdb_id',
        'title',
        'image',
        'year',
        'genre',
        'description',
        'status',
        'rating',
        'category_id',
        'home_movie_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function homeMovie()
    {
        return $this->belongsTo(HomeMovie::class);
    }
    public function favorite()
    {
        return $this->hasOne(Favorite::class);
    }

    protected static function booted(): void
    {
        static::observe(\App\Observers\MovieObserver::class);
    }
}

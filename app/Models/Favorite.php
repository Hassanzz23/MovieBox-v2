<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    protected $fillable = [
        'user_id',
        'todo_id',
    ];

    public function todo()
    {
        return $this->belongsTo(Todo::class);
    }
}
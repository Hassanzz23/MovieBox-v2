<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Category::create([
            'title' => 'Movie',
        ]);

        Category::create([
            'title' => 'TV Show',
        ]);

        Category::create([
            'title' => 'Animation',
        ]);

        Category::create([
            'title' => 'Anime',
        ]);
    }
}

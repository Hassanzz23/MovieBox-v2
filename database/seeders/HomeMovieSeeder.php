<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\HomeMovie;
use Illuminate\Database\Seeder;

class HomeMovieSeeder extends Seeder
{
    public function run(): void
    {
        HomeMovie::truncate();

        $movie = Category::where('title', 'Movie')->first();
        $tvShow = Category::where('title', 'TV Show')->first();
        $animation = Category::where('title', 'Animation')->first();
        $anime = Category::where('title', 'Anime')->first();

        HomeMovie::create([
            'image' => 'interstellar.jpg',
            'title' => 'Interstellar',
            'year' => 2014,
            'genre' => 'Sci-Fi, Drama',
            'category_id' => $movie->id,
            'description' => 'A science fiction movie about space, time and humanity.',
        ]);

        HomeMovie::create([
            'image' => 'inception.jpg',
            'title' => 'Inception',
            'year' => 2010,
            'genre' => 'Action, Sci-Fi',
            'category_id' => $movie->id,
            'description' => 'A story about dreams and the human mind.',
        ]);

        HomeMovie::create([
            'image' => 'dark-knight.jpg',
            'title' => 'The Dark Knight',
            'year' => 2008,
            'genre' => 'Action, Crime',
            'category_id' => $movie->id,
            'description' => 'A superhero crime drama.',
        ]);

        HomeMovie::create([
            'image' => 'forrest-gump.jpg',
            'title' => 'Forrest Gump',
            'year' => 1994,
            'genre' => 'Drama, Romance',
            'category_id' => $movie->id,
            'description' => 'The life story of a man who experiences remarkable events.',
        ]);

        HomeMovie::create([
            'image' => 'the-odyssey.jpg',
            'title' => 'The Odyssey',
            'year' => 2026,
            'genre' => 'Adventure, Drama, Fantasy',
            'category_id' => $movie->id,
            'description' => 'Christopher Nolan’s epic adaptation of Homer’s ancient Greek tale.',
        ]);

        HomeMovie::create([
            'image' => 'spider-man-brand-new-day.jpg',
            'title' => 'Spider-Man: Brand New Day',
            'year' => 2026,
            'genre' => 'Action, Adventure, Superhero',
            'category_id' => $movie->id,
            'description' => 'A new chapter in the Spider-Man story.',
        ]);

        HomeMovie::create([
            'image' => 'breaking-bad.jpg',
            'title' => 'Breaking Bad',
            'year' => 2008,
            'genre' => 'Crime, Drama',
            'category_id' => $tvShow->id,
            'description' => 'A chemistry teacher enters the world of crime.',
        ]);

        HomeMovie::create([
            'image' => 'game-of-thrones.jpg',
            'title' => 'Game of Thrones',
            'year' => 2011,
            'genre' => 'Drama, Fantasy',
            'category_id' => $tvShow->id,
            'description' => 'Several families fight for control of a powerful throne.',
        ]);

        HomeMovie::create([
            'image' => 'stranger-things.jpg',
            'title' => 'Stranger Things',
            'year' => 2016,
            'genre' => 'Drama, Fantasy, Horror',
            'category_id' => $tvShow->id,
            'description' => 'A group of friends discovers mysterious events in their town.',
        ]);

        HomeMovie::create([
            'image' => 'friends.jpg',
            'title' => 'Friends',
            'year' => 1994,
            'genre' => 'Comedy, Romance',
            'category_id' => $tvShow->id,
            'description' => 'Six friends experience life, friendship and relationships together.',
        ]);
        HomeMovie::create([
            'image' => 'dark.jpg',
            'title' => 'Dark',
            'year' => 2017,
            'genre' => 'Drama, Mystery, Sci-Fi',
            'category_id' => $tvShow->id,
            'description' => 'A mysterious story involving time travel and several families.',
        ]);

        HomeMovie::create([
            'image' => 'the-last-of-us.jpg',
            'title' => 'The Last of Us',
            'year' => 2023,
            'genre' => 'Drama, Action',
            'category_id' => $tvShow->id,
            'description' => 'A journey through a dangerous post-apocalyptic world.',
        ]);

        HomeMovie::create([
            'image' => 'toy-story.jpg',
            'title' => 'Toy Story',
            'year' => 1995,
            'genre' => 'Animation, Comedy',
            'category_id' => $animation->id,
            'description' => 'Toys come to life when humans are not around.',
        ]);

        HomeMovie::create([
            'image' => 'wall-e.jpg',
            'title' => 'WALL-E',
            'year' => 2008,
            'genre' => 'Animation, Sci-Fi',
            'category_id' => $animation->id,
            'description' => 'A small robot discovers something that could change humanity.',
        ]);

        HomeMovie::create([
            'image' => 'coco.jpg',
            'title' => 'Coco',
            'year' => 2017,
            'genre' => 'Animation, Fantasy',
            'category_id' => $animation->id,
            'description' => 'A young boy discovers his family history in the world of the dead.',
        ]);

        HomeMovie::create([
            'image' => 'cars.jpg',
            'title' => 'Cars',
            'year' => 2006,
            'genre' => 'Animation, Comedy, Adventure',
            'category_id' => $animation->id,
            'description' => 'A race car learns about friendship and life in a small town.',
        ]);

        HomeMovie::create([ 
            'image' => 'inside-out.jpg',
            'title' => 'Inside Out',
            'year' => 2015,
            'genre' => 'Animation, Adventure, Comedy',
            'category_id' => $animation->id,
            'description' => 'A young girl’s emotions try to help her adapt to a major change in her life.',
        ]);

        HomeMovie::create([
            'image' => 'monsters-university.jpg',
            'title' => 'Monsters University',
            'year' => 2013,
            'genre' => 'Animation, Comedy',
            'category_id' => $animation->id,
            'description' => 'Two young monsters discover that becoming a scarer is not as simple as they expected.',
]);

        HomeMovie::create([
            'image' => 'attack-on-titan.jpg',
            'title' => 'Attack on Titan',
            'year' => 2013,
            'genre' => 'Action, Drama, Fantasy',
            'category_id' => $anime->id,
            'description' => 'Humanity fights for survival against mysterious giants.',
        ]);

        HomeMovie::create([
            'image' => 'death-note.jpg',
            'title' => 'Death Note',
            'year' => 2006,
            'genre' => 'Mystery, Thriller, Supernatural',
            'category_id' => $anime->id,
            'description' => 'A student discovers a mysterious notebook with supernatural powers.',
        ]);

        HomeMovie::create([
            'image' => 'a-silent-voice.jpg',
            'title' => 'A Silent Voice',
            'year' => 2016,
            'genre' => 'Anime, Drama, Romance',
            'category_id' => $anime->id,
            'description' => 'A story about friendship, regret, forgiveness and growing up.',
        ]);

        HomeMovie::create([
            'image' => 'i-want-to-eat-your-pancreas.jpg',
            'title' => 'I Want to Eat Your Pancreas',
            'year' => 2018,
            'genre' => 'Anime, Drama, Romance',
            'category_id' => $anime->id,
            'description' => 'An emotional story about two students who form an unexpected friendship.',
        ]);

        HomeMovie::create([
            'image' => 'haikyu.jpg',
            'title' => 'Haikyu!!',
            'year' => 2014,
            'genre' => 'Anime, Sports, Comedy',
            'category_id' => $anime->id,
            'description' => 'A young volleyball player works with his teammates to reach the top.',
        ]);

        HomeMovie::create([
            'image' => 'one-piece.jpg',
            'title' => 'One Piece',
            'year' => 1999,
            'genre' => 'Action, Adventure, Fantasy',
            'category_id' => $anime->id,
            'description' => 'A young pirate travels the seas in search of a legendary treasure.',
        ]);
    }
}
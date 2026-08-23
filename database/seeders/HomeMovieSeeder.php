<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\HomeMovie;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HomeMovieSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        HomeMovie::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $movie = Category::where('title', 'Movie')->first();
        $tvShow = Category::where('title', 'TV Show')->first();
        $animation = Category::where('title', 'Animation')->first();
        $anime = Category::where('title', 'Anime')->first();

        HomeMovie::create([
            'image' => 'interstellar.jpg',
            'title' => 'Interstellar',
            'imdb_id' => 'tt0816692',
            'year' => 2014,
            'genre' => 'Sci-Fi, Drama',
            'category_id' => $movie->id,
            'description' => 'A science fiction movie about space, time and humanity.',
        ]);

        HomeMovie::create([
            'image' => 'inception.jpg',
            'title' => 'Inception',
            'imdb_id' => 'tt1375666',
            'year' => 2010,
            'genre' => 'Action, Sci-Fi',
            'category_id' => $movie->id,
            'description' => 'A story about dreams and the human mind.',
        ]);

        HomeMovie::create([
            'image' => 'dark-knight.jpg',
            'title' => 'The Dark Knight',
            'imdb_id' => 'tt0468569',
            'year' => 2008,
            'genre' => 'Action, Crime',
            'category_id' => $movie->id,
            'description' => 'A superhero crime drama.',
        ]);

        HomeMovie::create([
            'image' => 'forrest-gump.jpg',
            'title' => 'Forrest Gump',
            'imdb_id' => 'tt0109830',
            'year' => 1994,
            'genre' => 'Drama, Romance',
            'category_id' => $movie->id,
            'description' => 'The life story of a man who experiences remarkable events.',
        ]);

        HomeMovie::create([
            'image' => 'the-odyssey.jpg',
            'title' => 'The Odyssey',
            'imdb_id' => 'tt3480822',
            'year' => 2026,
            'genre' => 'Adventure, Drama, Fantasy',
            'category_id' => $movie->id,
            'description' => 'Christopher Nolan’s epic adaptation of Homer’s ancient Greek tale.',
        ]);

        HomeMovie::create([
            'image' => 'spider-man-brand-new-day.jpg',
            'title' => 'Spider-Man: Brand New Day',
            'imdb_id' => 'tt22084616',
            'year' => 2026,
            'genre' => 'Action, Adventure, Superhero',
            'category_id' => $movie->id,
            'description' => 'A new chapter in the Spider-Man story.',
        ]);

        HomeMovie::create([
            'image' => 'breaking-bad.jpg',
            'title' => 'Breaking Bad',
            'imdb_id' => 'tt0903747',
            'year' => 2008,
            'genre' => 'Crime, Drama',
            'category_id' => $tvShow->id,
            'description' => 'A chemistry teacher enters the world of crime.',
        ]);

        HomeMovie::create([
            'image' => 'game-of-thrones.jpg',
            'title' => 'Game of Thrones',
            'imdb_id' => 'tt0944947',
            'year' => 2011,
            'genre' => 'Drama, Fantasy',
            'category_id' => $tvShow->id,
            'description' => 'Several families fight for control of a powerful throne.',
        ]);

        HomeMovie::create([
            'image' => 'stranger-things.jpg',
            'title' => 'Stranger Things',
            'imdb_id' => 'tt4574334',
            'year' => 2016,
            'genre' => 'Drama, Fantasy, Horror',
            'category_id' => $tvShow->id,
            'description' => 'A group of friends discovers mysterious events in their town.',
        ]);

        HomeMovie::create([
            'image' => 'friends.jpg',
            'title' => 'Friends',
            'imdb_id' => 'tt0108778',
            'year' => 1994,
            'genre' => 'Comedy, Romance',
            'category_id' => $tvShow->id,
            'description' => 'Six friends experience life, friendship and relationships together.',
        ]);

        HomeMovie::create([
            'image' => 'dark.jpg',
            'title' => 'Dark',
            'imdb_id' => 'tt5753856',
            'year' => 2017,
            'genre' => 'Drama, Mystery, Sci-Fi',
            'category_id' => $tvShow->id,
            'description' => 'A mysterious story involving time travel and several families.',
        ]);

        HomeMovie::create([
            'image' => 'the-last-of-us.jpg',
            'title' => 'The Last of Us',
            'imdb_id' => 'tt3581920',
            'year' => 2023,
            'genre' => 'Drama, Action',
            'category_id' => $tvShow->id,
            'description' => 'A journey through a dangerous post-apocalyptic world.',
        ]);

        HomeMovie::create([
            'image' => 'toy-story.jpg',
            'title' => 'Toy Story',
            'imdb_id' => 'tt0114709',
            'year' => 1995,
            'genre' => 'Animation, Comedy',
            'category_id' => $animation->id,
            'description' => 'Toys come to life when humans are not around.',
        ]);

        HomeMovie::create([
            'image' => 'wall-e.jpg',
            'title' => 'WALL-E',
            'imdb_id' => 'tt0910970',
            'year' => 2008,
            'genre' => 'Animation, Sci-Fi',
            'category_id' => $animation->id,
            'description' => 'A small robot discovers something that could change humanity.',
        ]);

        HomeMovie::create([
            'image' => 'coco.jpg',
            'title' => 'Coco',
            'imdb_id' => 'tt2380307',
            'year' => 2017,
            'genre' => 'Animation, Fantasy',
            'category_id' => $animation->id,
            'description' => 'A young boy discovers his family history in the world of the dead.',
        ]);

        HomeMovie::create([
            'image' => 'cars.jpg',
            'title' => 'Cars',
            'imdb_id' => 'tt0317219',
            'year' => 2006,
            'genre' => 'Animation, Comedy, Adventure',
            'category_id' => $animation->id,
            'description' => 'A race car learns about friendship and life in a small town.',
        ]);

        HomeMovie::create([
            'image' => 'inside-out.jpg',
            'title' => 'Inside Out',
            'imdb_id' => 'tt2096673',
            'year' => 2015,
            'genre' => 'Animation, Adventure, Comedy',
            'category_id' => $animation->id,
            'description' => 'A young girl’s emotions try to help her adapt to a major change in her life.',
        ]);

        HomeMovie::create([
            'image' => 'monsters-university.jpg',
            'title' => 'Monsters University',
            'imdb_id' => 'tt1453405',
            'year' => 2013,
            'genre' => 'Animation, Comedy',
            'category_id' => $animation->id,
            'description' => 'Two young monsters discover that becoming a scarer is not as simple as they expected.',
        ]);

        HomeMovie::create([
            'image' => 'attack-on-titan.jpg',
            'title' => 'Attack on Titan',
            'imdb_id' => 'tt2560140',
            'year' => 2013,
            'genre' => 'Action, Drama, Fantasy',
            'category_id' => $anime->id,
            'description' => 'Humanity fights for survival against mysterious giants.',
        ]);

        HomeMovie::create([
            'image' => 'death-note.jpg',
            'title' => 'Death Note',
            'imdb_id' => 'tt0877057',
            'year' => 2006,
            'genre' => 'Mystery, Thriller, Supernatural',
            'category_id' => $anime->id,
            'description' => 'A student discovers a mysterious notebook with supernatural powers.',
        ]);

        HomeMovie::create([
            'image' => 'a-silent-voice.jpg',
            'title' => 'A Silent Voice',
            'imdb_id' => 'tt5323662',
            'year' => 2016,
            'genre' => 'Anime, Drama, Romance',
            'category_id' => $anime->id,
            'description' => 'A story about friendship, regret, forgiveness and growing up.',
        ]);

        HomeMovie::create([
            'image' => 'i-want-to-eat-your-pancreas.jpg',
            'title' => 'I Want to Eat Your Pancreas',
            'imdb_id' => 'tt7236034',
            'year' => 2018,
            'genre' => 'Anime, Drama, Romance',
            'category_id' => $anime->id,
            'description' => 'An emotional story about two students who form an unexpected friendship.',
        ]);

        HomeMovie::create([
            'image' => 'haikyu.jpg',
            'title' => 'Haikyu!!',
            'imdb_id' => 'tt3398540',
            'year' => 2014,
            'genre' => 'Anime, Sports, Comedy',
            'category_id' => $anime->id,
            'description' => 'A young volleyball player works with his teammates to reach the top.',
        ]);

        HomeMovie::create([
            'image' => 'one-piece.jpg',
            'title' => 'One Piece',
            'imdb_id' => 'tt0388629',
            'year' => 1999,
            'genre' => 'Action, Adventure, Fantasy',
            'category_id' => $anime->id,
            'description' => 'A young pirate travels the seas in search of a legendary treasure.',
        ]);
    }
}

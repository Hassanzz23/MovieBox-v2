<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('movies', function (Blueprint $table) {

            $table->dropForeign('todos_home_movie_id_foreign');

            $table->foreign('home_movie_id')
                ->references('id')
                ->on('home_movies')
                ->nullOnDelete();

        });
    }

    public function down(): void
    {
        Schema::table('movies', function (Blueprint $table) {

            $table->dropForeign('todos_home_movie_id_foreign');

            $table->foreign('home_movie_id')
                ->references('id')
                ->on('home_movies')
                ->cascadeOnDelete();

        });
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('todos', function (Blueprint $table) {
            $table->foreignId('home_movie_id')
                ->nullable()
                ->after('user_id')
                ->constrained('home_movies')
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('todos', function (Blueprint $table) {
            $table->dropForeign(['home_movie_id']);
            $table->dropColumn('home_movie_id');
        });
    }
};
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('todos', function (Blueprint $table) {
            $table->unsignedSmallInteger('year')->nullable()->after('title');
            $table->string('type')->default('movie')->after('year');
            $table->string('genre')->nullable()->after('type');
        });
    }

    public function down(): void
    {
        Schema::table('todos', function (Blueprint $table) {
            $table->dropColumn([
                'year',
                'type',
                'genre',
            ]);
        });
    }
};
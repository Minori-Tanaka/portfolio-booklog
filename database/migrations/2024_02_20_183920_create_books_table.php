<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title', 50);
            $table->string('author', 50);
            $table->integer('published_year');
            $table->longText('cover_photo')->nullable();
            $table->unsignedBigInteger('genre_id');
            $table->text('description');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('genre_id')->references('id')->on('genres');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};

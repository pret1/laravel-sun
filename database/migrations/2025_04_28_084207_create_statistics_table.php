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
        Schema::create('statistics', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->integer('posts_count');
            $table->integer('comments_count');
            $table->integer('likes_count');
            $table->integer('views_count');
            $table->decimal('likes_to_views_ratio', 5, 2)->nullable();
            $table->decimal('likes_to_comments_ratio', 5, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('statistics');
    }
};

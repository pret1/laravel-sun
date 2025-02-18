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
        Schema::table('posts', function (Blueprint $table) {
            $table->text('title');
            $table->string('content');
            $table->string('author');
            $table->boolean('is_published')->default(false);
            $table->unsignedInteger('category_id');
            $table->unsignedInteger('like')->default(0);
            $table->string('image')->nullable();
            $table->string('tag');
            $table->unsignedInteger('views')->default(0);
            $table->dateTime('published_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('title');
            $table->dropColumn('content');
            $table->dropColumn('author');
            $table->dropColumn('is_published');
            $table->dropColumn('category_id');
            $table->dropColumn('like');
            $table->dropColumn('image');
            $table->dropColumn('tag');
            $table->dropColumn('views');
            $table->dropColumn('published_at');
        });
    }
};

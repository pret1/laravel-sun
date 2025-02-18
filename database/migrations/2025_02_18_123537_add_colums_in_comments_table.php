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
        Schema::table('comments', function (Blueprint $table) {
            $table->unsignedBigInteger('post_id')->nullable();
            $table->text('content');
            $table->unsignedBigInteger('profile_id')->nullable();
            $table->boolean('status')->default(true);
            $table->unsignedBigInteger('parent_id');
            $table->unsignedBigInteger('like');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->dropColumn('post_id');
            $table->dropColumn('content');
            $table->dropColumn('profile_id');
            $table->dropColumn('status');
            $table->dropColumn('parent_id');
            $table->dropColumn('like');
        });
    }
};

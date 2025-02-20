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
            $table->unsignedBigInteger('profile_id')->index()->change();
            $table->foreign('profile_id')->references('id')->on('profiles');
            $table->unsignedBigInteger('parent_id')->index()->nullable()->change();
            $table->foreign('parent_id')->references('id')->on('comments');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->dropForeign(['parent_id']);
            $table->dropIndex(['parent_id']);
            $table->unsignedBigInteger('parent_id')->change();
            $table->dropForeign(['profile_id']);
            $table->dropIndex(['profile_id']);
            $table->unsignedBigInteger('profile_id')->nullable()->change();
        });
    }
};

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
            $table->dropColumn(['post_id', 'like', 'wrong_status', 'enum_status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->unsignedBigInteger('post_id')->nullable();
            $table->unsignedBigInteger('like')->nullable();
            $table->smallInteger('wrong_status')->default(0)->nullable();
            $table->enum('enum_status', [['pending', 'accepted', 'rejected']]);
        });
    }
};

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
        Schema::create('db_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->integer('insert_count')->default(0);
            $table->integer('update_count')->default(0);
            $table->integer('select_count')->default(0);
            $table->integer('delete_count')->default(0);
            $table->text('sql');
            $table->integer('status')->default(0);
            $table->float('time')->default(0);
            $table->text('message')->nullable();
            $table->string('route');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('db_logs');
    }
};

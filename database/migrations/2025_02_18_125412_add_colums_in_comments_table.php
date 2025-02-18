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
            $table->tinyInteger('wrong_status')->default(0)->after('id');
            $table->enum('enum_status', ['pending', 'accepted', 'rejected'])->nullable()->after('wrong_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->dropColumn('enum_status');
            $table->dropColumn('wrong_status');
        });
    }
};

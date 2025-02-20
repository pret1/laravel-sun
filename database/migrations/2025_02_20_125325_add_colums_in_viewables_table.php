<?php

use App\Models\Profile;
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
        Schema::table('viewables', function (Blueprint $table) {
            $table->morphs('viewable');
            $table->foreignIdFor(Profile::class)->index()->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('viewables', function (Blueprint $table) {
            $table->dropMorphs('viewable');
            $table->dropForeignIdFor(Profile::class);
            $table->dropColumn('profile_id');
        });
    }
};

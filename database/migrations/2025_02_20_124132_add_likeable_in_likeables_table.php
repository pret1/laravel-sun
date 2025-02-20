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
        Schema::table('likeables', function (Blueprint $table) {
            $table->morphs('likeable');
            $table->foreignIdFor(Profile::class)->index()->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('likeables', function (Blueprint $table) {
            $table->dropMorphs('likeable');
            $table->dropForeignIdFor(Profile::class);
            $table->dropColumn('profile_id');
        });
    }
};

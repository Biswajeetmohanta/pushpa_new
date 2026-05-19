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
        Schema::table('settings', function (Blueprint $table) {
            $table->string('social_facebook')->default('#')->after('contact_map_iframe');
            $table->string('social_instagram')->default('#')->after('social_facebook');
            $table->string('social_linkedin')->default('#')->after('social_instagram');
            $table->string('social_twitter')->default('#')->after('social_linkedin');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn([
                'social_facebook',
                'social_instagram',
                'social_linkedin',
                'social_twitter'
            ]);
        });
    }
};

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
            $table->string('contact_phone_2')->nullable()->change();
            $table->string('social_facebook')->nullable()->change();
            $table->string('social_instagram')->nullable()->change();
            $table->string('social_linkedin')->nullable()->change();
            $table->string('social_twitter')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->string('contact_phone_2')->nullable(false)->change();
            $table->string('social_facebook')->nullable(false)->change();
            $table->string('social_instagram')->nullable(false)->change();
            $table->string('social_linkedin')->nullable(false)->change();
            $table->string('social_twitter')->nullable(false)->change();
        });
    }
};

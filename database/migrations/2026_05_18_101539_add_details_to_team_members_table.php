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
        Schema::table('team_members', function (Blueprint $table) {
            $table->text('description')->nullable()->after('role');
            $table->text('qualifications')->nullable()->after('description');
            $table->string('facebook')->nullable()->after('email');
            $table->string('twitter')->nullable()->after('facebook');
            $table->string('linkedin')->nullable()->after('twitter');
            $table->string('instagram')->nullable()->after('linkedin');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('team_members', function (Blueprint $table) {
            $table->dropColumn(['description', 'qualifications', 'facebook', 'twitter', 'linkedin', 'instagram']);
        });
    }
};

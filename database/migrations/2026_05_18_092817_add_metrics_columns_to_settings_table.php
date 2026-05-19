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
            $table->string('projects_completed')->default('150+')->after('experience_start_year');
            $table->string('annual_turnover')->default('14Cr+')->after('projects_completed');
            $table->string('client_satisfaction')->default('100%')->after('annual_turnover');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn(['projects_completed', 'annual_turnover', 'client_satisfaction']);
        });
    }
};

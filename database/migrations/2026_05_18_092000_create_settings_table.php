<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $blueprint) {
            $blueprint->id();
            
            // About Us Section
            $blueprint->string('about_subtitle')->nullable();
            $blueprint->string('about_title')->nullable();
            $blueprint->text('about_description_1')->nullable();
            $blueprint->text('about_description_2')->nullable();
            
            // Core Values / MVV
            $blueprint->string('mission_title')->nullable();
            $blueprint->text('mission_description')->nullable();
            $blueprint->string('vision_title')->nullable();
            $blueprint->text('vision_description')->nullable();
            $blueprint->string('values_title')->nullable();
            $blueprint->text('values_description')->nullable();
            
            // Experience settings
            $blueprint->integer('experience_start_year')->default(2005);
            
            $blueprint->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};

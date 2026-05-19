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
            $table->string('workforce_title')->default('OUR SKILLED & DEDICATED WORKFORCE')->after('social_twitter');
            $table->text('workforce_subtitle')->nullable()->after('workforce_title');
            $table->text('workforce_management')->nullable()->after('workforce_subtitle');
            $table->text('workforce_execution')->nullable()->after('workforce_management');
            $table->text('workforce_labour')->nullable()->after('workforce_execution');
        });

        // Set default values for existing settings row
        $defaultSubtitle = "Our success is driven by the collective strength and expertise of our large and diverse team. With over 3,300 dedicated professionals, we have the manpower and skill to execute projects of any scale and complexity.";
        
        $defaultManagement = "General Managers: 04\nProject Managers: 08\nProject Engineers: 20\nSafety Officers: 04\nQ.A/Q.C Engineers: 06\nSr. Surveyor: 01\nOffice Staff: 10";
        
        $defaultExecution = "Foremen: 15\nSite Supervisors: 30\nElectricians: 06\nMechanics: 03\nFitters: 30\nWelders: 20\nRigar Men: 80\nHelpers: 60";
        
        $defaultLabour = "Skilled Labour: 1250\nSemi-skilled Labour: 1050\nUnskilled Labour: 950\nTotal Labour Force: 3250";

        \DB::table('settings')->update([
            'workforce_subtitle' => $defaultSubtitle,
            'workforce_management' => $defaultManagement,
            'workforce_execution' => $defaultExecution,
            'workforce_labour' => $defaultLabour
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn([
                'workforce_title',
                'workforce_subtitle',
                'workforce_management',
                'workforce_execution',
                'workforce_labour'
            ]);
        });
    }
};

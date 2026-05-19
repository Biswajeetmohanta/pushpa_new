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
            $table->string('contact_phone_1')->default('+91 98255 30295')->after('client_satisfaction');
            $table->string('contact_phone_2')->default('+91 98795 30295')->after('contact_phone_1');
            $table->string('contact_email')->default('pushprajconstruction9@gmail.com')->after('contact_phone_2');
            $table->text('contact_address')->nullable()->after('contact_email');
            $table->string('contact_working_hours')->default('Mon - Sat: 9:00 AM - 6:00 PM, Sunday: Closed')->after('contact_address');
            $table->text('contact_map_iframe')->nullable()->after('contact_working_hours');
        });

        // Seed current defaults for existing records where address might be empty
        $defaultAddress = "Near Bhagwati Temple,\nChamunda Chowk, Botad,\nGujarat - 364710";
        $defaultMap = 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3698.0137307395694!2d71.66744731495468!3d22.17179398536744!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395958db0b9e1337%3A0x1947c42af93d6a3!2sBotad%2C%20Gujarat!5e0!3m2!1sen!2sin!4v1620000000000!5m2!1sen!2sin';

        \DB::table('settings')->update([
            'contact_address' => $defaultAddress,
            'contact_map_iframe' => $defaultMap
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn([
                'contact_phone_1',
                'contact_phone_2',
                'contact_email',
                'contact_address',
                'contact_working_hours',
                'contact_map_iframe'
            ]);
        });
    }
};

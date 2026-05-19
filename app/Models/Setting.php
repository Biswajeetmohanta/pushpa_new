<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'logo',
        'favicon',
        'about_subtitle',
        'about_title',
        'about_description_1',
        'about_description_2',
        'mission_title',
        'mission_description',
        'vision_title',
        'vision_description',
        'values_title',
        'values_description',
        'experience_start_year',
        'years_experience',
        'projects_completed',
        'annual_turnover',
        'client_satisfaction',
        'contact_phone_1',
        'contact_phone_2',
        'contact_email',
        'contact_address',
        'contact_working_hours',
        'contact_map_iframe',
        'social_facebook',
        'social_instagram',
        'social_linkedin',
        'social_twitter',
        'workforce_title',
        'workforce_subtitle',
        'workforce_management',
        'workforce_execution',
        'workforce_labour'
    ];
}

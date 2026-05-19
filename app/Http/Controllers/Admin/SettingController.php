<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function edit()
    {
        $setting = Setting::firstOrCreate([], [
            'about_subtitle' => 'About Us',
            'about_title' => "Building Gujarat's Future Since 2005",
            'about_description_1' => 'Pushpraj Construction is a leading civil and infrastructure company based in Gujarat, specializing in industrial projects, highways, bridges, and EPC contracts. With over 17 years of experience, we have successfully delivered 150+ projects with a commitment to quality and excellence.',
            'about_description_2' => 'Our team of expert engineers and skilled workforce ensures every project meets the highest standards of quality, safety, and sustainability. We are proud to be fully certified, reflecting our dedication to quality management and occupational health & safety.',
            'mission_title' => 'Our Mission',
            'mission_description' => 'To deliver exceptional construction services that exceed client expectations while maintaining the highest standards of quality and safety.',
            'vision_title' => 'Our Vision',
            'vision_description' => 'To be the most trusted construction company in Gujarat, known for innovation, reliability, and sustainable building practices.',
            'values_title' => 'Our Values',
            'values_description' => 'Integrity, excellence, teamwork, and customer satisfaction are the core values that guide everything we do.',
            'experience_start_year' => 2005,
            'years_experience' => '21+',
            'projects_completed' => '150+',
            'annual_turnover' => '14Cr+',
            'client_satisfaction' => '100%',
            'contact_phone_1' => '+91 98255 30295',
            'contact_phone_2' => '+91 98795 30295',
            'contact_email' => 'pushprajconstruction9@gmail.com',
            'contact_address' => "Near Bhagwati Temple,\nChamunda Chowk, Botad,\nGujarat - 364710",
            'contact_working_hours' => 'Mon - Sat: 9:00 AM - 6:00 PM, Sunday: Closed',
            'contact_map_iframe' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3698.0137307395694!2d71.66744731495468!3d22.17179398536744!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395958db0b9e1337%3A0x1947c42af93d6a3!2sBotad%2C%20Gujarat!5e0!3m2!1sen!2sin!4v1620000000000!5m2!1sen!2sin',
            'social_facebook' => '#',
            'social_instagram' => '#',
            'social_linkedin' => '#',
            'social_twitter' => '#',
            'workforce_title' => 'OUR SKILLED & DEDICATED WORKFORCE',
            'workforce_subtitle' => "Our success is driven by the collective strength and expertise of our large and diverse team. With over 3,300 dedicated professionals, we have the manpower and skill to execute projects of any scale and complexity.",
            'workforce_management' => "General Managers: 04\nProject Managers: 08\nProject Engineers: 20\nSafety Officers: 04\nQ.A/Q.C Engineers: 06\nSr. Surveyor: 01\nOffice Staff: 10",
            'workforce_execution' => "Foremen: 15\nSite Supervisors: 30\nElectricians: 06\nMechanics: 03\nFitters: 30\nWelders: 20\nRigar Men: 80\nHelpers: 60",
            'workforce_labour' => "Skilled Labour: 1250\nSemi-skilled Labour: 1050\nUnskilled Labour: 950\nTotal Labour Force: 3250",
        ]);

        return view('admin.settings.edit', compact('setting'));
    }

    public function update(Request $request)
    {
        $setting = Setting::first();
        
        $validated = $request->validate([
            'logo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg,webp', 'max:2048'],
            'favicon' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg,webp,ico', 'max:1024'],
            'about_subtitle' => ['required', 'string', 'max:255'],
            'about_title' => ['required', 'string', 'max:255'],
            'about_description_1' => ['required', 'string'],
            'about_description_2' => ['required', 'string'],
            'mission_title' => ['required', 'string', 'max:255'],
            'mission_description' => ['required', 'string'],
            'vision_title' => ['required', 'string', 'max:255'],
            'vision_description' => ['required', 'string'],
            'values_title' => ['required', 'string', 'max:255'],
            'values_description' => ['required', 'string'],
            'experience_start_year' => ['required', 'integer', 'min:1900', 'max:' . date('Y')],
            'years_experience' => ['required', 'string', 'max:255'],
            'projects_completed' => ['required', 'string', 'max:255'],
            'annual_turnover' => ['required', 'string', 'max:255'],
            'client_satisfaction' => ['required', 'string', 'max:255'],
            'contact_phone_1' => ['required', 'string', 'max:255'],
            'contact_phone_2' => ['nullable', 'string', 'max:255'],
            'contact_email' => ['required', 'email', 'max:255'],
            'contact_address' => ['required', 'string'],
            'contact_working_hours' => ['required', 'string', 'max:255'],
            'contact_map_iframe' => ['nullable', 'string'],
            'social_facebook' => ['nullable', 'string', 'max:255'],
            'social_instagram' => ['nullable', 'string', 'max:255'],
            'social_linkedin' => ['nullable', 'string', 'max:255'],
            'social_twitter' => ['nullable', 'string', 'max:255'],
        ]);

        $data = $validated;
        unset($data['logo'], $data['favicon']);

        $brandingPath = public_path('uploads/branding');
        if (!file_exists($brandingPath)) {
            mkdir($brandingPath, 0755, true);
        }

        if ($request->hasFile('logo')) {
            if ($setting->logo && file_exists(public_path($setting->logo))) {
                @unlink(public_path($setting->logo));
            }
            $logoFile = $request->file('logo');
            $logoName = 'logo_' . time() . '.' . $logoFile->getClientOriginalExtension();
            $logoFile->move($brandingPath, $logoName);
            $data['logo'] = 'uploads/branding/' . $logoName;
        }

        if ($request->hasFile('favicon')) {
            if ($setting->favicon && file_exists(public_path($setting->favicon))) {
                @unlink(public_path($setting->favicon));
            }
            $faviconFile = $request->file('favicon');
            $faviconName = 'favicon_' . time() . '.' . $faviconFile->getClientOriginalExtension();
            $faviconFile->move($brandingPath, $faviconName);
            $data['favicon'] = 'uploads/branding/' . $faviconName;
        }

        $setting->update($data);

        return redirect()->route('admin.settings.edit')->with('success', 'Company About Us settings updated successfully!');
    }
}

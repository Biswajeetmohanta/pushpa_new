<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TeamMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class TeamMemberController extends Controller
{
    public function index()
    {
        $members = TeamMember::orderBy('sort_order')->get();
        $setting = \App\Models\Setting::firstOrCreate([], [
            'workforce_title' => 'OUR SKILLED & DEDICATED WORKFORCE',
            'workforce_subtitle' => "Our success is driven by the collective strength and expertise of our large and diverse team. With over 3,300 dedicated professionals, we have the manpower and skill to execute projects of any scale and complexity.",
            'workforce_management' => "General Managers: 04\nProject Managers: 08\nProject Engineers: 20\nSafety Officers: 04\nQ.A/Q.C Engineers: 06\nSr. Surveyor: 01\nOffice Staff: 10",
            'workforce_execution' => "Foremen: 15\nSite Supervisors: 30\nElectricians: 06\nMechanics: 03\nFitters: 30\nWelders: 20\nRigar Men: 80\nHelpers: 60",
            'workforce_labour' => "Skilled Labour: 1250\nSemi-skilled Labour: 1050\nUnskilled Labour: 950\nTotal Labour Force: 3250",
        ]);
        return view('admin.team.index', compact('members', 'setting'));
    }

    public function create()
    {
        return view('admin.team.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'role' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'qualifications' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,gif', 'max:5120'],
            'email' => ['nullable', 'string', 'max:255'],
            'facebook' => ['nullable', 'string', 'max:255'],
            'twitter' => ['nullable', 'string', 'max:255'],
            'linkedin' => ['nullable', 'string', 'max:255'],
            'instagram' => ['nullable', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            
            if (!File::exists(public_path('uploads'))) {
                File::makeDirectory(public_path('uploads'), 0755, true);
            }
            
            $file->move(public_path('uploads'), $filename);
            $data['image'] = '/uploads/' . $filename;
        }

        TeamMember::create($data);

        return redirect()->route('admin.team.index')->with('success', 'Team Member created successfully.');
    }

    public function edit(TeamMember $team)
    {
        return view('admin.team.edit', compact('team'));
    }

    public function update(Request $request, TeamMember $team)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'role' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'qualifications' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,gif', 'max:5120'],
            'email' => ['nullable', 'string', 'max:255'],
            'facebook' => ['nullable', 'string', 'max:255'],
            'twitter' => ['nullable', 'string', 'max:255'],
            'linkedin' => ['nullable', 'string', 'max:255'],
            'instagram' => ['nullable', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            if ($team->image && File::exists(public_path($team->image))) {
                File::delete(public_path($team->image));
            }

            $file = $request->file('image');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            
            if (!File::exists(public_path('uploads'))) {
                File::makeDirectory(public_path('uploads'), 0755, true);
            }
            
            $file->move(public_path('uploads'), $filename);
            $data['image'] = '/uploads/' . $filename;
        }

        $team->update($data);

        return redirect()->route('admin.team.index')->with('success', 'Team Member updated successfully.');
    }

    public function destroy(TeamMember $team)
    {
        if ($team->image && File::exists(public_path($team->image))) {
            File::delete(public_path($team->image));
        }

        $team->delete();

        return redirect()->route('admin.team.index')->with('success', 'Team Member deleted successfully.');
    }

    public function updateWorkforce(Request $request)
    {
        $setting = \App\Models\Setting::firstOrCreate([]);
        
        $validated = $request->validate([
            'workforce_title' => ['required', 'string', 'max:255'],
            'workforce_subtitle' => ['nullable', 'string'],
            'workforce_management' => ['nullable', 'string'],
            'workforce_execution' => ['nullable', 'string'],
            'workforce_labour' => ['nullable', 'string'],
        ]);

        $setting->update($validated);

        return redirect()->route('admin.team.index')->with('success', 'Workforce statistics updated successfully.');
    }
}

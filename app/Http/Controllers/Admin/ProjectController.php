<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::orderBy('sort_order')->get();
        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        $sectors = \App\Models\Sector::where('is_active', 1)->orderBy('sort_order')->pluck('name');
        return view('admin.projects.create', compact('sectors'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'sector' => ['required', 'string', 'max:255'],
            'location' => ['required', 'string'],
            'client' => ['nullable', 'string', 'max:255'],
            'value' => ['nullable', 'string', 'max:255'],
            'timeline' => ['nullable', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,gif', 'max:5120'],
            'description' => ['nullable', 'string'],
            'sort_order' => ['nullable', 'integer'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $data['category'] = $data['sector']; // Sync DB column integrity
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            
            // Create uploads folder if not exists
            if (!File::exists(public_path('uploads'))) {
                File::makeDirectory(public_path('uploads'), 0755, true);
            }
            
            $file->move(public_path('uploads'), $filename);
            $data['image'] = '/uploads/' . $filename;
        }

        Project::create($data);

        return redirect()->route('admin.projects.index')->with('success', 'Project created successfully.');
    }

    public function edit(Project $project)
    {
        $sectors = \App\Models\Sector::where('is_active', 1)->orderBy('sort_order')->pluck('name');
        return view('admin.projects.edit', compact('project', 'sectors'));
    }

    public function update(Request $request, Project $project)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'sector' => ['required', 'string', 'max:255'],
            'location' => ['required', 'string'],
            'client' => ['nullable', 'string', 'max:255'],
            'value' => ['nullable', 'string', 'max:255'],
            'timeline' => ['nullable', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,gif', 'max:5120'],
            'description' => ['nullable', 'string'],
            'sort_order' => ['nullable', 'integer'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $data['category'] = $data['sector']; // Sync DB column integrity
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            // Delete old file
            if ($project->image && File::exists(public_path($project->image))) {
                File::delete(public_path($project->image));
            }

            $file = $request->file('image');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            
            if (!File::exists(public_path('uploads'))) {
                File::makeDirectory(public_path('uploads'), 0755, true);
            }
            
            $file->move(public_path('uploads'), $filename);
            $data['image'] = '/uploads/' . $filename;
        }

        $project->update($data);

        return redirect()->route('admin.projects.index')->with('success', 'Project updated successfully.');
    }

    public function destroy(Project $project)
    {
        if ($project->image && File::exists(public_path($project->image))) {
            File::delete(public_path($project->image));
        }

        $project->delete();

        return redirect()->route('admin.projects.index')->with('success', 'Project deleted successfully.');
    }
}

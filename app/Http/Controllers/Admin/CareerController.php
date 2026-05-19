<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobOpening;
use Illuminate\Http\Request;

class CareerController extends Controller
{
    public function index()
    {
        $jobs = JobOpening::orderBy('sort_order')->get();
        return view('admin.careers.index', compact('jobs'));
    }

    public function create()
    {
        return view('admin.careers.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'department' => ['required', 'string', 'max:255'],
            'location' => ['required', 'string', 'max:255'],
            'employment_type' => ['required', 'string', 'max:255'],
            'experience_required' => ['required', 'string', 'max:255'],
            'salary_range' => ['nullable', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'requirements' => ['nullable', 'string'],
            'sort_order' => ['nullable', 'integer'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $data['is_active'] = $request->has('is_active');

        JobOpening::create($data);

        return redirect()->route('admin.careers.index')->with('success', 'Job opening created successfully.');
    }

    public function edit(JobOpening $career)
    {
        return view('admin.careers.edit', compact('career'));
    }

    public function update(Request $request, JobOpening $career)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'department' => ['required', 'string', 'max:255'],
            'location' => ['required', 'string', 'max:255'],
            'employment_type' => ['required', 'string', 'max:255'],
            'experience_required' => ['required', 'string', 'max:255'],
            'salary_range' => ['nullable', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'requirements' => ['nullable', 'string'],
            'sort_order' => ['nullable', 'integer'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $data['is_active'] = $request->has('is_active');

        $career->update($data);

        return redirect()->route('admin.careers.index')->with('success', 'Job opening updated successfully.');
    }

    public function destroy(JobOpening $career)
    {
        $career->delete();
        return redirect()->route('admin.careers.index')->with('success', 'Job opening deleted successfully.');
    }
}

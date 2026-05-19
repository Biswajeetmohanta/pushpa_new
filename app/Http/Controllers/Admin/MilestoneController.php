<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Milestone;
use Illuminate\Http\Request;

class MilestoneController extends Controller
{
    public function index()
    {
        $milestones = Milestone::orderBy('sort_order')->get();
        return view('admin.milestones.index', compact('milestones'));
    }

    public function create()
    {
        return view('admin.milestones.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'year' => ['required', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'sort_order' => ['nullable', 'integer'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $data['is_active'] = $request->has('is_active');

        Milestone::create($data);

        return redirect()->route('admin.milestones.index')->with('success', 'Milestone created successfully.');
    }

    public function edit(Milestone $milestone)
    {
        return view('admin.milestones.edit', compact('milestone'));
    }

    public function update(Request $request, Milestone $milestone)
    {
        $data = $request->validate([
            'year' => ['required', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'sort_order' => ['nullable', 'integer'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $data['is_active'] = $request->has('is_active');

        $milestone->update($data);

        return redirect()->route('admin.milestones.index')->with('success', 'Milestone updated successfully.');
    }

    public function destroy(Milestone $milestone)
    {
        $milestone->delete();
        return redirect()->route('admin.milestones.index')->with('success', 'Milestone deleted successfully.');
    }
}

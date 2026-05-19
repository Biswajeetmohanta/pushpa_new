<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class JobApplicationController extends Controller
{
    public function index()
    {
        $applications = JobApplication::with('jobOpening')->orderBy('created_at', 'desc')->get();
        return view('admin.applications.index', compact('applications'));
    }

    public function show(JobApplication $application)
    {
        if ($application->status === 'new') {
            $application->update(['status' => 'viewed']);
        }
        return view('admin.applications.show', compact('application'));
    }

    public function updateStatus(Request $request, JobApplication $application)
    {
        $validated = $request->validate([
            'status' => ['required', 'string', 'in:new,viewed,shortlisted,rejected,hired'],
        ]);

        $application->update($validated);

        return redirect()->back()->with('success', 'Application status updated successfully.');
    }

    public function destroy(JobApplication $application)
    {
        if ($application->resume && File::exists(public_path($application->resume))) {
            File::delete(public_path($application->resume));
        }

        $application->delete();

        return redirect()->route('admin.applications.index')->with('success', 'Job application deleted successfully.');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Service;
use App\Models\Testimonial;
use App\Models\TeamMember;
use App\Models\Certification;
use App\Models\ContactSubmission;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'projects' => Project::count(),
            'services' => Service::count(),
            'testimonials' => Testimonial::count(),
            'team_members' => TeamMember::count(),
            'certifications' => Certification::count(),
            'unread_messages' => ContactSubmission::where('status', 'new')->count(),
        ];

        $recentSubmissions = ContactSubmission::orderBy('created_at', 'desc')->take(5)->get();
        $recentProjects = Project::orderBy('created_at', 'desc')->take(4)->get();

        return view('admin.dashboard', compact('stats', 'recentSubmissions', 'recentProjects'));
    }
}

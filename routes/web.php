<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Service;
use App\Models\Milestone;
use App\Models\Testimonial;
use App\Models\TeamMember;
use App\Models\Certification;
use App\Models\ContactSubmission;

// Admin Controllers
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\MilestoneController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\CertificationController;
use App\Http\Controllers\Admin\TeamMemberController;
use App\Http\Controllers\Admin\ContactSubmissionController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SectorController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\CareerController;
use App\Http\Controllers\Admin\JobApplicationController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

// Front Landing Page (Dynamic wiring)
Route::get('/', function () {
    $projects = Project::where('is_active', 1)->orderBy('created_at', 'desc')->get();
    $services = Service::where('is_active', 1)->orderBy('sort_order')->get();
    $milestones = Milestone::where('is_active', 1)->orderBy('sort_order')->get();
    $testimonials = Testimonial::where('is_active', 1)->orderBy('sort_order')->get();
    $teamMembers = TeamMember::where('is_active', 1)->orderBy('sort_order')->get();
    $certifications = Certification::where('is_active', 1)->orderBy('sort_order')->get();

    return view('welcome', compact('projects', 'services', 'milestones', 'testimonials', 'teamMembers', 'certifications'));
})->name('home');

// Dedicated About Page
Route::get('/about', function () {
    $testimonials = Testimonial::where('is_active', 1)->orderBy('sort_order')->get();
    $teamMembers = TeamMember::where('is_active', 1)->orderBy('sort_order')->get();
    return view('pages.about', compact('testimonials', 'teamMembers'));
})->name('about');

// Dedicated Services Page
Route::get('/services', function () {
    $services = Service::where('is_active', 1)->orderBy('sort_order')->get();
    return view('pages.services', compact('services'));
})->name('services');

// Dedicated Projects Page
Route::get('/projects', function () {
    $projects = Project::where('is_active', 1)->orderBy('sort_order')->get();
    return view('pages.projects', compact('projects'));
})->name('projects');

// Dedicated Milestones Page
Route::get('/milestones', function () {
    $milestones = Milestone::where('is_active', 1)->orderBy('sort_order')->get();
    return view('pages.milestones', compact('milestones'));
})->name('milestones');

// Dedicated Certifications Page
Route::get('/certifications', function () {
    $certifications = Certification::where('is_active', 1)->orderBy('sort_order')->get();
    return view('pages.certifications', compact('certifications'));
})->name('certifications');

// Dedicated Team Page
Route::get('/team', function () {
    $teamMembers = TeamMember::where('is_active', 1)->orderBy('sort_order')->get();
    return view('pages.team', compact('teamMembers'));
})->name('team');

// Dedicated Contact Page
Route::get('/contact', function () {
    return view('pages.contact');
})->name('contact');

// Front-end Contact Form AJAX Endpoint
Route::post('/contact', function (Request $request) {
    $validated = $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'email', 'max:255'],
        'phone' => ['required', 'string', 'max:255'],
        'service' => ['nullable', 'string'],
        'message' => ['required', 'string'],
    ]);

    ContactSubmission::create($validated);

    return response()->json([
        'success' => true,
        'message' => 'Thank you! Your message has been saved successfully.'
    ]);
});

// Dedicated Careers Page
Route::get('/careers', function () {
    $jobs = \App\Models\JobOpening::where('is_active', 1)->orderBy('sort_order')->get();
    return view('pages.careers', compact('jobs'));
})->name('careers');

// Front-end Careers Form AJAX Endpoint
Route::post('/careers/apply', function (Request $request) {
    $validated = $request->validate([
        'job_opening_id' => ['nullable', 'exists:job_openings,id'],
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'email', 'max:255'],
        'phone' => ['required', 'string', 'max:255'],
        'resume' => ['required', 'file', 'mimes:pdf,doc,docx', 'max:5120'], // Max 5MB
        'cover_letter' => ['nullable', 'string'],
    ]);

    if ($request->hasFile('resume')) {
        $file = $request->file('resume');
        $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        
        if (!\Illuminate\Support\Facades\File::exists(public_path('uploads/resumes'))) {
            \Illuminate\Support\Facades\File::makeDirectory(public_path('uploads/resumes'), 0755, true);
        }
        
        $file->move(public_path('uploads/resumes'), $filename);
        $validated['resume'] = '/uploads/resumes/' . $filename;
    }

    \App\Models\JobApplication::create($validated);

    return response()->json([
        'success' => true,
        'message' => 'Your application has been submitted successfully! Our HR team will review it and get back to you.'
    ]);
})->name('careers.apply');

/*
|--------------------------------------------------------------------------
| Admin Auth & Management Routes
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->group(function () {
    
    // Guest Admin Routes
    Route::middleware('guest')->group(function () {
        Route::get('login', [AuthController::class, 'showLogin'])->name('admin.login');
        Route::post('login', [AuthController::class, 'login'])->name('admin.login.submit');
    });

    // Authenticated Admin Routes
    Route::middleware('auth')->group(function () {
        Route::post('logout', [AuthController::class, 'logout'])->name('admin.logout');

        // Admin Dashboard Overview Page
        Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');

        // CRUDs
        Route::resource('projects', ProjectController::class, ['as' => 'admin'])->except(['show']);
        Route::resource('services', ServiceController::class, ['as' => 'admin'])->except(['show']);
        Route::resource('sectors', SectorController::class, ['as' => 'admin'])->except(['show']);
        Route::resource('milestones', MilestoneController::class, ['as' => 'admin'])->except(['show']);
        Route::resource('testimonials', TestimonialController::class, ['as' => 'admin'])->except(['show']);
        Route::resource('certifications', CertificationController::class, ['as' => 'admin'])->except(['show']);
        Route::put('team/workforce', [TeamMemberController::class, 'updateWorkforce'])->name('admin.team.workforce');
        Route::resource('team', TeamMemberController::class, ['as' => 'admin'])->except(['show']);
        
        // Inbox/Contact Submissions
        Route::resource('contact', ContactSubmissionController::class, ['as' => 'admin'])->only(['index', 'show', 'destroy']);

        // Careers & Applications Management
        Route::resource('careers', CareerController::class, ['as' => 'admin'])->except(['show']);
        Route::put('applications/{application}/status', [JobApplicationController::class, 'updateStatus'])->name('admin.applications.status');
        Route::resource('applications', JobApplicationController::class, ['as' => 'admin'])->only(['index', 'show', 'destroy']);

        // Company About Us Settings
        Route::get('settings', [SettingController::class, 'edit'])->name('admin.settings.edit');
        Route::put('settings', [SettingController::class, 'update'])->name('admin.settings.update');
    });
});

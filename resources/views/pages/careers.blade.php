@extends('layouts.app')

@section('title', 'Careers | Pushpraj Construction')
@section('meta_description', 'Build a rewarding career in infrastructure, civil engineering, and EPC projects with Gujarat\'s premier construction firm.')

@section('content')
<!-- Page Header Banner -->
<div class="relative bg-[#0f2a4a] text-white py-16 sm:py-24 overflow-hidden" 
     style="background: linear-gradient(180deg, #0f2a4a 0%, #0a1f38 100%);">
    <!-- Grid Overlay -->
    <div class="absolute inset-0 opacity-[0.03] pointer-events-none bg-[radial-gradient(#ffffff_1px,transparent_1px)] [background-size:20px_20px]"></div>
    
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 text-center">
        <nav class="flex justify-center gap-2 text-xs sm:text-sm uppercase tracking-wider font-semibold text-accent mb-4">
            <a href="{{ route('home') }}" class="hover:text-white transition-colors">Home</a>
            <span>/</span>
            <span class="text-white/60">Careers</span>
        </nav>
        <h1 class="font-serif text-3xl sm:text-4xl md:text-5xl font-bold text-white tracking-wide">
            Build Your Future With Us
        </h1>
        <p class="text-white/70 text-xs sm:text-sm mt-3 max-w-2xl mx-auto font-sans">
            Join the expert workforce of Gujarat's premier civil infrastructure and EPC contracts firm. Let's build landmarks together.
        </p>
    </div>
</div>

<!-- Culture & Why Join Us Section -->
<section class="py-16 bg-white" x-data="{ isVisible: false }" x-intersect.once="isVisible = true">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <div class="accent-line mx-auto mb-6"></div>
            <p class="text-accent font-semibold tracking-wider uppercase mb-2 text-sm">Working At PRC</p>
            <h2 class="font-serif text-3xl sm:text-4xl font-bold text-primary mb-6">
                Why Build Your Career Here?
            </h2>
            <p class="text-muted-foreground text-sm sm:text-base leading-relaxed">
                At Pushpraj Construction, we believe our greatest assets are our people. We cultivate a culture of safety, technological innovation, and engineering excellence where everyone is empowered to grow.
            </p>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Benefit 1 -->
            <div class="group bg-slate-50 border border-slate-100 rounded-2xl p-6 transition-all duration-300 hover:shadow-md hover:bg-white hover:border-slate-200">
                <div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center text-primary mb-5 group-hover:bg-accent transition-colors">
                    <i data-lucide="shield-check" class="w-6 h-6"></i>
                </div>
                <h3 class="font-serif text-lg font-bold text-primary mb-2">Safety First</h3>
                <p class="text-muted-foreground text-xs leading-relaxed">
                    ISO 45001:2018 Certified safety standards. We ensure every team member operates under the highest guidelines.
                </p>
            </div>

            <!-- Benefit 2 -->
            <div class="group bg-slate-50 border border-slate-100 rounded-2xl p-6 transition-all duration-300 hover:shadow-md hover:bg-white hover:border-slate-200">
                <div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center text-primary mb-5 group-hover:bg-accent transition-colors">
                    <i data-lucide="award" class="w-6 h-6"></i>
                </div>
                <h3 class="font-serif text-lg font-bold text-primary mb-2">Career Development</h3>
                <p class="text-muted-foreground text-xs leading-relaxed">
                    Continuous learning programs, technical workshops, and mentorship from veteran civil engineers.
                </p>
            </div>

            <!-- Benefit 3 -->
            <div class="group bg-slate-50 border border-slate-100 rounded-2xl p-6 transition-all duration-300 hover:shadow-md hover:bg-white hover:border-slate-200">
                <div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center text-primary mb-5 group-hover:bg-accent transition-colors">
                    <i data-lucide="cpu" class="w-6 h-6"></i>
                </div>
                <h3 class="font-serif text-lg font-bold text-primary mb-2">Modern Fleet</h3>
                <p class="text-muted-foreground text-xs leading-relaxed">
                    Work with state-of-the-art machinery, advanced project metrics, and high-efficiency automation.
                </p>
            </div>

            <!-- Benefit 4 -->
            <div class="group bg-slate-50 border border-slate-100 rounded-2xl p-6 transition-all duration-300 hover:shadow-md hover:bg-white hover:border-slate-200">
                <div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center text-primary mb-5 group-hover:bg-accent transition-colors">
                    <i data-lucide="users-2" class="w-6 h-6"></i>
                </div>
                <h3 class="font-serif text-lg font-bold text-primary mb-2">Collaborative Culture</h3>
                <p class="text-muted-foreground text-xs leading-relaxed">
                    A supportive and diverse workforce where teamwork forms the foundation of every successful landmark.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Job Listings Section -->
<section id="openings" class="py-16 bg-slate-50 border-t border-slate-100" 
         x-data="{ 
            selectedDept: 'All',
            selectedJob: null,
            isApplyModalOpen: false,
            jobs: {{ json_encode($jobs) }},
            getFilteredJobs() {
                if (this.selectedDept === 'All') return this.jobs;
                return this.jobs.filter(j => j.department === this.selectedDept);
            },
            getDepartments() {
                const depts = new Set(this.jobs.map(j => j.department));
                return ['All', ...Array.from(depts)];
            }
         }">
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="text-center max-w-3xl mx-auto mb-12">
            <h2 class="font-serif text-3xl font-bold text-primary mb-3">Current Job Openings</h2>
            <p class="text-muted-foreground text-sm font-sans">
                Explore our active opportunities. Select a department to narrow your search, or submit a general application.
            </p>
        </div>

        <!-- Department Filters -->
        <div class="flex flex-wrap items-center justify-center gap-2 mb-10">
            <template x-for="dept in getDepartments()" :key="dept">
                <button @click="selectedDept = dept"
                        type="button"
                        class="px-4 py-2 rounded-full text-xs font-semibold tracking-wide border cursor-pointer transition-all duration-300"
                        :class="selectedDept === dept ? 'bg-primary text-white border-primary shadow-sm' : 'bg-white text-slate-600 border-slate-200 hover:border-slate-350 hover:bg-slate-50'">
                    <span x-text="dept"></span>
                </button>
            </template>
        </div>

        <!-- Openings Feed -->
        <div class="space-y-4 max-w-4xl mx-auto">
            <!-- Job listing cards dynamically filtered by department -->
            <template x-for="(job, index) in getFilteredJobs()" :key="job.id">
                <div class="bg-white border border-slate-150 rounded-xl p-5 sm:p-6 transition-all duration-300 hover:shadow-md relative overflow-hidden" 
                     x-data="{ isExpanded: false }">
                    
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                        <div class="flex-1 min-w-0">
                            <!-- Badges -->
                            <div class="flex flex-wrap items-center gap-2 mb-2.5">
                                <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-[#0f2343]/10 text-[#0f2343] uppercase tracking-wide" x-text="job.department"></span>
                                <span class="px-2.5 py-0.5 rounded-full text-[10px] font-semibold bg-emerald-50 text-emerald-700 border border-emerald-100" x-text="job.employment_type"></span>
                            </div>
                            
                            <!-- Title -->
                            <h3 class="font-serif text-lg sm:text-xl font-bold text-primary" x-text="job.title"></h3>
                            
                            <!-- Key Parameters -->
                            <div class="flex flex-wrap items-center gap-x-4 gap-y-1 mt-2 text-xs text-slate-400 font-sans">
                                <span class="flex items-center gap-1.5">
                                    <i data-lucide="map-pin" class="w-3.5 h-3.5 flex-shrink-0 text-slate-400"></i>
                                    <span x-text="job.location"></span>
                                </span>
                                <span class="flex items-center gap-1.5">
                                    <i data-lucide="briefcase" class="w-3.5 h-3.5 flex-shrink-0 text-slate-400"></i>
                                    <span x-text="job.experience_required"></span>
                                </span>
                                <span x-show="job.salary_range" class="flex items-center gap-1.5">
                                    <i data-lucide="indian-rupee" class="w-3.5 h-3.5 flex-shrink-0 text-slate-400"></i>
                                    <span x-text="job.salary_range"></span>
                                </span>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex items-center gap-2 sm:self-center flex-shrink-0">
                            <button @click="isExpanded = !isExpanded"
                                    type="button"
                                    class="p-2 border border-slate-200 hover:border-slate-350 hover:bg-slate-50 text-slate-500 rounded-lg flex items-center justify-center cursor-pointer transition-colors"
                                    title="View Requirements">
                                <svg class="w-4 h-4 transition-transform duration-300" :class="isExpanded ? 'rotate-180' : ''" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                            </button>

                            <button @click="selectedJob = job; isApplyModalOpen = true"
                                    type="button"
                                    class="px-4 py-2 rounded-lg bg-primary hover:bg-[#0a1b33] text-white text-xs font-semibold shadow-sm hover:shadow transition-colors flex items-center gap-1 cursor-pointer">
                                <span>Apply Now</span>
                                <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Expandable Drawer Details -->
                    <div x-show="isExpanded"
                         x-cloak
                         x-collapse
                         class="mt-6 pt-5 border-t border-slate-100 space-y-5">
                        
                        <!-- Description -->
                        <div>
                            <h4 class="font-sans font-semibold text-slate-800 text-xs uppercase tracking-wider mb-2">Role Description</h4>
                            <p class="text-slate-600 text-sm leading-relaxed whitespace-pre-line" x-text="job.description"></p>
                        </div>

                        <!-- Requirements -->
                        <div x-show="job.requirements">
                            <h4 class="font-sans font-semibold text-slate-800 text-xs uppercase tracking-wider mb-3">Key Requirements & Skills</h4>
                            <ul class="space-y-2">
                                <template x-for="req in job.requirements.split('\n').filter(r => r.trim())" :key="req">
                                    <li class="flex items-start gap-2 text-sm text-slate-600">
                                        <div class="w-4 h-4 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center flex-shrink-0 mt-0.5">
                                            <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                                        </div>
                                        <span x-text="req"></span>
                                    </li>
                                </template>
                            </ul>
                        </div>
                    </div>
                </div>
            </template>

            <!-- General Application Card if no filtered items exist -->
            <div x-show="getFilteredJobs().length === 0" x-cloak class="bg-white border border-slate-200 rounded-xl p-8 text-center text-slate-400">
                <i data-lucide="briefcase" class="w-12 h-12 mx-auto mb-3 text-slate-300 animate-pulse"></i>
                <h3 class="font-serif text-lg font-bold text-slate-700 mb-1">No Active Openings Found</h3>
                <p class="text-xs text-slate-400 mb-4">We are always looking for stellar talent to join our construction family.</p>
                <button @click="selectedJob = null; isApplyModalOpen = true"
                        class="px-5 py-2.5 rounded-lg bg-accent hover:bg-[#b4922f] text-primary font-bold text-xs shadow transition-colors cursor-pointer">
                    Submit General Application
                </button>
            </div>
        </div>

        <!-- General Application Banner -->
        <div x-show="jobs.length > 0" class="mt-16 bg-primary rounded-2xl p-8 md:p-12 text-center text-white max-w-4xl mx-auto shadow-md">
            <h3 class="font-serif text-xl sm:text-2xl md:text-3xl font-bold mb-3">
                Don't See the Right Fit?
            </h3>
            <p class="text-white/80 text-xs sm:text-sm mb-6 max-w-2xl mx-auto leading-relaxed">
                Submit a general profile and upload your resume. We keep all applications in our active talent directory and will contact you as soon as a fitting position opens.
            </p>
            <button @click="selectedJob = null; isApplyModalOpen = true"
                    class="px-6 py-3 rounded-lg bg-accent hover:bg-[#b4922f] text-primary font-bold text-xs sm:text-sm transition-all hover:scale-105 shadow-lg shadow-accent/20 cursor-pointer">
                Submit General Application
            </button>
        </div>
    </div>

    <!-- Apply Slide-out Overlay Drawer -->
    <div x-show="isApplyModalOpen"
         x-cloak
         class="fixed inset-0 z-50 flex items-center justify-end"
         style="display: none;"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         @keydown.escape.window="isApplyModalOpen = false">
        
        <!-- Backdrop -->
        <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-xs" @click="isApplyModalOpen = false"></div>

        <!-- Form Drawer Content -->
        <div x-show="isApplyModalOpen"
             x-transition:enter="transition ease-out duration-300 transform"
             x-transition:enter-start="opacity-0 translate-x-full"
             x-transition:enter-end="opacity-100 translate-x-0"
             x-transition:leave="transition ease-in duration-200 transform"
             x-transition:leave-start="opacity-100 translate-x-0"
             x-transition:leave-end="opacity-0 translate-x-full"
             class="relative z-10 w-full max-w-md bg-white h-screen shadow-2xl flex flex-col overflow-hidden"
             x-data="{ 
                 name: '',
                 email: '',
                 phone: '',
                 resumeFile: null,
                 coverLetter: '',
                 loading: false,
                 successMessage: '',
                 errors: {},
                 validateEmail(email) {
                     return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
                 },
                 handleFileChange(event) {
                     const file = event.target.files[0];
                     if (file) {
                         if (file.size > 5 * 1024 * 1024) {
                             this.errors = { ...this.errors, resume: 'File size exceeds 5MB limit.' };
                             this.resumeFile = null;
                         } else {
                             this.resumeFile = file;
                             this.errors = { ...this.errors, resume: null };
                         }
                     }
                 },
                 submitApplication() {
                     this.errors = {};
                     this.successMessage = '';
                     
                     // Client validations
                     let localErrors = {};
                     if (!this.name.trim()) localErrors.name = 'Your name is required.';
                     if (!this.email.trim()) localErrors.email = 'Email address is required.';
                     else if (!this.validateEmail(this.email)) localErrors.email = 'Please provide a valid email.';
                     if (!this.phone.trim()) localErrors.phone = 'Phone number is required.';
                     if (!this.resumeFile) localErrors.resume = 'A resume file (PDF/DOC) is required.';
                     
                     if (Object.keys(localErrors).length > 0) {
                         this.errors = localErrors;
                         return;
                     }

                     this.loading = true;
                     
                     // Prepare form data
                     let formData = new FormData();
                     formData.append('name', this.name);
                     formData.append('email', this.email);
                     formData.append('phone', this.phone);
                     formData.append('resume', this.resumeFile);
                     formData.append('cover_letter', this.coverLetter);
                     if (selectedJob) {
                         formData.append('job_opening_id', selectedJob.id);
                     }

                     // Perform AJAX request
                     fetch('{{ route('careers.apply') }}', {
                         method: 'POST',
                         headers: {
                             'X-CSRF-TOKEN': '{{ csrf_token() }}'
                         },
                         body: formData
                     })
                     .then(res => res.json())
                     .then(data => {
                         this.loading = false;
                         if (data.success) {
                             this.successMessage = data.message;
                             // Reset fields
                             this.name = '';
                             this.email = '';
                             this.phone = '';
                             this.coverLetter = '';
                             this.resumeFile = null;
                             document.getElementById('resume-input').value = '';
                         } else {
                             this.errors = data.errors || { general: 'An error occurred. Please try again.' };
                         }
                     })
                     .catch(err => {
                         this.loading = false;
                         this.errors = { general: 'System connection error. Please verify file size or network connection.' };
                     });
                 }
             }">

            <!-- Close Trigger -->
            <button @click="isApplyModalOpen = false"
                    class="absolute top-4 right-4 p-2 text-slate-400 hover:text-slate-700 bg-slate-50 hover:bg-slate-100 rounded-lg flex items-center justify-center cursor-pointer transition-colors z-20"
                    aria-label="Close form">
                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            </button>

            <!-- Form Header -->
            <div class="p-6 pb-4 border-b border-slate-100 flex-shrink-0 pr-12">
                <span class="inline-flex px-2.5 py-0.5 rounded bg-accent/20 text-primary font-bold text-[10px] uppercase tracking-wide mb-1" x-text="selectedJob ? 'Specific Opening' : 'General Profile'"></span>
                <h3 class="font-serif text-xl sm:text-2xl font-bold text-[#0f2343]" x-text="selectedJob ? 'Apply: ' + selectedJob.title : 'Submit General Application'"></h3>
                <p class="text-xs text-slate-400 mt-1 font-sans">Provide your contact details and upload your latest resume.</p>
            </div>

            <!-- Scrollable Content Area -->
            <div class="flex-grow overflow-y-auto p-6 space-y-5">
                <!-- Form Success Message -->
                <div x-show="successMessage" x-cloak class="p-4 bg-emerald-50 border-l-4 border-emerald-500 rounded-r-lg text-emerald-800 text-sm">
                    <div class="flex items-center gap-2 mb-1">
                        <i data-lucide="check-circle" class="w-4 h-4 text-emerald-500"></i>
                        <span class="font-bold">Success!</span>
                    </div>
                    <p class="mt-0.5" x-text="successMessage"></p>
                    <button @click="isApplyModalOpen = false; successMessage = ''" class="mt-3 text-xs font-bold text-primary underline block">Close Panel</button>
                </div>

                <!-- Form Fields -->
                <div x-show="!successMessage" class="space-y-5">
                    <!-- Generic error -->
                    <p x-show="errors.general" x-cloak class="text-xs text-rose-500 font-sans" x-text="errors.general"></p>

                    <!-- Full Name -->
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Full Name *</label>
                        <input type="text" x-model="name"
                               class="block w-full px-4 py-2.5 rounded-xl border text-sm outline-none transition-all"
                               :class="errors.name ? 'border-rose-400 focus:ring-rose-200 focus:ring-2' : 'border-slate-200 focus:border-accent focus:ring-2 focus:ring-accent/20'"
                               placeholder="Enter your full name">
                        <p x-show="errors.name" x-cloak class="text-[10px] text-rose-500 mt-1 font-sans" x-text="errors.name"></p>
                    </div>

                    <!-- Email Address -->
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Email Address *</label>
                        <input type="email" x-model="email"
                               class="block w-full px-4 py-2.5 rounded-xl border text-sm outline-none transition-all"
                               :class="errors.email ? 'border-rose-400 focus:ring-rose-200 focus:ring-2' : 'border-slate-200 focus:border-accent focus:ring-2 focus:ring-accent/20'"
                               placeholder="e.g. name@example.com">
                        <p x-show="errors.email" x-cloak class="text-[10px] text-rose-500 mt-1 font-sans" x-text="errors.email"></p>
                    </div>

                    <!-- Phone Number -->
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Phone Number *</label>
                        <input type="text" x-model="phone"
                               class="block w-full px-4 py-2.5 rounded-xl border text-sm outline-none transition-all"
                               :class="errors.phone ? 'border-rose-400 focus:ring-rose-200 focus:ring-2' : 'border-slate-200 focus:border-accent focus:ring-2 focus:ring-accent/20'"
                               placeholder="e.g. +91 98765 43210">
                        <p x-show="errors.phone" x-cloak class="text-[10px] text-rose-500 mt-1 font-sans" x-text="errors.phone"></p>
                    </div>

                    <!-- Cover Letter -->
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Cover Letter / Message</label>
                        <textarea x-model="coverLetter" rows="4"
                                  class="block w-full px-4 py-2.5 rounded-xl border text-sm outline-none transition-all resize-none border-slate-200 focus:border-accent focus:ring-2 focus:ring-accent/20"
                                  placeholder="Briefly tell us why you are interested in this position..."></textarea>
                    </div>

                    <!-- Resume File Input -->
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Upload Resume (PDF/DOC/DOCX) *</label>
                        <div class="relative flex flex-col items-center justify-center border-2 border-dashed rounded-xl p-4 transition-all"
                             :class="errors.resume ? 'border-rose-300 bg-rose-50/20' : 'border-slate-200 hover:border-slate-350 bg-slate-50/50'">
                            
                            <input type="file" id="resume-input" @change="handleFileChange($event)" accept=".pdf,.doc,.docx"
                                   class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                            
                            <i data-lucide="file-text" class="w-8 h-8 text-slate-400 mb-2" :class="resumeFile ? 'text-emerald-500 animate-bounce' : ''"></i>
                            <span class="text-xs font-semibold text-slate-700" x-text="resumeFile ? resumeFile.name : 'Choose a file or drag it here'"></span>
                            <span class="text-[10px] text-slate-400 mt-1">Accepts PDF, DOC, DOCX up to 5MB</span>
                        </div>
                        <p x-show="errors.resume" x-cloak class="text-[10px] text-rose-500 mt-1 font-sans" x-text="errors.resume"></p>
                    </div>
                </div>
            </div>

            <!-- Action buttons (Sticky/Fixed at bottom) -->
            <div x-show="!successMessage" class="p-6 border-t border-slate-100 flex items-center justify-end gap-3 bg-slate-50 flex-shrink-0">
                <button type="button" @click="isApplyModalOpen = false"
                        class="px-5 py-2.5 rounded-xl border border-slate-200 text-slate-600 font-semibold hover:bg-slate-100 bg-white text-xs transition-colors cursor-pointer font-sans">
                    Cancel
                </button>
                <button type="button" @click="submitApplication()" :disabled="loading"
                        class="px-5 py-2.5 rounded-xl bg-primary hover:bg-[#0a1b33] disabled:bg-slate-300 text-white font-semibold text-xs flex items-center gap-2 shadow-sm transition-all cursor-pointer font-sans">
                    <span x-show="!loading">Submit Application</span>
                    <span x-show="loading" class="flex items-center gap-1.5">
                        <svg class="animate-spin h-3.5 w-3.5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        <span>Uploading...</span>
                    </span>
                </button>
            </div>
            
        </div>
    </div>
</section>
@endsection

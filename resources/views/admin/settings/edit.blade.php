@extends('admin.layouts.app')

@section('title', 'Manage Settings')
@section('page-title', 'Company Settings')

@section('content')
@if(session('success'))
    <div class="mb-6 p-4 bg-emerald-50 border-l-4 border-emerald-500 rounded-r-lg text-emerald-700 text-sm flex items-center gap-2">
        <i data-lucide="check-circle" class="w-4 h-4 text-emerald-500"></i>
        <span class="font-semibold">{{ session('success') }}</span>
    </div>
@endif

@if($errors->any())
    <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded-r-lg text-red-700 text-sm">
        <div class="flex items-center gap-2 mb-1">
            <i data-lucide="alert-circle" class="w-4 h-4 text-red-500"></i>
            <span class="font-semibold">Validation Errors</span>
        </div>
        <ul class="list-disc pl-5 mt-1 space-y-1">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden max-w-4xl" x-data="{ activeTab: 'about' }">
    <!-- Tabs Navigation -->
    <div class="flex border-b border-slate-200 bg-slate-50">
        <button type="button" @click="activeTab = 'about'"
                :class="activeTab === 'about' ? 'border-accent text-primary bg-white font-bold' : 'border-transparent text-slate-500 hover:text-slate-700 hover:bg-slate-100'"
                class="px-6 py-4 border-b-2 font-serif text-sm transition-all focus:outline-none cursor-pointer">
            About Us Content
        </button>
        <button type="button" @click="activeTab = 'mvv'"
                :class="activeTab === 'mvv' ? 'border-accent text-primary bg-white font-bold' : 'border-transparent text-slate-500 hover:text-slate-700 hover:bg-slate-100'"
                class="px-6 py-4 border-b-2 font-serif text-sm transition-all focus:outline-none cursor-pointer">
            Mission, Vision & Values
        </button>
        <button type="button" @click="activeTab = 'contact'"
                :class="activeTab === 'contact' ? 'border-accent text-primary bg-white font-bold' : 'border-transparent text-slate-500 hover:text-slate-700 hover:bg-slate-100'"
                class="px-6 py-4 border-b-2 font-serif text-sm transition-all focus:outline-none cursor-pointer">
            Contact Details
        </button>
    </div>

    <!-- Form -->
    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="p-6 sm:p-8 space-y-6">
        @csrf
        @method('PUT')

        <!-- Tab 1: About Us -->
        <div x-show="activeTab === 'about'" class="space-y-6">
            <!-- Branding Settings -->
            <div class="p-5 bg-slate-50 rounded-xl border border-slate-150 space-y-4 mb-6">
                <div class="flex items-center gap-2 text-primary font-bold font-serif mb-2">
                    <i data-lucide="image" class="w-5 h-5 text-accent"></i>
                    <span>Brand Assets</span>
                </div>
                <div class="grid md:grid-cols-2 gap-6">
                    <!-- Logo Upload -->
                    <div>
                        <label for="logo" class="block text-sm font-semibold text-slate-700 mb-2">Website Logo</label>
                        @if($setting->logo)
                            <div class="mb-3 p-3 bg-white border border-slate-200 rounded-lg inline-block">
                                <img src="{{ asset($setting->logo) }}" alt="Logo" class="h-12 object-contain">
                            </div>
                        @endif
                        <input type="file" name="logo" id="logo" accept="image/*"
                               class="block w-full text-sm text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-primary/5 file:text-primary hover:file:bg-primary/10 transition-all cursor-pointer border border-slate-200 rounded-lg">
                        <span class="block text-[11px] text-slate-400 mt-1">Recommended: Transparent PNG, max 2MB.</span>
                    </div>

                    <!-- Favicon Upload -->
                    <div>
                        <label for="favicon" class="block text-sm font-semibold text-slate-700 mb-2">Website Favicon</label>
                        @if($setting->favicon)
                            <div class="mb-3 p-3 bg-white border border-slate-200 rounded-lg inline-block">
                                <img src="{{ asset($setting->favicon) }}" alt="Favicon" class="h-8 w-8 object-contain">
                            </div>
                        @endif
                        <input type="file" name="favicon" id="favicon" accept="image/*,.ico"
                               class="block w-full text-sm text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-primary/5 file:text-primary hover:file:bg-primary/10 transition-all cursor-pointer border border-slate-200 rounded-lg">
                        <span class="block text-[11px] text-slate-400 mt-1">Recommended: Square format (PNG or ICO), max 1MB.</span>
                    </div>
                </div>
            </div>

            <div class="grid md:grid-cols-2 gap-6">
                <!-- About Subtitle -->
                <div>
                    <label for="about_subtitle" class="block text-sm font-semibold text-slate-700 mb-2">About Section Label *</label>
                    <input type="text" name="about_subtitle" id="about_subtitle" required value="{{ old('about_subtitle', $setting->about_subtitle) }}"
                           class="block w-full px-4 py-3 rounded-lg border border-slate-200 focus:border-accent focus:ring-2 focus:ring-accent/20 outline-none transition-all"
                           placeholder="e.g. About Us">
                </div>

                <!-- Founding Year -->
                <div>
                    <label for="experience_start_year" class="block text-sm font-semibold text-slate-700 mb-2">Founding / Start Year *</label>
                    <input type="number" name="experience_start_year" id="experience_start_year" required value="{{ old('experience_start_year', $setting->experience_start_year) }}"
                           class="block w-full px-4 py-3 rounded-lg border border-slate-200 focus:border-accent focus:ring-2 focus:ring-accent/20 outline-none transition-all"
                           placeholder="e.g. 2005">
                    <span class="block text-[11px] text-slate-400 mt-1">This dynamically calculates your experience years counters (e.g. {{ date('Y') - $setting->experience_start_year }} years).</span>
                </div>
            </div>

            <!-- About Title -->
            <div>
                <label for="about_title" class="block text-sm font-semibold text-slate-700 mb-2">About Main Title *</label>
                <input type="text" name="about_title" id="about_title" required value="{{ old('about_title', $setting->about_title) }}"
                       class="block w-full px-4 py-3 rounded-lg border border-slate-200 focus:border-accent focus:ring-2 focus:ring-accent/20 outline-none transition-all"
                       placeholder="e.g. Building Gujarat's Future Since 2005">
            </div>

            <!-- Dynamic Corporate Metrics -->
            <div class="p-5 bg-slate-50 rounded-xl border border-slate-150 space-y-4">
                <div class="flex items-center gap-2 text-primary font-bold font-serif">
                    <i data-lucide="bar-chart-3" class="w-5 h-5 text-accent"></i>
                    <span>Corporate Metrics Counters</span>
                </div>
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
                    <!-- Years Experience -->
                    <div>
                        <label for="years_experience" class="block text-xs font-semibold text-slate-600 mb-1">Years Experience *</label>
                        <input type="text" name="years_experience" id="years_experience" required value="{{ old('years_experience', $setting->years_experience) }}"
                               class="block w-full px-4 py-2.5 rounded-lg border border-slate-200 bg-white focus:border-accent focus:ring-2 focus:ring-accent/20 outline-none transition-all text-sm"
                               placeholder="e.g. 21+">
                    </div>

                    <!-- Projects Completed -->
                    <div>
                        <label for="projects_completed" class="block text-xs font-semibold text-slate-600 mb-1">Projects Completed *</label>
                        <input type="text" name="projects_completed" id="projects_completed" required value="{{ old('projects_completed', $setting->projects_completed) }}"
                               class="block w-full px-4 py-2.5 rounded-lg border border-slate-200 bg-white focus:border-accent focus:ring-2 focus:ring-accent/20 outline-none transition-all text-sm"
                               placeholder="e.g. 150+">
                    </div>
                    
                    <!-- Annual Turnover -->
                    <div>
                        <label for="annual_turnover" class="block text-xs font-semibold text-slate-600 mb-1">Annual Turnover *</label>
                        <input type="text" name="annual_turnover" id="annual_turnover" required value="{{ old('annual_turnover', $setting->annual_turnover) }}"
                               class="block w-full px-4 py-2.5 rounded-lg border border-slate-200 bg-white focus:border-accent focus:ring-2 focus:ring-accent/20 outline-none transition-all text-sm"
                               placeholder="e.g. 14Cr+">
                    </div>

                    <!-- Client Satisfaction -->
                    <div>
                        <label for="client_satisfaction" class="block text-xs font-semibold text-slate-600 mb-1">Client Satisfaction *</label>
                        <input type="text" name="client_satisfaction" id="client_satisfaction" required value="{{ old('client_satisfaction', $setting->client_satisfaction) }}"
                               class="block w-full px-4 py-2.5 rounded-lg border border-slate-200 bg-white focus:border-accent focus:ring-2 focus:ring-accent/20 outline-none transition-all text-sm"
                               placeholder="e.g. 100%">
                    </div>
                </div>
            </div>

            <!-- About Description 1 -->
            <div>
                <label for="about_description_1" class="block text-sm font-semibold text-slate-700 mb-2">Main Paragraph *</label>
                <textarea name="about_description_1" id="about_description_1" rows="5" required
                          class="block w-full px-4 py-3 rounded-lg border border-slate-200 focus:border-accent focus:ring-2 focus:ring-accent/20 outline-none transition-all resize-none"
                          placeholder="Write the first paragraph of the about section...">{{ old('about_description_1', $setting->about_description_1) }}</textarea>
            </div>

            <!-- About Description 2 -->
            <div>
                <label for="about_description_2" class="block text-sm font-semibold text-slate-700 mb-2">Secondary/Closing Paragraph *</label>
                <textarea name="about_description_2" id="about_description_2" rows="5" required
                          class="block w-full px-4 py-3 rounded-lg border border-slate-200 focus:border-accent focus:ring-2 focus:ring-accent/20 outline-none transition-all resize-none"
                          placeholder="Write the second paragraph of the about section...">{{ old('about_description_2', $setting->about_description_2) }}</textarea>
            </div>
        </div>

        <!-- Tab 2: Mission, Vision & Values -->
        <div x-show="activeTab === 'mvv'" x-cloak class="space-y-6">
            <!-- Mission -->
            <div class="p-5 bg-slate-50 rounded-xl border border-slate-150 space-y-4">
                <div class="flex items-center gap-2 text-primary font-bold font-serif">
                    <i data-lucide="target" class="w-5 h-5 text-accent"></i>
                    <span>Corporate Mission</span>
                </div>
                <div class="grid gap-4">
                    <div>
                        <label for="mission_title" class="block text-xs font-semibold text-slate-600 mb-1">Mission Block Title</label>
                        <input type="text" name="mission_title" id="mission_title" required value="{{ old('mission_title', $setting->mission_title) }}"
                               class="block w-full px-4 py-2.5 rounded-lg border border-slate-200 bg-white focus:border-accent focus:ring-2 focus:ring-accent/20 outline-none transition-all text-sm">
                    </div>
                    <div>
                        <label for="mission_description" class="block text-xs font-semibold text-slate-600 mb-1">Mission Block Content</label>
                        <textarea name="mission_description" id="mission_description" rows="3" required
                                  class="block w-full px-4 py-2.5 rounded-lg border border-slate-200 bg-white focus:border-accent focus:ring-2 focus:ring-accent/20 outline-none transition-all text-sm resize-none">{{ old('mission_description', $setting->mission_description) }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Vision -->
            <div class="p-5 bg-slate-50 rounded-xl border border-slate-150 space-y-4">
                <div class="flex items-center gap-2 text-primary font-bold font-serif">
                    <i data-lucide="award" class="w-5 h-5 text-accent"></i>
                    <span>Corporate Vision</span>
                </div>
                <div class="grid gap-4">
                    <div>
                        <label for="vision_title" class="block text-xs font-semibold text-slate-600 mb-1">Vision Block Title</label>
                        <input type="text" name="vision_title" id="vision_title" required value="{{ old('vision_title', $setting->vision_title) }}"
                               class="block w-full px-4 py-2.5 rounded-lg border border-slate-200 bg-white focus:border-accent focus:ring-2 focus:ring-accent/20 outline-none transition-all text-sm">
                    </div>
                    <div>
                        <label for="vision_description" class="block text-xs font-semibold text-slate-600 mb-1">Vision Block Content</label>
                        <textarea name="vision_description" id="vision_description" rows="3" required
                                  class="block w-full px-4 py-2.5 rounded-lg border border-slate-200 bg-white focus:border-accent focus:ring-2 focus:ring-accent/20 outline-none transition-all text-sm resize-none">{{ old('vision_description', $setting->vision_description) }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Values -->
            <div class="p-5 bg-slate-50 rounded-xl border border-slate-150 space-y-4">
                <div class="flex items-center gap-2 text-primary font-bold font-serif">
                    <i data-lucide="users" class="w-5 h-5 text-accent"></i>
                    <span>Corporate Values</span>
                </div>
                <div class="grid gap-4">
                    <div>
                        <label for="values_title" class="block text-xs font-semibold text-slate-600 mb-1">Values Block Title</label>
                        <input type="text" name="values_title" id="values_title" required value="{{ old('values_title', $setting->values_title) }}"
                               class="block w-full px-4 py-2.5 rounded-lg border border-slate-200 bg-white focus:border-accent focus:ring-2 focus:ring-accent/20 outline-none transition-all text-sm">
                    </div>
                    <div>
                        <label for="values_description" class="block text-xs font-semibold text-slate-600 mb-1">Values Block Content</label>
                        <textarea name="values_description" id="values_description" rows="3" required
                                  class="block w-full px-4 py-2.5 rounded-lg border border-slate-200 bg-white focus:border-accent focus:ring-2 focus:ring-accent/20 outline-none transition-all text-sm resize-none">{{ old('values_description', $setting->values_description) }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tab 3: Contact Details -->
        <div x-show="activeTab === 'contact'" class="space-y-6">
            <div class="p-5 bg-slate-50 rounded-xl border border-slate-150 space-y-4">
                <div class="flex items-center gap-2 text-primary font-bold font-serif">
                    <i data-lucide="mail" class="w-5 h-5 text-accent"></i>
                    <span>Contact Info & Details</span>
                </div>
                
                <div class="grid md:grid-cols-2 gap-6">
                    <!-- Phone 1 -->
                    <div>
                        <label for="contact_phone_1" class="block text-sm font-semibold text-slate-700 mb-2">Contact Phone 1 *</label>
                        <input type="text" name="contact_phone_1" id="contact_phone_1" required value="{{ old('contact_phone_1', $setting->contact_phone_1) }}"
                               class="block w-full px-4 py-3 rounded-lg border border-slate-200 bg-white focus:border-accent focus:ring-2 focus:ring-accent/20 outline-none transition-all"
                               placeholder="e.g. +91 98255 30295">
                    </div>

                    <!-- Phone 2 -->
                    <div>
                        <label for="contact_phone_2" class="block text-sm font-semibold text-slate-700 mb-2">Contact Phone 2 (Optional)</label>
                        <input type="text" name="contact_phone_2" id="contact_phone_2" value="{{ old('contact_phone_2', $setting->contact_phone_2) }}"
                               class="block w-full px-4 py-3 rounded-lg border border-slate-200 bg-white focus:border-accent focus:ring-2 focus:ring-accent/20 outline-none transition-all"
                               placeholder="e.g. +91 98795 30295">
                    </div>
                </div>

                <div class="grid md:grid-cols-2 gap-6">
                    <!-- Email -->
                    <div>
                        <label for="contact_email" class="block text-sm font-semibold text-slate-700 mb-2">Contact Email *</label>
                        <input type="email" name="contact_email" id="contact_email" required value="{{ old('contact_email', $setting->contact_email) }}"
                               class="block w-full px-4 py-3 rounded-lg border border-slate-200 bg-white focus:border-accent focus:ring-2 focus:ring-accent/20 outline-none transition-all"
                               placeholder="e.g. pushprajconstruction9@gmail.com">
                    </div>

                    <!-- Working Hours -->
                    <div>
                        <label for="contact_working_hours" class="block text-sm font-semibold text-slate-700 mb-2">Working Hours *</label>
                        <input type="text" name="contact_working_hours" id="contact_working_hours" required value="{{ old('contact_working_hours', $setting->contact_working_hours) }}"
                               class="block w-full px-4 py-3 rounded-lg border border-slate-200 bg-white focus:border-accent focus:ring-2 focus:ring-accent/20 outline-none transition-all"
                               placeholder="e.g. Mon - Sat: 9:00 AM - 6:00 PM, Sunday: Closed">
                    </div>
                </div>

                <!-- Physical Address -->
                <div>
                    <label for="contact_address" class="block text-sm font-semibold text-slate-700 mb-2">Physical Address *</label>
                    <textarea name="contact_address" id="contact_address" rows="3" required
                              class="block w-full px-4 py-3 rounded-lg border border-slate-200 bg-white focus:border-accent focus:ring-2 focus:ring-accent/20 outline-none transition-all resize-none"
                              placeholder="Write the physical office address...">{{ old('contact_address', $setting->contact_address) }}</textarea>
                </div>

                <!-- Google Maps Embed Link -->
                <div>
                    <label for="contact_map_iframe" class="block text-sm font-semibold text-slate-700 mb-2">Google Maps Share / Embed Link</label>
                    <textarea name="contact_map_iframe" id="contact_map_iframe" rows="3"
                              class="block w-full px-4 py-3 rounded-lg border border-slate-200 bg-white focus:border-accent focus:ring-2 focus:ring-accent/20 outline-none transition-all text-xs"
                              placeholder="Paste the Google Maps iframe embed URL or full pb=... query string...">{{ old('contact_map_iframe', $setting->contact_map_iframe) }}</textarea>
                    <span class="block text-[11px] text-slate-400 mt-1">Provide the full `https://www.google.com/maps/embed?pb=...` URL from the Google Maps iframe sharing code.</span>
                </div>
            </div>

            <!-- Social Media Links Block -->
            <div class="p-5 bg-slate-50 rounded-xl border border-slate-150 space-y-4 mt-6">
                <div class="flex items-center gap-2 text-primary font-bold font-serif">
                    <i data-lucide="share-2" class="w-5 h-5 text-accent"></i>
                    <span>Social Media Links</span>
                </div>

                <div class="grid md:grid-cols-2 gap-6">
                    <!-- Facebook -->
                    <div>
                        <label for="social_facebook" class="block text-sm font-semibold text-slate-700 mb-2">Facebook Page Link</label>
                        <input type="text" name="social_facebook" id="social_facebook" value="{{ old('social_facebook', $setting->social_facebook) }}"
                               class="block w-full px-4 py-3 rounded-lg border border-slate-200 bg-white focus:border-accent focus:ring-2 focus:ring-accent/20 outline-none transition-all"
                               placeholder="e.g. https://facebook.com/pushpraj">
                    </div>

                    <!-- Instagram -->
                    <div>
                        <label for="social_instagram" class="block text-sm font-semibold text-slate-700 mb-2">Instagram Link</label>
                        <input type="text" name="social_instagram" id="social_instagram" value="{{ old('social_instagram', $setting->social_instagram) }}"
                               class="block w-full px-4 py-3 rounded-lg border border-slate-200 bg-white focus:border-accent focus:ring-2 focus:ring-accent/20 outline-none transition-all"
                               placeholder="e.g. https://instagram.com/pushpraj">
                    </div>
                </div>

                <div class="grid md:grid-cols-2 gap-6">
                    <!-- LinkedIn -->
                    <div>
                        <label for="social_linkedin" class="block text-sm font-semibold text-slate-700 mb-2">LinkedIn Profile Link</label>
                        <input type="text" name="social_linkedin" id="social_linkedin" value="{{ old('social_linkedin', $setting->social_linkedin) }}"
                               class="block w-full px-4 py-3 rounded-lg border border-slate-200 bg-white focus:border-accent focus:ring-2 focus:ring-accent/20 outline-none transition-all"
                               placeholder="e.g. https://linkedin.com/company/pushpraj">
                    </div>

                    <!-- Twitter -->
                    <div>
                        <label for="social_twitter" class="block text-sm font-semibold text-slate-700 mb-2">Twitter / X Link</label>
                        <input type="text" name="social_twitter" id="social_twitter" value="{{ old('social_twitter', $setting->social_twitter) }}"
                               class="block w-full px-4 py-3 rounded-lg border border-slate-200 bg-white focus:border-accent focus:ring-2 focus:ring-accent/20 outline-none transition-all"
                               placeholder="e.g. https://twitter.com/pushpraj">
                    </div>
                </div>
            </div>
        </div>
        <!-- Submit Panel -->
        <div class="flex items-center justify-between pt-6 border-t border-slate-100">
            <!-- Hint -->
            <div class="text-[11px] text-slate-400">
                Changes take effect instantly on the public website.
            </div>
            
            <div class="flex items-center gap-3">
                <button type="submit" 
                        class="px-6 py-3 rounded-lg bg-[#0f2343] hover:bg-primary text-white font-semibold shadow-sm hover:shadow-md transition-all text-sm cursor-pointer">
                    Save Changes
                </button>
            </div>
        </div>
    </form>
</div>
@endsection

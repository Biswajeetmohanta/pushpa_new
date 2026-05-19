@extends('admin.layouts.app')

@section('title', 'Add Team Member')
@section('page-title', 'Create Team Member')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.team.index') }}" class="inline-flex items-center gap-1.5 text-xs font-semibold text-slate-500 hover:text-primary transition-colors">
        <i data-lucide="arrow-left" class="w-3.5 h-3.5"></i>
        <span>Back to Team list</span>
    </a>
</div>

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

<div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden max-w-4xl">
    <form action="{{ route('admin.team.store') }}" method="POST" enctype="multipart/form-data" class="p-6 sm:p-8 space-y-6">
        @csrf
        
        <div class="grid md:grid-cols-2 gap-6">
            <!-- Member Name -->
            <div>
                <label for="name" class="block text-sm font-semibold text-slate-700 mb-2">Member Name *</label>
                <input type="text" name="name" id="name" required value="{{ old('name') }}"
                       class="block w-full px-4 py-3 rounded-lg border border-slate-200 focus:border-accent focus:ring-2 focus:ring-accent/20 outline-none transition-all"
                       placeholder="e.g. Ramesh Patel">
            </div>

            <!-- Role -->
            <div>
                <label for="role" class="block text-sm font-semibold text-slate-700 mb-2">Role / Designation *</label>
                <input type="text" name="role" id="role" required value="{{ old('role') }}"
                       class="block w-full px-4 py-3 rounded-lg border border-slate-200 focus:border-accent focus:ring-2 focus:ring-accent/20 outline-none transition-all"
                       placeholder="e.g. Founder & Managing Director">
            </div>
        </div>

        <div class="grid md:grid-cols-2 gap-6">
            <!-- Email Address -->
            <div>
                <label for="email" class="block text-sm font-semibold text-slate-700 mb-2">Email Address</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}"
                       class="block w-full px-4 py-3 rounded-lg border border-slate-200 focus:border-accent focus:ring-2 focus:ring-accent/20 outline-none transition-all"
                       placeholder="e.g. ramesh@pushpraj.com">
            </div>

            <!-- Sort Order -->
            <div>
                <label for="sort_order" class="block text-sm font-semibold text-slate-700 mb-2">Sort Order</label>
                <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', 0) }}"
                       class="block w-full px-4 py-3 rounded-lg border border-slate-200 focus:border-accent focus:ring-2 focus:ring-accent/20 outline-none transition-all"
                       placeholder="e.g. 0">
            </div>
        </div>

        <!-- Biography / Description -->
        <div>
            <label for="description" class="block text-sm font-semibold text-slate-700 mb-2">Biography / Description</label>
            <textarea name="description" id="description" rows="4"
                      class="block w-full px-4 py-3 rounded-lg border border-slate-200 focus:border-accent focus:ring-2 focus:ring-accent/20 outline-none transition-all"
                      placeholder="Write a brief professional bio for this team member...">{{ old('description') }}</textarea>
        </div>

        <!-- Qualifications & Accolades -->
        <div>
            <label for="qualifications" class="block text-sm font-semibold text-slate-700 mb-2">Qualifications & Accolades (one item per line)</label>
            <textarea name="qualifications" id="qualifications" rows="4"
                      class="block w-full px-4 py-3 rounded-lg border border-slate-200 focus:border-accent focus:ring-2 focus:ring-accent/20 outline-none transition-all"
                      placeholder="e.g.&#10;Founder & Proprietor- Pushpraj Construction&#10;Bachelor of Science (B.Sc.)&#10;17+ Years- Infrastructure & Construction Industry">{{ old('qualifications') }}</textarea>
            <span class="block text-[11px] text-slate-400 mt-1">Write each accolade or qualification on a new line. Format suggestion: 'Title- Context' or just title text.</span>
        </div>

        <!-- Team Member Avatar -->
        <div x-data="{ preview: null }">
            <label class="block text-sm font-semibold text-slate-700 mb-2">Member Photo / Portrait</label>
            <div class="mt-1 flex items-center gap-4">
                <div class="w-16 h-16 rounded-full bg-slate-100 border border-slate-200 flex items-center justify-center text-slate-400 overflow-hidden flex-shrink-0">
                    <template x-if="!preview">
                        <i data-lucide="user" class="w-6 h-6"></i>
                    </template>
                    <template x-if="preview">
                        <img :src="preview" class="w-full h-full object-cover">
                    </template>
                </div>
                <div class="flex-grow">
                    <button type="button" @click="$refs.fileInput.click()" 
                            class="px-4 py-2 border border-slate-200 hover:bg-slate-50 rounded-lg text-xs font-semibold text-slate-600 shadow-sm transition-all cursor-pointer">
                        Choose Photo
                    </button>
                    <span class="block text-[11px] text-slate-400 mt-1.5">Square portrait works best. PNG, JPG, JPEG, WEBP up to 5MB</span>
                </div>
                <input type="file" x-ref="fileInput" name="image" class="hidden" 
                       @change="let file = $event.target.files[0]; if(file) { let reader = new FileReader(); reader.onload = (e) => { preview = e.target.result; }; reader.readAsDataURL(file); }">
            </div>
        </div>

        <!-- Social URLs -->
        <div class="border-t border-slate-100 pt-6 space-y-6">
            <h3 class="text-sm font-semibold text-slate-800">Social Profile URLs (Optional)</h3>
            
            <div class="grid md:grid-cols-2 gap-6">
                <!-- LinkedIn -->
                <div>
                    <label for="linkedin" class="block text-xs font-semibold text-slate-500 mb-2">LinkedIn URL</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                            <i data-lucide="linkedin" class="w-4 h-4"></i>
                        </div>
                        <input type="url" name="linkedin" id="linkedin" value="{{ old('linkedin') }}"
                               class="block w-full pl-10 pr-4 py-2.5 rounded-lg border border-slate-200 focus:border-accent focus:ring-2 focus:ring-accent/20 outline-none transition-all text-sm"
                               placeholder="https://linkedin.com/in/username">
                    </div>
                </div>

                <!-- Facebook -->
                <div>
                    <label for="facebook" class="block text-xs font-semibold text-slate-500 mb-2">Facebook URL</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                            <i data-lucide="facebook" class="w-4 h-4"></i>
                        </div>
                        <input type="url" name="facebook" id="facebook" value="{{ old('facebook') }}"
                               class="block w-full pl-10 pr-4 py-2.5 rounded-lg border border-slate-200 focus:border-accent focus:ring-2 focus:ring-accent/20 outline-none transition-all text-sm"
                               placeholder="https://facebook.com/username">
                    </div>
                </div>
            </div>

            <div class="grid md:grid-cols-2 gap-6">
                <!-- Twitter -->
                <div>
                    <label for="twitter" class="block text-xs font-semibold text-slate-500 mb-2">Twitter URL</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                            <i data-lucide="twitter" class="w-4 h-4"></i>
                        </div>
                        <input type="url" name="twitter" id="twitter" value="{{ old('twitter') }}"
                               class="block w-full pl-10 pr-4 py-2.5 rounded-lg border border-slate-200 focus:border-accent focus:ring-2 focus:ring-accent/20 outline-none transition-all text-sm"
                               placeholder="https://twitter.com/username">
                    </div>
                </div>

                <!-- Instagram -->
                <div>
                    <label for="instagram" class="block text-xs font-semibold text-slate-500 mb-2">Instagram URL</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                            <i data-lucide="instagram" class="w-4 h-4"></i>
                        </div>
                        <input type="url" name="instagram" id="instagram" value="{{ old('instagram') }}"
                               class="block w-full pl-10 pr-4 py-2.5 rounded-lg border border-slate-200 focus:border-accent focus:ring-2 focus:ring-accent/20 outline-none transition-all text-sm"
                               placeholder="https://instagram.com/username">
                    </div>
                </div>
            </div>
        </div>

        <!-- Active Checkbox -->
        <div class="flex items-center pt-2">
            <label class="flex items-center gap-3 cursor-pointer select-none">
                <input type="checkbox" name="is_active" value="1" checked
                       class="w-5 h-5 rounded border-slate-300 text-accent focus:ring-accent">
                <div>
                    <span class="block text-sm font-semibold text-slate-800">Publish Team Member</span>
                    <span class="block text-xs text-slate-400">Make this profile card visible on the homepage team slider.</span>
                </div>
            </label>
        </div>

        <!-- Submit actions -->
        <div class="flex items-center justify-end gap-3 pt-6 border-t border-slate-100">
            <a href="{{ route('admin.team.index') }}" 
               class="px-5 py-2.5 rounded-lg border border-slate-200 hover:bg-slate-50 transition-all font-semibold text-slate-600 text-sm">
                Cancel
            </a>
            <button type="submit" 
                    class="px-5 py-2.5 rounded-lg bg-[#0f2343] hover:bg-primary text-white font-semibold shadow-sm hover:shadow-md transition-all text-sm">
                Save Member
            </button>
        </div>
    </form>
</div>
@endsection

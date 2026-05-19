@extends('admin.layouts.app')

@section('title', 'Edit Job Opening')
@section('page-title', 'Modify Job Opening')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.careers.index') }}" class="inline-flex items-center gap-1.5 text-xs font-semibold text-slate-500 hover:text-primary transition-colors">
        <i data-lucide="arrow-left" class="w-3.5 h-3.5"></i>
        <span>Back to Job Openings</span>
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
    <form action="{{ route('admin.careers.update', $career) }}" method="POST" class="p-6 sm:p-8 space-y-6">
        @csrf
        @method('PUT')
        
        <div class="grid md:grid-cols-2 gap-6">
            <!-- Job Title -->
            <div>
                <label for="title" class="block text-sm font-semibold text-slate-700 mb-2">Job Title *</label>
                <input type="text" name="title" id="title" required value="{{ old('title', $career->title) }}"
                       class="block w-full px-4 py-3 rounded-lg border border-slate-200 focus:border-accent focus:ring-2 focus:ring-accent/20 outline-none transition-all"
                       placeholder="e.g. Senior Project Manager">
            </div>

            <!-- Department -->
            <div>
                <label for="department" class="block text-sm font-semibold text-slate-700 mb-2">Department *</label>
                <input type="text" name="department" id="department" required value="{{ old('department', $career->department) }}"
                       class="block w-full px-4 py-3 rounded-lg border border-slate-200 focus:border-accent focus:ring-2 focus:ring-accent/20 outline-none transition-all"
                       placeholder="e.g. Project Management, Engineering, Accounts">
            </div>
        </div>

        <div class="grid md:grid-cols-3 gap-6">
            <!-- Employment Type -->
            <div>
                <label for="employment_type" class="block text-sm font-semibold text-slate-700 mb-2">Employment Type *</label>
                <select name="employment_type" id="employment_type" required
                        class="block w-full px-4 py-3 rounded-lg border border-slate-200 focus:border-accent focus:ring-2 focus:ring-accent/20 outline-none transition-all bg-white">
                    <option value="Full-time" {{ old('employment_type', $career->employment_type) == 'Full-time' ? 'selected' : '' }}>Full-time</option>
                    <option value="Part-time" {{ old('employment_type', $career->employment_type) == 'Part-time' ? 'selected' : '' }}>Part-time</option>
                    <option value="Contract" {{ old('employment_type', $career->employment_type) == 'Contract' ? 'selected' : '' }}>Contract</option>
                    <option value="Internship" {{ old('employment_type', $career->employment_type) == 'Internship' ? 'selected' : '' }}>Internship</option>
                </select>
            </div>

            <!-- Location -->
            <div>
                <label for="location" class="block text-sm font-semibold text-slate-700 mb-2">Location *</label>
                <input type="text" name="location" id="location" required value="{{ old('location', $career->location) }}"
                       class="block w-full px-4 py-3 rounded-lg border border-slate-200 focus:border-accent focus:ring-2 focus:ring-accent/20 outline-none transition-all"
                       placeholder="e.g. Botad, Gujarat">
            </div>

            <!-- Experience Required -->
            <div>
                <label for="experience_required" class="block text-sm font-semibold text-slate-700 mb-2">Experience Required *</label>
                <input type="text" name="experience_required" id="experience_required" required value="{{ old('experience_required', $career->experience_required) }}"
                       class="block w-full px-4 py-3 rounded-lg border border-slate-200 focus:border-accent focus:ring-2 focus:ring-accent/20 outline-none transition-all"
                       placeholder="e.g. 5-8 Years, Freshers">
            </div>
        </div>

        <div class="grid md:grid-cols-2 gap-6">
            <!-- Salary Range -->
            <div>
                <label for="salary_range" class="block text-sm font-semibold text-slate-700 mb-2">Salary Range</label>
                <input type="text" name="salary_range" id="salary_range" value="{{ old('salary_range', $career->salary_range) }}"
                       class="block w-full px-4 py-3 rounded-lg border border-slate-200 focus:border-accent focus:ring-2 focus:ring-accent/20 outline-none transition-all"
                       placeholder="e.g. ₹45,000 - ₹65,000 / Month, Best in Industry">
            </div>

            <!-- Sort Order -->
            <div>
                <label for="sort_order" class="block text-sm font-semibold text-slate-700 mb-2">Sort Order</label>
                <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', $career->sort_order) }}"
                       class="block w-full px-4 py-3 rounded-lg border border-slate-200 focus:border-accent focus:ring-2 focus:ring-accent/20 outline-none transition-all"
                       placeholder="e.g. 0">
            </div>
        </div>

        <!-- Description -->
        <div>
            <label for="description" class="block text-sm font-semibold text-slate-700 mb-2">Role Description *</label>
            <textarea name="description" id="description" rows="5" required
                      class="block w-full px-4 py-3 rounded-lg border border-slate-200 focus:border-accent focus:ring-2 focus:ring-accent/20 outline-none transition-all resize-none"
                      placeholder="Explain the roles and responsibilities associated with this civil construction opening...">{{ old('description', $career->description) }}</textarea>
        </div>

        <!-- Key Requirements -->
        <div>
            <label for="requirements" class="block text-sm font-semibold text-slate-700 mb-2">Key Requirements / Bullet Points</label>
            <textarea name="requirements" id="requirements" rows="6"
                      class="block w-full px-4 py-3 rounded-lg border border-slate-200 focus:border-accent focus:ring-2 focus:ring-accent/20 outline-none transition-all resize-none"
                      placeholder="Add one requirement per line, for example:&#10;B.Tech/D.Tech in Civil Engineering&#10;Proficiency in AutoCAD & MS Project&#10;Ability to coordinate on-site contractors">{{ old('requirements', $career->requirements) }}</textarea>
            <span class="block text-[11px] text-slate-400 mt-1">Please enter each requirement or skill on a separate line.</span>
        </div>

        <!-- Active Checkbox -->
        <div class="flex items-center pt-2">
            <label class="flex items-center gap-3 cursor-pointer select-none">
                <input type="checkbox" name="is_active" value="1" {{ $career->is_active ? 'checked' : '' }}
                       class="w-5 h-5 rounded border-slate-300 text-accent focus:ring-accent">
                <div>
                    <span class="block text-sm font-semibold text-slate-800">Publish Opening</span>
                    <span class="block text-xs text-slate-400">Make this job visible immediately on the careers openings directory.</span>
                </div>
            </label>
        </div>

        <!-- Submit actions -->
        <div class="flex items-center justify-end gap-3 pt-6 border-t border-slate-100">
            <a href="{{ route('admin.careers.index') }}" 
               class="px-5 py-2.5 rounded-lg border border-slate-200 hover:bg-slate-50 transition-all font-semibold text-slate-600 text-sm">
                Cancel
            </a>
            <button type="submit" 
                    class="px-5 py-2.5 rounded-lg bg-[#0f2343] hover:bg-primary text-white font-semibold shadow-sm hover:shadow-md transition-all text-sm">
                Update Opening
            </button>
        </div>
    </form>
</div>
@endsection

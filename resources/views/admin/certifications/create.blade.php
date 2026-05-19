@extends('admin.layouts.app')

@section('title', 'Add New Certification')
@section('page-title', 'Create Certification')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.certifications.index') }}" class="inline-flex items-center gap-1.5 text-xs font-semibold text-slate-500 hover:text-primary transition-colors">
        <i data-lucide="arrow-left" class="w-3.5 h-3.5"></i>
        <span>Back to Certifications list</span>
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
    <form action="{{ route('admin.certifications.store') }}" method="POST" enctype="multipart/form-data" class="p-6 sm:p-8 space-y-6">
        @csrf
        
        <div class="grid md:grid-cols-2 gap-6">
            <!-- Certification Title -->
            <div>
                <label for="title" class="block text-sm font-semibold text-slate-700 mb-2">Certification Name / Standard *</label>
                <input type="text" name="title" id="title" required value="{{ old('title') }}"
                       class="block w-full px-4 py-3 rounded-lg border border-slate-200 focus:border-accent focus:ring-2 focus:ring-accent/20 outline-none transition-all"
                       placeholder="e.g. ISO 9001:2015">
            </div>

            <!-- Sort Order -->
            <div>
                <label for="sort_order" class="block text-sm font-semibold text-slate-700 mb-2">Sort Order</label>
                <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', 0) }}"
                       class="block w-full px-4 py-3 rounded-lg border border-slate-200 focus:border-accent focus:ring-2 focus:ring-accent/20 outline-none transition-all"
                       placeholder="e.g. 0">
            </div>
        </div>

        <!-- Description Heading -->
        <div>
            <label for="description_heading" class="block text-sm font-semibold text-slate-700 mb-2">Description Heading / Subtitle</label>
            <input type="text" name="description_heading" id="description_heading" value="{{ old('description_heading') }}"
                   class="block w-full px-4 py-3 rounded-lg border border-slate-200 focus:border-accent focus:ring-2 focus:ring-accent/20 outline-none transition-all"
                   placeholder="e.g. Quality Management System">
        </div>

        <!-- Certification Badge / Logo -->
        <div x-data="{ preview: null }">
            <label class="block text-sm font-semibold text-slate-700 mb-2">Certificate Badge / Document Logo</label>
            <input type="file" x-ref="fileInput" name="image" class="hidden" 
                   @change="let file = $event.target.files[0]; if(file) { let reader = new FileReader(); reader.onload = (e) => { preview = e.target.result; }; reader.readAsDataURL(file); }">
            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-slate-300 border-dashed rounded-lg hover:border-accent transition-all cursor-pointer relative"
                 @click="$refs.fileInput.click()">
                <div class="space-y-1 text-center" x-show="!preview">
                    <i data-lucide="award" class="mx-auto h-12 w-12 text-slate-400"></i>
                    <div class="flex text-sm text-slate-600 justify-center">
                        <span class="relative rounded-md font-medium text-accent hover:text-[#b4922f] focus-within:outline-none">Upload Badge Logo</span>
                    </div>
                    <p class="text-xs text-slate-400">PNG, JPG, JPEG, WEBP up to 5MB</p>
                </div>
                <!-- Thumbnail Preview -->
                <div class="w-full h-48 relative" x-show="preview" x-cloak>
                    <img :src="preview" class="w-full h-full object-contain rounded-lg">
                    <button type="button" @click.stop="preview = null; $refs.fileInput.value = ''"
                            class="absolute top-2 right-2 p-1.5 bg-red-500 text-white rounded-full hover:bg-red-600 shadow-md">
                        <i data-lucide="x" class="w-4 h-4"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Description -->
        <div>
            <label for="description" class="block text-sm font-semibold text-slate-700 mb-2">Description</label>
            <textarea name="description" id="description" rows="4"
                      class="block w-full px-4 py-3 rounded-lg border border-slate-200 focus:border-accent focus:ring-2 focus:ring-accent/20 outline-none transition-all resize-none"
                      placeholder="Brief details about the audit standards, validation status, or description..."></textarea>
        </div>

        <!-- Active Checkbox -->
        <div class="flex items-center pt-2">
            <label class="flex items-center gap-3 cursor-pointer select-none">
                <input type="checkbox" name="is_active" value="1" checked
                       class="w-5 h-5 rounded border-slate-300 text-accent focus:ring-accent">
                <div>
                    <span class="block text-sm font-semibold text-slate-800">Publish Certification</span>
                    <span class="block text-xs text-slate-400">Make this certificate badge visible on the about/standards sections.</span>
                </div>
            </label>
        </div>

        <!-- Submit actions -->
        <div class="flex items-center justify-end gap-3 pt-6 border-t border-slate-100">
            <a href="{{ route('admin.certifications.index') }}" 
               class="px-5 py-2.5 rounded-lg border border-slate-200 hover:bg-slate-50 transition-all font-semibold text-slate-600 text-sm">
                Cancel
            </a>
            <button type="submit" 
                    class="px-5 py-2.5 rounded-lg bg-[#0f2343] hover:bg-primary text-white font-semibold shadow-sm hover:shadow-md transition-all text-sm">
                Save Certification
            </button>
        </div>
    </form>
</div>
@endsection

@extends('admin.layouts.app')

@section('title', 'Edit Testimonial')
@section('page-title', 'Modify Testimonial')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.testimonials.index') }}" class="inline-flex items-center gap-1.5 text-xs font-semibold text-slate-500 hover:text-primary transition-colors">
        <i data-lucide="arrow-left" class="w-3.5 h-3.5"></i>
        <span>Back to Testimonials list</span>
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
    <form action="{{ route('admin.testimonials.update', $testimonial) }}" method="POST" enctype="multipart/form-data" class="p-6 sm:p-8 space-y-6">
        @csrf
        @method('PUT')
        
        <div class="grid md:grid-cols-3 gap-6">
            <!-- Client Name -->
            <div class="md:col-span-2">
                <label for="name" class="block text-sm font-semibold text-slate-700 mb-2">Client Name *</label>
                <input type="text" name="name" id="name" required value="{{ old('name', $testimonial->name) }}"
                       class="block w-full px-4 py-3 rounded-lg border border-slate-200 focus:border-accent focus:ring-2 focus:ring-accent/20 outline-none transition-all"
                       placeholder="e.g. Rajesh Shah">
            </div>

            <!-- Star Rating -->
            <div>
                <label for="rating" class="block text-sm font-semibold text-slate-700 mb-2">Star Rating *</label>
                <select name="rating" id="rating" required
                        class="block w-full px-4 py-3 rounded-lg border border-slate-200 focus:border-accent focus:ring-2 focus:ring-accent/20 outline-none transition-all bg-white font-semibold">
                    <option value="5" {{ old('rating', $testimonial->rating) == 5 ? 'selected' : '' }}>5 Stars</option>
                    <option value="4" {{ old('rating', $testimonial->rating) == 4 ? 'selected' : '' }}>4 Stars</option>
                    <option value="3" {{ old('rating', $testimonial->rating) == 3 ? 'selected' : '' }}>3 Stars</option>
                    <option value="2" {{ old('rating', $testimonial->rating) == 2 ? 'selected' : '' }}>2 Stars</option>
                    <option value="1" {{ old('rating', $testimonial->rating) == 1 ? 'selected' : '' }}>1 Star</option>
                </select>
            </div>
        </div>

        <div class="grid md:grid-cols-3 gap-6">
            <!-- Role / Designation -->
            <div>
                <label for="role" class="block text-sm font-semibold text-slate-700 mb-2">Designation / Role</label>
                <input type="text" name="role" id="role" value="{{ old('role', $testimonial->role) }}"
                       class="block w-full px-4 py-3 rounded-lg border border-slate-200 focus:border-accent focus:ring-2 focus:ring-accent/20 outline-none transition-all"
                       placeholder="e.g. Project Director">
            </div>

            <!-- Company Name -->
            <div>
                <label for="company" class="block text-sm font-semibold text-slate-700 mb-2">Company / Organization</label>
                <input type="text" name="company" id="company" value="{{ old('company', $testimonial->company) }}"
                       class="block w-full px-4 py-3 rounded-lg border border-slate-200 focus:border-accent focus:ring-2 focus:ring-accent/20 outline-none transition-all"
                       placeholder="e.g. Gujarat Infratech Ltd">
            </div>

            <!-- Sort Order -->
            <div>
                <label for="sort_order" class="block text-sm font-semibold text-slate-700 mb-2">Sort Order</label>
                <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', $testimonial->sort_order) }}"
                       class="block w-full px-4 py-3 rounded-lg border border-slate-200 focus:border-accent focus:ring-2 focus:ring-accent/20 outline-none transition-all"
                       placeholder="e.g. 0">
            </div>
        </div>

        <!-- Client Avatar -->
        <div x-data="{ preview: '{{ $testimonial->image ?? '' }}' }">
            <label class="block text-sm font-semibold text-slate-700 mb-2">Client Photo / Avatar</label>
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
                            class="px-4 py-2 border border-slate-200 hover:bg-slate-50 rounded-lg text-xs font-semibold text-slate-600 shadow-sm transition-all">
                        Change Photo
                    </button>
                    <span class="block text-[11px] text-slate-400 mt-1.5">PNG, JPG, JPEG, WEBP up to 5MB</span>
                </div>
                <input type="file" ref="fileInput" name="image" class="hidden" 
                       @change="let file = $event.target.files[0]; if(file) { let reader = new FileReader(); reader.onload = (e) => { preview = e.target.result; }; reader.readAsDataURL(file); }">
            </div>
        </div>

        <!-- Quote Text -->
        <div>
            <label for="text" class="block text-sm font-semibold text-slate-700 mb-2">Testimonial Quote *</label>
            <textarea name="text" id="text" required rows="4"
                      class="block w-full px-4 py-3 rounded-lg border border-slate-200 focus:border-accent focus:ring-2 focus:ring-accent/20 outline-none transition-all resize-none"
                      placeholder="Write the quote given by the client here...">{{ old('text', $testimonial->text) }}</textarea>
        </div>

        <!-- Active Checkbox -->
        <div class="flex items-center pt-2">
            <label class="flex items-center gap-3 cursor-pointer select-none">
                <input type="checkbox" name="is_active" value="1" {{ $testimonial->is_active ? 'checked' : '' }}
                       class="w-5 h-5 rounded border-slate-300 text-accent focus:ring-accent">
                <div>
                    <span class="block text-sm font-semibold text-slate-800">Publish Testimonial</span>
                    <span class="block text-xs text-slate-400">Make this review visible inside the frontend slider.</span>
                </div>
            </label>
        </div>

        <!-- Submit actions -->
        <div class="flex items-center justify-end gap-3 pt-6 border-t border-slate-100">
            <a href="{{ route('admin.testimonials.index') }}" 
               class="px-5 py-2.5 rounded-lg border border-slate-200 hover:bg-slate-50 transition-all font-semibold text-slate-600 text-sm">
                Cancel
            </a>
            <button type="submit" 
                    class="px-5 py-2.5 rounded-lg bg-[#0f2343] hover:bg-primary text-white font-semibold shadow-sm hover:shadow-md transition-all text-sm">
                Update Testimonial
            </button>
        </div>
    </form>
</div>
@endsection

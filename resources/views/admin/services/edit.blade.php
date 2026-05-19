@extends('admin.layouts.app')

@section('title', 'Edit Service')
@section('page-title', 'Modify Service')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.services.index') }}" class="inline-flex items-center gap-1.5 text-xs font-semibold text-slate-500 hover:text-primary transition-colors">
        <i data-lucide="arrow-left" class="w-3.5 h-3.5"></i>
        <span>Back to Services list</span>
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
    <form action="{{ route('admin.services.update', $service) }}" method="POST" class="p-6 sm:p-8 space-y-6">
        @csrf
        @method('PUT')
        
        <div class="grid md:grid-cols-2 gap-6">
            <!-- Service Title -->
            <div>
                <label for="title" class="block text-sm font-semibold text-slate-700 mb-2">Service Title *</label>
                <input type="text" name="title" id="title" required value="{{ old('title', $service->title) }}"
                       class="block w-full px-4 py-3 rounded-lg border border-slate-200 focus:border-accent focus:ring-2 focus:ring-accent/20 outline-none transition-all"
                       placeholder="e.g. Highways & Roads">
            </div>

            <!-- Lucide Icon name -->
            <div>
                <label for="icon" class="block text-sm font-semibold text-slate-700 mb-2">Lucide Icon Identifier</label>
                <input type="text" name="icon" id="icon" value="{{ old('icon', $service->icon) }}"
                       class="block w-full px-4 py-3 rounded-lg border border-slate-200 focus:border-accent focus:ring-2 focus:ring-accent/20 outline-none transition-all"
                       placeholder="e.g. briefcase, road, building, droplet">
                <span class="block text-[11px] text-slate-400 mt-1">Use valid Lucide icon name (e.g. "building", "droplet", "road", "briefcase", "compass").</span>
            </div>
        </div>

        <div class="grid md:grid-cols-2 gap-6">
            <!-- Sort Order -->
            <div>
                <label for="sort_order" class="block text-sm font-semibold text-slate-700 mb-2">Sort Order</label>
                <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', $service->sort_order) }}"
                       class="block w-full px-4 py-3 rounded-lg border border-slate-200 focus:border-accent focus:ring-2 focus:ring-accent/20 outline-none transition-all"
                       placeholder="e.g. 0">
            </div>
        </div>

        <!-- Description -->
        <div>
            <label for="description" class="block text-sm font-semibold text-slate-700 mb-2">Service Description</label>
            <textarea name="description" id="description" rows="4"
                      class="block w-full px-4 py-3 rounded-lg border border-slate-200 focus:border-accent focus:ring-2 focus:ring-accent/20 outline-none transition-all resize-none"
                      placeholder="Explain the scope and nature of this civil construction service...">{{ old('description', $service->description) }}</textarea>
        </div>

        <!-- Key Features -->
        <div>
            <label for="features" class="block text-sm font-semibold text-slate-700 mb-2">Key Service Features / Bullet Points</label>
            <textarea name="features" id="features" rows="5"
                      class="block w-full px-4 py-3 rounded-lg border border-slate-200 focus:border-accent focus:ring-2 focus:ring-accent/20 outline-none transition-all resize-none"
                      placeholder="Add one feature per line, for example:&#10;NHAI certified construction&#10;Rigid & flexible pavement design&#10;Heavy load capacity testing">{{ old('features', $features) }}</textarea>
            <span class="block text-[11px] text-slate-400 mt-1">Please enter each feature bullet point on a separate line.</span>
        </div>

        <!-- Active Checkbox -->
        <div class="flex items-center pt-2">
            <label class="flex items-center gap-3 cursor-pointer select-none">
                <input type="checkbox" name="is_active" value="1" {{ $service->is_active ? 'checked' : '' }}
                       class="w-5 h-5 rounded border-slate-300 text-accent focus:ring-accent">
                <div>
                    <span class="block text-sm font-semibold text-slate-800">Publish Service</span>
                    <span class="block text-xs text-slate-400">Make this service visible on the homepage grids.</span>
                </div>
            </label>
        </div>

        <!-- Submit actions -->
        <div class="flex items-center justify-end gap-3 pt-6 border-t border-slate-100">
            <a href="{{ route('admin.services.index') }}" 
               class="px-5 py-2.5 rounded-lg border border-slate-200 hover:bg-slate-50 transition-all font-semibold text-slate-600 text-sm">
                Cancel
            </a>
            <button type="submit" 
                    class="px-5 py-2.5 rounded-lg bg-[#0f2343] hover:bg-primary text-white font-semibold shadow-sm hover:shadow-md transition-all text-sm">
                Update Service
            </button>
        </div>
    </form>
</div>
@endsection

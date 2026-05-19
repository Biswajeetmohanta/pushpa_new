@extends('admin.layouts.app')

@section('title', 'Edit Milestone')
@section('page-title', 'Modify Milestone')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.milestones.index') }}" class="inline-flex items-center gap-1.5 text-xs font-semibold text-slate-500 hover:text-primary transition-colors">
        <i data-lucide="arrow-left" class="w-3.5 h-3.5"></i>
        <span>Back to Milestones list</span>
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
    <form action="{{ route('admin.milestones.update', $milestone) }}" method="POST" class="p-6 sm:p-8 space-y-6">
        @csrf
        @method('PUT')
        
        <div class="grid md:grid-cols-2 gap-6">
            <!-- Year -->
            <div>
                <label for="year" class="block text-sm font-semibold text-slate-700 mb-2">Year / Date Label *</label>
                <input type="text" name="year" id="year" required value="{{ old('year', $milestone->year) }}"
                       class="block w-full px-4 py-3 rounded-lg border border-slate-200 focus:border-accent focus:ring-2 focus:ring-accent/20 outline-none transition-all"
                       placeholder="e.g. 2018 or October 2022">
            </div>

            <!-- Milestone Title -->
            <div>
                <label for="title" class="block text-sm font-semibold text-slate-700 mb-2">Milestone Title *</label>
                <input type="text" name="title" id="title" required value="{{ old('title', $milestone->title) }}"
                       class="block w-full px-4 py-3 rounded-lg border border-slate-200 focus:border-accent focus:ring-2 focus:ring-accent/20 outline-none transition-all"
                       placeholder="e.g. ISO 9001 Certification">
            </div>
        </div>

        <div class="grid md:grid-cols-2 gap-6">
            <!-- Sort Order -->
            <div>
                <label for="sort_order" class="block text-sm font-semibold text-slate-700 mb-2">Sort Order</label>
                <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', $milestone->sort_order) }}"
                       class="block w-full px-4 py-3 rounded-lg border border-slate-200 focus:border-accent focus:ring-2 focus:ring-accent/20 outline-none transition-all"
                       placeholder="e.g. 0">
            </div>
        </div>

        <!-- Description -->
        <div>
            <label for="description" class="block text-sm font-semibold text-slate-700 mb-2">Milestone Description</label>
            <textarea name="description" id="description" rows="4"
                      class="block w-full px-4 py-3 rounded-lg border border-slate-200 focus:border-accent focus:ring-2 focus:ring-accent/20 outline-none transition-all resize-none"
                      placeholder="Provide specific details about this landmark company achievement...">{{ old('description', $milestone->description) }}</textarea>
        </div>

        <!-- Active Checkbox -->
        <div class="flex items-center pt-2">
            <label class="flex items-center gap-3 cursor-pointer select-none">
                <input type="checkbox" name="is_active" value="1" {{ $milestone->is_active ? 'checked' : '' }}
                       class="w-5 h-5 rounded border-slate-300 text-accent focus:ring-accent">
                <div>
                    <span class="block text-sm font-semibold text-slate-800">Publish Milestone</span>
                    <span class="block text-xs text-slate-400">Make this timeline node visible on the main page.</span>
                </div>
            </label>
        </div>

        <!-- Submit actions -->
        <div class="flex items-center justify-end gap-3 pt-6 border-t border-slate-100">
            <a href="{{ route('admin.milestones.index') }}" 
               class="px-5 py-2.5 rounded-lg border border-slate-200 hover:bg-slate-50 transition-all font-semibold text-slate-600 text-sm">
                Cancel
            </a>
            <button type="submit" 
                    class="px-5 py-2.5 rounded-lg bg-[#0f2343] hover:bg-primary text-white font-semibold shadow-sm hover:shadow-md transition-all text-sm">
                Update Milestone
            </button>
        </div>
    </form>
</div>
@endsection

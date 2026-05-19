@extends('admin.layouts.app')

@section('title', 'Candidate Details')
@section('page-title', 'Review Application')

@section('content')
<div class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
    <a href="{{ route('admin.applications.index') }}" class="inline-flex items-center gap-1.5 text-xs font-semibold text-slate-500 hover:text-primary transition-colors">
        <i data-lucide="arrow-left" class="w-3.5 h-3.5"></i>
        <span>Back to Applications</span>
    </a>
    
    <!-- Delete Action -->
    <form action="{{ route('admin.applications.destroy', $application) }}" method="POST" onsubmit="confirmDelete(event, this)">
        @csrf
        @method('DELETE')
        <button type="submit" class="inline-flex items-center gap-1.5 px-3.5 py-2 border border-red-200 hover:bg-red-50 text-red-650 font-semibold rounded-lg text-xs shadow-xs transition-colors cursor-pointer">
            <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
            <span>Remove Application</span>
        </button>
    </form>
</div>

@if(session('success'))
    <div class="mb-6 p-4 bg-emerald-50 border-l-4 border-emerald-500 rounded-r-lg text-emerald-800 text-sm">
        <div class="flex items-center gap-2 mb-1">
            <i data-lucide="check-circle" class="w-4 h-4 text-emerald-500"></i>
            <span class="font-semibold">Success</span>
        </div>
        <p>{{ session('success') }}</p>
    </div>
@endif

<div class="grid lg:grid-cols-3 gap-8 items-start">
    <!-- Left: Profile & Status Management Card -->
    <div class="lg:col-span-1 space-y-6">
        <!-- Profile Card -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 flex flex-col items-center text-center">
            <div class="w-16 h-16 rounded-full bg-[#0f2343]/10 text-primary flex items-center justify-center font-serif text-2xl font-bold uppercase mb-4">
                {{ substr($application->name, 0, 2) }}
            </div>
            <h3 class="font-serif text-xl font-bold text-slate-800">{{ $application->name }}</h3>
            
            <div class="mt-2 text-xs text-slate-400">
                Applied {{ $application->created_at->format('M d, Y') }}
            </div>

            <!-- Position Target -->
            <div class="mt-4 w-full pt-4 border-t border-slate-100 text-left">
                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block mb-1">Target Opening</span>
                @if($application->jobOpening)
                    <div class="font-bold text-slate-700 text-sm">{{ $application->jobOpening->title }}</div>
                    <span class="inline-flex px-2 py-0.5 rounded bg-indigo-50 text-indigo-700 text-[10px] font-semibold uppercase mt-1">
                        {{ $application->jobOpening->department }}
                    </span>
                @else
                    <span class="inline-flex px-2.5 py-0.5 rounded bg-slate-100 text-slate-500 text-[10px] font-bold uppercase tracking-wide">
                        General Submission
                    </span>
                @endif
            </div>

            <!-- Contact Details -->
            <div class="mt-4 w-full pt-4 border-t border-slate-100 text-left space-y-3 text-sm text-slate-600">
                <div class="flex items-center gap-2">
                    <i data-lucide="mail" class="w-4 h-4 text-slate-400"></i>
                    <a href="mailto:{{ $application->email }}" class="hover:underline text-slate-700 font-medium truncate">{{ $application->email }}</a>
                </div>
                <div class="flex items-center gap-2">
                    <i data-lucide="phone" class="w-4 h-4 text-slate-400"></i>
                    <a href="tel:{{ $application->phone }}" class="hover:underline text-slate-700 font-medium">{{ $application->phone }}</a>
                </div>
            </div>
        </div>

        <!-- Status Transitions Card -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
            <h4 class="font-sans font-bold text-slate-800 text-xs uppercase tracking-wider mb-4">Application Review Status</h4>
            <form action="{{ route('admin.applications.status', $application) }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')
                
                <div>
                    <label for="status" class="block text-xs font-semibold text-slate-500 mb-2">Review Stage</label>
                    <select name="status" id="status" required
                            class="block w-full px-4 py-2.5 rounded-lg border border-slate-200 focus:border-accent focus:ring-2 focus:ring-accent/20 outline-none transition-all bg-white text-sm">
                        <option value="new" {{ $application->status == 'new' ? 'selected' : '' }}>Unprocessed</option>
                        <option value="viewed" {{ $application->status == 'viewed' ? 'selected' : '' }}>Reviewed</option>
                        <option value="shortlisted" {{ $application->status == 'shortlisted' ? 'selected' : '' }}>Shortlisted</option>
                        <option value="hired" {{ $application->status == 'hired' ? 'selected' : '' }}>Hired</option>
                        <option value="rejected" {{ $application->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                    </select>
                </div>

                <button type="submit" 
                        class="w-full px-4 py-2.5 rounded-lg bg-[#0f2343] hover:bg-primary text-white font-semibold text-xs shadow-sm hover:shadow transition-colors flex items-center justify-center gap-1.5 cursor-pointer">
                    <i data-lucide="save" class="w-3.5 h-3.5"></i>
                    <span>Save Status Stage</span>
                </button>
            </form>
        </div>
    </div>

    <!-- Right: Resume Preview & Cover Letter -->
    <div class="lg:col-span-2 space-y-6">
        <!-- Cover Letter -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
            <h4 class="font-sans font-bold text-slate-800 text-xs uppercase tracking-wider mb-4 border-b border-slate-100 pb-2">Cover Letter / Submission Message</h4>
            <div class="text-slate-600 text-sm leading-relaxed whitespace-pre-wrap min-h-20 bg-slate-50 rounded-xl p-4 border border-slate-100">
                @if($application->cover_letter)
                    {{ $application->cover_letter }}
                @else
                    <span class="text-slate-400 italic">No cover letter was submitted by this candidate.</span>
                @endif
            </div>
        </div>

        <!-- Resume File Preview / Download -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 flex flex-col">
            <div class="flex items-center justify-between mb-4 border-b border-slate-100 pb-2 flex-wrap gap-3">
                <div>
                    <h4 class="font-sans font-bold text-slate-800 text-xs uppercase tracking-wider">Uploaded CV / Resume Document</h4>
                </div>
                <a href="{{ asset($application->resume) }}" 
                   download 
                   class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-emerald-50 hover:bg-emerald-100 text-emerald-800 font-bold rounded-lg text-xs transition-colors cursor-pointer border border-emerald-100">
                    <i data-lucide="download" class="w-3.5 h-3.5"></i>
                    <span>Download CV File</span>
                </a>
            </div>

            <!-- PDF Viewer Frame or download prompt -->
            @php
                $ext = pathinfo($application->resume, PATHINFO_EXTENSION);
            @endphp
            @if(strtolower($ext) === 'pdf')
                <div class="border border-slate-200 rounded-xl overflow-hidden aspect-[3/4] lg:aspect-[4/5] bg-slate-100 relative">
                    <iframe src="{{ asset($application->resume) }}#toolbar=0" class="w-full h-full" border="0"></iframe>
                </div>
            @else
                <div class="border border-dashed border-slate-200 rounded-xl p-8 text-center text-slate-400 bg-slate-50 flex flex-col items-center justify-center">
                    <i data-lucide="file-text" class="w-12 h-12 text-slate-300 mb-3 animate-pulse"></i>
                    <h5 class="font-bold text-slate-700 mb-1">Inline Preview Unavailable</h5>
                    <p class="text-xs text-slate-400 mb-4">This document is uploaded in <strong>.{{ $ext }}</strong> format, which cannot be previewed directly inside the web browser.</p>
                    <a href="{{ asset($application->resume) }}" download
                       class="px-4 py-2 bg-[#0f2343] text-white hover:bg-primary rounded-lg text-xs font-semibold shadow-sm transition-colors cursor-pointer">
                        Download to View CV
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

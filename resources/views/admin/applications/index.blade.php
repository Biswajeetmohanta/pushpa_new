@extends('admin.layouts.app')

@section('title', 'Job Applications')
@section('page-title', 'Job Applications')

@section('content')
<div class="mb-6">
    <p class="text-sm text-slate-500">Review all incoming CV submissions, download candidate resumes, transition statuses, or filter details.</p>
</div>

<!-- Desktop Table View -->
<div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden hidden md:block">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 border-b border-slate-200 text-xs font-semibold text-slate-500 uppercase tracking-wider">
                    <th class="px-6 py-4">Candidate Details</th>
                    <th class="px-6 py-4">Target Position</th>
                    <th class="px-6 py-4">Contact Info</th>
                    <th class="px-6 py-4 text-center">Applied Date</th>
                    <th class="px-6 py-4 text-center">Status</th>
                    <th class="px-6 py-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 text-sm">
                @forelse($applications as $app)
                    <tr class="hover:bg-slate-50/50 transition-colors {{ $app->status === 'new' ? 'bg-amber-50/10 font-medium' : '' }}">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-full bg-slate-100 flex items-center justify-center font-bold text-slate-600 uppercase">
                                    {{ substr($app->name, 0, 2) }}
                                </div>
                                <div>
                                    <div class="font-bold text-slate-800 flex items-center gap-1.5">
                                        <span>{{ $app->name }}</span>
                                        @if($app->status === 'new')
                                            <span class="inline-flex px-1.5 py-0.5 rounded text-[8px] font-bold bg-rose-500 text-white uppercase tracking-wide">New</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($app->jobOpening)
                                <div class="font-semibold text-slate-700">{{ $app->jobOpening->title }}</div>
                                <div class="text-[11px] text-slate-400 mt-0.5">{{ $app->jobOpening->department }}</div>
                            @else
                                <span class="inline-flex px-2 py-0.5 rounded bg-slate-100 text-slate-500 text-[10px] font-bold uppercase tracking-wide">
                                    General Application
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-slate-500">
                            <div>{{ $app->email }}</div>
                            <div class="text-[11px] text-slate-400 mt-0.5">{{ $app->phone }}</div>
                        </td>
                        <td class="px-6 py-4 text-center whitespace-nowrap text-slate-400 text-xs">
                            {{ $app->created_at->format('M d, Y') }}
                            <div class="text-[10px]">{{ $app->created_at->format('h:i A') }}</div>
                        </td>
                        <td class="px-6 py-4 text-center whitespace-nowrap">
                            @if($app->status === 'new')
                                <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-semibold bg-rose-50 text-rose-600 border border-rose-100">Unprocessed</span>
                            @elseif($app->status === 'viewed')
                                <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-semibold bg-blue-50 text-blue-600 border border-blue-100">Reviewed</span>
                            @elseif($app->status === 'shortlisted')
                                <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-semibold bg-amber-50 text-amber-700 border border-amber-100">Shortlisted</span>
                            @elseif($app->status === 'hired')
                                <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-100">Hired</span>
                            @else
                                <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-semibold bg-slate-50 text-slate-400 border border-slate-150">Rejected</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right whitespace-nowrap">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.applications.show', $app) }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-[#0f2343]/10 hover:bg-[#0f2343] text-primary hover:text-white font-semibold rounded-lg text-xs transition-all cursor-pointer" title="View CV">
                                    <i data-lucide="eye" class="w-3.5 h-3.5"></i>
                                    <span>Review CV</span>
                                </a>
                                <form action="{{ route('admin.applications.destroy', $app) }}" method="POST" class="inline" onsubmit="confirmDelete(event, this)">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 text-red-600 hover:text-red-800 hover:bg-red-50 rounded-lg transition-colors" title="Delete">
                                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-slate-400">
                            <div class="flex flex-col items-center justify-center gap-2">
                                <i data-lucide="file-badge" class="w-8 h-8 text-slate-300"></i>
                                <span>No candidate applications received yet.</span>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Mobile Card View -->
<div class="md:hidden space-y-4">
    @forelse($applications as $app)
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-4 {{ $app->status === 'new' ? 'border-l-4 border-l-rose-500' : '' }}">
            <div class="flex items-start justify-between gap-3">
                <div class="flex-1 min-w-0">
                    <div class="font-bold text-slate-800 text-sm flex items-center gap-1.5">
                        <span>{{ $app->name }}</span>
                        @if($app->status === 'new')
                            <span class="px-1 py-0.5 rounded bg-rose-500 text-white text-[8px] font-bold uppercase tracking-wide">New</span>
                        @endif
                    </div>
                    
                    <div class="text-xs text-slate-600 mt-1 font-semibold">
                        @if($app->jobOpening)
                            {{ $app->jobOpening->title }}
                        @else
                            General Submission
                        @endif
                    </div>

                    <div class="text-[11px] text-slate-400 mt-2 font-sans space-y-0.5">
                        <div>Email: {{ $app->email }}</div>
                        <div>Phone: {{ $app->phone }}</div>
                        <div class="mt-1">Applied: {{ $app->created_at->format('M d, Y h:i A') }}</div>
                    </div>

                    <div class="mt-3 flex items-center justify-between">
                        <div>
                            @if($app->status === 'new')
                                <span class="inline-flex px-2 py-0.5 rounded-full text-[10px] font-semibold bg-rose-50 text-rose-600 border border-rose-100">Unprocessed</span>
                            @elseif($app->status === 'viewed')
                                <span class="inline-flex px-2 py-0.5 rounded-full text-[10px] font-semibold bg-blue-50 text-blue-600 border border-blue-100">Reviewed</span>
                            @elseif($app->status === 'shortlisted')
                                <span class="inline-flex px-2 py-0.5 rounded-full text-[10px] font-semibold bg-amber-50 text-amber-700 border border-amber-100">Shortlisted</span>
                            @elseif($app->status === 'hired')
                                <span class="inline-flex px-2 py-0.5 rounded-full text-[10px] font-semibold bg-emerald-50 text-emerald-700 border border-emerald-100">Hired</span>
                            @else
                                <span class="inline-flex px-2 py-0.5 rounded-full text-[10px] font-semibold bg-slate-50 text-slate-400 border border-slate-150">Rejected</span>
                            @endif
                        </div>

                        <div class="flex items-center gap-1">
                            <a href="{{ route('admin.applications.show', $app) }}" class="inline-flex items-center gap-1 px-2.5 py-1.5 bg-[#0f2343] text-white font-bold rounded-lg text-[10px] transition-colors">
                                <i data-lucide="eye" class="w-3 h-3"></i>
                                <span>Review</span>
                            </a>
                            <form action="{{ route('admin.applications.destroy', $app) }}" method="POST" onsubmit="confirmDelete(event, this)">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-1.5 text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                                    <i data-lucide="trash-2" class="w-4 h-4"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-8 text-center text-slate-400">
            <i data-lucide="file-badge" class="w-8 h-8 mx-auto mb-2 text-slate-300"></i>
            <p class="text-sm">No candidate applications received yet.</p>
        </div>
    @endforelse
</div>
@endsection

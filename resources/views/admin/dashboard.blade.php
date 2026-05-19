@extends('admin.layouts.app')

@section('title', 'Admin Dashboard')
@section('page-title', 'System Overview')

@section('content')
<div class="space-y-8">
    <!-- Welcome Header Card -->
    <div class="relative bg-[#0f2343] text-white rounded-2xl p-6 sm:p-8 overflow-hidden shadow-md">
        <div class="absolute inset-0 opacity-10 bg-[radial-gradient(ellipse_at_top_right,_var(--tw-gradient-stops))] from-accent via-slate-900 to-[#0f2343]"></div>
        <div class="relative z-10 max-w-2xl">
            <h3 class="font-serif text-2xl sm:text-3xl font-bold mb-2">Welcome Back, {{ Auth::user()->name }}!</h3>
            <p class="text-white/80 text-sm sm:text-base leading-relaxed">
                Manage your construction projects, handle client inquiries, and edit details displayed on the website. Here's a brief summary of system statistics.
            </p>
        </div>
        <div class="absolute right-8 bottom-0 top-0 hidden md:flex items-center text-accent opacity-20">
            <i data-lucide="building-2" class="w-48 h-48"></i>
        </div>
    </div>

    <!-- Quick Stats Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Projects Card -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 flex items-center gap-5 hover:shadow-md transition-shadow">
            <div class="w-12 h-12 rounded-lg bg-blue-50 text-[#0f2343] flex items-center justify-center flex-shrink-0 border border-blue-100">
                <i data-lucide="layout-grid" class="w-6 h-6"></i>
            </div>
            <div>
                <div class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Total Projects</div>
                <div class="text-3xl font-bold text-slate-800 mt-1">{{ $stats['projects'] }}</div>
            </div>
        </div>

        <!-- Services Card -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 flex items-center gap-5 hover:shadow-md transition-shadow">
            <div class="w-12 h-12 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center flex-shrink-0 border border-emerald-100">
                <i data-lucide="briefcase" class="w-6 h-6"></i>
            </div>
            <div>
                <div class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Services Offered</div>
                <div class="text-3xl font-bold text-slate-800 mt-1">{{ $stats['services'] }}</div>
            </div>
        </div>

        <!-- Testimonials Card -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 flex items-center gap-5 hover:shadow-md transition-shadow">
            <div class="w-12 h-12 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center flex-shrink-0 border border-amber-100">
                <i data-lucide="message-square" class="w-6 h-6"></i>
            </div>
            <div>
                <div class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Client Reviews</div>
                <div class="text-3xl font-bold text-slate-800 mt-1">{{ $stats['testimonials'] }}</div>
            </div>
        </div>

        <!-- Job Openings Card -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 flex items-center gap-5 hover:shadow-md transition-shadow">
            <div class="w-12 h-12 rounded-lg bg-indigo-50 text-indigo-600 flex items-center justify-center flex-shrink-0 border border-indigo-100">
                <i data-lucide="clipboard-list" class="w-6 h-6"></i>
            </div>
            <div>
                <div class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Job Openings</div>
                <div class="text-3xl font-bold text-slate-800 mt-1">{{ $stats['job_openings'] }}</div>
            </div>
        </div>

        <!-- Job Applications Card -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 flex items-center gap-5 hover:shadow-md transition-shadow relative overflow-hidden">
            <div class="w-12 h-12 rounded-lg {{ $stats['unread_applications'] > 0 ? 'bg-rose-50 text-rose-600 border-rose-100' : 'bg-slate-50 text-slate-400 border-slate-100' }} flex items-center justify-center flex-shrink-0 border">
                <i data-lucide="file-badge" class="w-6 h-6"></i>
            </div>
            <div>
                <div class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Unread Applications</div>
                <div class="text-3xl font-bold {{ $stats['unread_applications'] > 0 ? 'text-rose-600' : 'text-slate-800' }} mt-1">{{ $stats['unread_applications'] }}</div>
            </div>
            @if($stats['unread_applications'] > 0)
                <span class="absolute top-2 right-2 flex h-2 w-2">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-rose-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-rose-500"></span>
                </span>
            @endif
        </div>

        <!-- Unread Messages Card -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 flex items-center gap-5 hover:shadow-md transition-shadow relative overflow-hidden">
            <div class="w-12 h-12 rounded-lg {{ $stats['unread_messages'] > 0 ? 'bg-red-50 text-red-600 border-red-100' : 'bg-slate-50 text-slate-400 border-slate-100' }} flex items-center justify-center flex-shrink-0 border">
                <i data-lucide="mail" class="w-6 h-6"></i>
            </div>
            <div>
                <div class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Unread Inbox</div>
                <div class="text-3xl font-bold {{ $stats['unread_messages'] > 0 ? 'text-red-600' : 'text-slate-800' }} mt-1">{{ $stats['unread_messages'] }}</div>
            </div>
            @if($stats['unread_messages'] > 0)
                <span class="absolute top-2 right-2 flex h-2 w-2">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-red-500"></span>
                </span>
            @endif
        </div>
    </div>

    <!-- Main Content Layout -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- Left: Recent Inbox Submissions -->
        <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden flex flex-col">
            <div class="px-6 py-5 border-b border-slate-150 flex items-center justify-between">
                <h4 class="font-serif font-bold text-lg text-[#0f2343]">Recent Client Messages</h4>
                <a href="{{ route('admin.contact.index') }}" class="text-xs font-semibold text-accent hover:text-[#b4922f] flex items-center gap-1">
                    <span>View All Inbox</span>
                    <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                </a>
            </div>
            
            <!-- Desktop Table View -->
            <div class="overflow-x-auto flex-grow hidden md:block">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-200 text-[10px] font-semibold text-slate-400 uppercase tracking-wider">
                            <th class="px-6 py-3">Sender</th>
                            <th class="px-6 py-3">Service</th>
                            <th class="px-6 py-3">Received</th>
                            <th class="px-6 py-3 text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-xs">
                        @forelse($recentSubmissions as $sub)
                            <tr class="hover:bg-slate-50/50 transition-colors {{ $sub->status === 'new' ? 'bg-blue-50/30 font-medium' : '' }}">
                                <td class="px-6 py-4">
                                    <div class="font-bold text-slate-800">{{ $sub->name }}</div>
                                    <div class="text-[10px] text-slate-400 mt-0.5">{{ $sub->email }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex px-2 py-0.5 rounded bg-slate-100 text-slate-600 text-[10px] font-semibold uppercase">
                                        {{ $sub->service ?? 'General' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-slate-500 whitespace-nowrap">
                                    {{ $sub->created_at->diffForHumans() }}
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <a href="{{ route('admin.contact.show', $sub) }}" class="inline-flex items-center justify-center p-1.5 text-slate-600 hover:text-primary hover:bg-slate-100 rounded-md transition-all">
                                        <i data-lucide="mail-open" class="w-4 h-4"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center text-slate-400">
                                    <div class="flex flex-col items-center justify-center gap-1.5">
                                        <i data-lucide="inbox" class="w-8 h-8 text-slate-300"></i>
                                        <span>No inquiries received yet.</span>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Mobile Card View -->
            <div class="md:hidden divide-y divide-slate-100 flex-grow">
                @forelse($recentSubmissions as $sub)
                    <div class="p-4 flex items-start justify-between gap-3 {{ $sub->status === 'new' ? 'bg-blue-50/20' : '' }}">
                        <div class="min-w-0 flex-1">
                            <div class="font-bold text-slate-800 text-sm truncate">{{ $sub->name }}</div>
                            <div class="text-[11px] text-slate-400 truncate mt-0.5">{{ $sub->email }}</div>
                            <div class="flex items-center gap-2 mt-2">
                                <span class="inline-flex px-1.5 py-0.5 rounded bg-slate-100 text-slate-600 text-[9px] font-semibold uppercase">
                                    {{ $sub->service ?? 'General' }}
                                </span>
                                <span class="text-[10px] text-slate-400">{{ $sub->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                        <a href="{{ route('admin.contact.show', $sub) }}" class="p-2 text-slate-600 hover:text-primary hover:bg-slate-100 rounded-lg flex-shrink-0 transition-colors">
                            <i data-lucide="mail-open" class="w-4.5 h-4.5"></i>
                        </a>
                    </div>
                @empty
                    <div class="p-6 text-center text-slate-400 text-xs">
                        <i data-lucide="inbox" class="w-8 h-8 mx-auto mb-1.5 text-slate-300"></i>
                        <p>No inquiries received yet.</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Right: System Shortcuts & Overview -->
        <div class="space-y-6">
            <!-- Quick Actions -->
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                <h4 class="font-serif font-bold text-lg text-[#0f2343] mb-4">Quick Management Actions</h4>
                <div class="grid grid-cols-2 gap-3">
                    <a href="{{ route('admin.projects.create') }}" class="p-3 bg-slate-50 hover:bg-accent/10 border border-slate-100 hover:border-accent/30 rounded-lg flex flex-col items-center justify-center text-center gap-2 group transition-all">
                        <i data-lucide="plus-circle" class="w-6 h-6 text-slate-500 group-hover:text-accent"></i>
                        <span class="text-xs font-semibold text-slate-600 group-hover:text-[#0f2343]">Add Project</span>
                    </a>

                    <a href="{{ route('admin.services.create') }}" class="p-3 bg-slate-50 hover:bg-accent/10 border border-slate-100 hover:border-accent/30 rounded-lg flex flex-col items-center justify-center text-center gap-2 group transition-all">
                        <i data-lucide="folder-plus" class="w-6 h-6 text-slate-500 group-hover:text-accent"></i>
                        <span class="text-xs font-semibold text-slate-600 group-hover:text-[#0f2343]">Add Service</span>
                    </a>

                    <a href="{{ route('admin.careers.create') }}" class="p-3 bg-slate-50 hover:bg-accent/10 border border-slate-100 hover:border-accent/30 rounded-lg flex flex-col items-center justify-center text-center gap-2 group transition-all">
                        <i data-lucide="clipboard-list" class="w-6 h-6 text-slate-500 group-hover:text-accent"></i>
                        <span class="text-xs font-semibold text-slate-600 group-hover:text-[#0f2343]">Post a Job</span>
                    </a>

                    <a href="{{ route('admin.applications.index') }}" class="p-3 bg-slate-50 hover:bg-accent/10 border border-slate-100 hover:border-accent/30 rounded-lg flex flex-col items-center justify-center text-center gap-2 group transition-all">
                        <i data-lucide="file-badge" class="w-6 h-6 text-slate-500 group-hover:text-accent"></i>
                        <span class="text-xs font-semibold text-slate-600 group-hover:text-[#0f2343]">Applications</span>
                    </a>

                    <a href="{{ route('admin.team.create') }}" class="p-3 bg-slate-50 hover:bg-accent/10 border border-slate-100 hover:border-accent/30 rounded-lg flex flex-col items-center justify-center text-center gap-2 group transition-all">
                        <i data-lucide="user-plus" class="w-6 h-6 text-slate-500 group-hover:text-accent"></i>
                        <span class="text-xs font-semibold text-slate-600 group-hover:text-[#0f2343]">Add Member</span>
                    </a>

                    <a href="{{ route('admin.certifications.create') }}" class="p-3 bg-slate-50 hover:bg-accent/10 border border-slate-100 hover:border-accent/30 rounded-lg flex flex-col items-center justify-center text-center gap-2 group transition-all">
                        <i data-lucide="award" class="w-6 h-6 text-slate-500 group-hover:text-accent"></i>
                        <span class="text-xs font-semibold text-slate-600 group-hover:text-[#0f2343]">Add Certificate</span>
                    </a>
                </div>
            </div>

            <!-- Recent Projects Preview -->
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                <div class="flex items-center justify-between mb-4">
                    <h4 class="font-serif font-bold text-base text-[#0f2343]">Latest Projects</h4>
                    <a href="{{ route('admin.projects.index') }}" class="text-[11px] font-semibold text-accent hover:underline">Manage</a>
                </div>
                <div class="space-y-3.5">
                    @forelse($recentProjects as $p)
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-lg bg-slate-100 border border-slate-200 overflow-hidden flex-shrink-0 flex items-center justify-center">
                                @if($p->image)
                                    <img src="{{ $p->image }}" class="w-full h-full object-cover">
                                @else
                                    <i data-lucide="image" class="w-4 h-4 text-slate-400"></i>
                                @endif
                            </div>
                            <div class="min-w-0 flex-1">
                                <div class="text-xs font-bold text-slate-800 truncate">{{ $p->title }}</div>
                                <div class="text-[10px] text-slate-400 capitalize mt-0.5">{{ str_replace('-', ' ', $p->category) }} &bull; {{ $p->location }}</div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-6 text-slate-400 text-xs">
                            No projects created yet.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

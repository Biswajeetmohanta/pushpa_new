@extends('admin.layouts.app')

@section('title', 'Manage Projects')
@section('page-title', 'Projects Gallery')

@section('content')
<div class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
    <div>
        <p class="text-sm text-slate-500">Create, update, and manage all visual projects appearing on the front page.</p>
    </div>
    <a href="{{ route('admin.projects.create') }}" class="inline-flex items-center gap-2 bg-[#0f2343] hover:bg-primary text-white font-semibold px-4 py-2.5 rounded-lg shadow-sm hover:shadow-md transition-all text-sm flex-shrink-0">
        <i data-lucide="plus" class="w-4 h-4"></i>
        <span>Add New Project</span>
    </a>
</div>

<!-- Desktop Table View -->
<div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden hidden md:block">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 border-b border-slate-200 text-xs font-semibold text-slate-500 uppercase tracking-wider">
                    <th class="px-6 py-4">Image</th>
                    <th class="px-6 py-4">Project Details</th>
                    <th class="px-6 py-4">Sector</th>
                    <th class="px-6 py-4 text-center">Status</th>
                    <th class="px-6 py-4 text-center">Order</th>
                    <th class="px-6 py-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 text-sm">
                @forelse($projects as $project)
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($project->image)
                                <img src="{{ $project->image }}" alt="{{ $project->title }}" class="w-16 h-12 object-cover rounded-lg border border-slate-200">
                            @else
                                <div class="w-16 h-12 rounded-lg bg-slate-100 flex items-center justify-center text-slate-400 border border-slate-200">
                                    <i data-lucide="image" class="w-5 h-5"></i>
                                </div>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="font-bold text-slate-800">{{ $project->title }}</div>
                            <div class="text-xs text-slate-400 flex items-center gap-1 mt-1">
                                <i data-lucide="map-pin" class="w-3.5 h-3.5"></i>
                                <span>{{ $project->location }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-medium bg-slate-100 text-slate-700">
                                {{ $project->sector }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center whitespace-nowrap">
                            @if($project->is_active)
                                <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800">Active</span>
                            @else
                                <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-semibold bg-slate-100 text-slate-400">Hidden</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-center whitespace-nowrap text-slate-500">{{ $project->sort_order }}</td>
                        <td class="px-6 py-4 text-right whitespace-nowrap">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.projects.edit', $project) }}" class="p-2 text-slate-600 hover:text-primary hover:bg-slate-100 rounded-lg transition-colors" title="Edit">
                                    <i data-lucide="edit-3" class="w-4 h-4"></i>
                                </a>
                                <form action="{{ route('admin.projects.destroy', $project) }}" method="POST" class="inline" onsubmit="confirmDelete(event, this)">
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
                                <i data-lucide="folder-open" class="w-8 h-8 text-slate-300"></i>
                                <span>No projects found. Create one to get started!</span>
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
    @forelse($projects as $project)
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="flex items-center gap-3 p-4">
                @if($project->image)
                    <img src="{{ $project->image }}" alt="{{ $project->title }}" class="w-14 h-14 object-cover rounded-lg border border-slate-200 flex-shrink-0">
                @else
                    <div class="w-14 h-14 rounded-lg bg-slate-100 flex items-center justify-center text-slate-400 border border-slate-200 flex-shrink-0">
                        <i data-lucide="image" class="w-5 h-5"></i>
                    </div>
                @endif
                <div class="flex-1 min-w-0">
                    <div class="font-bold text-slate-800 text-sm truncate">{{ $project->title }}</div>
                    <div class="text-[11px] text-slate-400 flex items-center gap-1 mt-0.5">
                        <i data-lucide="map-pin" class="w-3 h-3"></i>
                        <span class="truncate">{{ $project->location }}</span>
                    </div>
                    <div class="flex items-center gap-2 mt-2">
                        <span class="inline-flex px-2 py-0.5 rounded-full text-[10px] font-medium bg-slate-100 text-slate-700">
                            {{ $project->sector }}
                        </span>
                        @if($project->is_active)
                            <span class="inline-flex px-2 py-0.5 rounded-full text-[10px] font-semibold bg-emerald-100 text-emerald-800">Active</span>
                        @else
                            <span class="inline-flex px-2 py-0.5 rounded-full text-[10px] font-semibold bg-slate-100 text-slate-400">Hidden</span>
                        @endif
                    </div>
                </div>
                <div class="flex flex-col gap-1.5 flex-shrink-0">
                    <a href="{{ route('admin.projects.edit', $project) }}" class="p-2 text-slate-600 hover:text-primary hover:bg-slate-100 rounded-lg transition-colors">
                        <i data-lucide="edit-3" class="w-4 h-4"></i>
                    </a>
                    <form action="{{ route('admin.projects.destroy', $project) }}" method="POST" onsubmit="confirmDelete(event, this)">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="p-2 text-red-600 hover:text-red-800 hover:bg-red-50 rounded-lg transition-colors">
                            <i data-lucide="trash-2" class="w-4 h-4"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @empty
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-8 text-center text-slate-400">
            <i data-lucide="folder-open" class="w-8 h-8 mx-auto mb-2 text-slate-300"></i>
            <p class="text-sm">No projects found. Create one to get started!</p>
        </div>
    @endforelse
</div>
@endsection
